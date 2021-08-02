<?php
class Momo
{
    private $conn;
    private $endPoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    private $partnerCode;
    private $accessKey;
    private $secretKey;
    private $returnUrl;
    private $notifyUrl;
    private $extraData = "merchantName=MoMo Partner";
    private $requestType = "captureMoMoWallet";
    private $orderInfo;
    private $amount;
    private $orderID;
    private $requestId;
    private $web_id;

    public function __construct($orderID, $orderInfo, $amount, $db, $web_id, $returnUrl)
    {
        $this->orderID = $orderID;
        $this->orderInfo = $orderInfo;
        $this->amount = $amount;
        $this->web_id = $web_id;
        $this->conn = $db;
        $this->notifyUrl = "http://".$_SERVER['HTTP_HOST'] . "/api/Controller/Payment/momoNotify.php";
        $this->returnUrl = $returnUrl;
        $this->getMomoInformation();
    }

    protected function queryPreparePDO($query)
    {
        $stmt = $this->conn->prepare($query);
        return $stmt;
    }

    private function getMomoInformation()
    {
        $query = "SELECT payment_partner_code, payment_access_key, payment_secret_key FROM payment WHERE payment_active = 1 AND web_id =:web_id AND payment_method = 2";
        $stmt = $this->queryPreparePDO($query);
        $stmt->bindParam(':web_id', $this->web_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->partnerCode = $result['payment_partner_code'];
            $this->accessKey = $result['payment_access_key'];
            $this->secretKey = $result['payment_secret_key'];
            return true;
        }
        return false;
    }

    /**
     * Undocumented function
     *
     * @param json string $data
     * @return string
     */
    private function execPostRequest($data)
    {
        $ch = curl_init($this->endPoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    private function createData()
    {
        //define some information which could be config 
        $this->requestId   = time() . "";
        $rawHash = "partnerCode=" . $this->partnerCode .
            "&accessKey="  . $this->accessKey   .
            "&requestId="  . $this->requestId   .
            "&amount="     . $this->amount      .
            "&orderId="    . $this->orderID     .
            "&orderInfo="  . $this->orderInfo   .
            "&returnUrl="  . $this->returnUrl   .
            "&notifyUrl="  . $this->notifyUrl   .
            "&extraData="  . $this->extraData;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);
        $data = array(
            'partnerCode' => $this->partnerCode,
            'accessKey'   => $this->accessKey,
            'requestId'   => $this->requestId,
            'amount'      => $this->amount,
            'orderId'     => $this->orderID,
            'orderInfo'   => $this->orderInfo,
            'returnUrl'   => $this->returnUrl,
            'notifyUrl'   => $this->notifyUrl,
            'extraData'   => $this->extraData,
            'payType'     => 'qr',
            'requestType' => $this->requestType,
            'signature'   => $signature
        );
        return json_encode($data);
    }

    private function createPayment()
    {
        $data = $this->createData();
        $result = $this->execPostRequest($data);
        $resultJson = json_decode($result, true);
        return $resultJson;
    }

    public function initPayment()
    {
        $result = $this->createPayment();
        return $result;
    }
}

class momoCheck extends Momo
{
    private $m2signature;
    private $orderType;
    private $payType;
    private $responseTime;
    private $errorCode;
    private $transId;
    private $message;
    private $localMessage;
    private $rawHash;
    private $response = array();
    private $partnerSignature;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    private function setInformation($data)
    {
        try {
            $this->partnerCode  = $data["partnerCode"];
            $this->accessKey    = $data["accessKey"];
            $this->orderID      = $data["orderId"];
            $this->localMessage = $data["localMessage"];
            $this->message      = $data["message"];
            $this->transId      = $data["transId"];
            $this->orderInfo    = $data["orderInfo"];
            $this->amount       = $data["amount"];
            $this->errorCode    = $data["errorCode"];
            $this->responseTime = $data["responseTime"];
            $this->requestId    = $data["requestId"];
            $this->extraData    = $data["extraData"];
            $this->payType      = $data["payType"];
            $this->orderType    = $data["orderType"];
            $this->extraData    = $data["extraData"];
            $this->m2signature  = $data["signature"]; //MoMo signature
        } catch (Exception $e) {
            $this->response['message'] = $e;
            return false;
        } finally {
            $this->response['message'] = "";
            return true;
        }
    }

    private function getMomoInformation()
    {
        $query = "SELECT order_tb.web_id, payment_secret_key 
                    FROM order_tb 
                    INNER JOIN payment ON order_tb.web_id = payment.web_id AND order_id = :order_id AND payment.payment_method = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->orderID);
        $stmt->execute();
        if ($stmt->rowCount() !== 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->web_id = $row['web_id'];
            $this->secretKey = $row['payment_secret_key'];
            return true;
        }
        return false;
    }

    private function validation($data)
    {
        if ($this->setInformation($data) === true) {
            if ($this->getMomoInformation() === true) {
                //Checksum
                $this->rawHash =
                    "partnerCode="   . $this->partnerCode  .
                    "&accessKey="    . $this->accessKey    .
                    "&requestId="    . $this->requestId    .
                    "&amount="       . $this->amount       .
                    "&orderId="      . $this->orderID      .
                    "&orderInfo="    . $this->orderInfo    .
                    "&orderType="    . $this->orderType    .
                    "&transId="      . $this->transId      .
                    "&message="      . $this->message      .
                    "&localMessage=" . $this->localMessage .
                    "&responseTime=" . $this->responseTime .
                    "&errorCode="    . $this->errorCode    .
                    "&payType="      . $this->payType      .
                    "&extraData="    . $this->extraData;

                $this->partnerSignature = hash_hmac("sha256", $this->rawHash, $this->secretKey);

                if ($this->m2signature == $this->partnerSignature) {
                    if ($this->errorCode == '0') {
                        $this->updateOrder(false);
                    } else {
                        $this->updateOrder(false);
                    }
                    $this->response['message'] = "Received payment result success";
                } else {
                    $this->updateOrder(true);
                    $this->response['message'] = "ERROR! Fail checksum";
                }
            } else {
                $query = "UPDATE order_tb SET order_text =:order_text WHERE order_id =:order_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':order_text', 'Cannot get payment information to update order payment');
            }
            $debugger = array();
            $debugger['rawData'] = $this->rawHash;
            $debugger['momoSignature'] = $this->m2signature;
            $debugger['partnerSignature'] = $this->partnerSignature;
            $this->response['debugger'] = $debugger;
            return $this->response;
        }
        else{
            $debugger = array();
            $debugger['rawData'] = $this->rawHash;
            $debugger['momoSignature'] = $this->m2signature;
            $debugger['partnerSignature'] = $this->partnerSignature;
            $this->response['debugger'] = $debugger;
            return $this->response;
        }   
    }

    private function updateOrder($suspicious)
    {
        //check thanh toán khả nghi
        if ($suspicious === true) {
            $query = "UPDATE order_tb SET order_suspicious = 1 WHERE order_id =:order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $this->orderID);
            $stmt->execute();
        } else {
            $query = "UPDATE order_tb SET 
                order_payment_status =:order_payment_status, 
                order_trans_id =:order_trans_id, 
                order_text =:order_text, order_suspicious = 0 WHERE order_id =:order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $this->orderID);
            $stmt->bindParam(':order_text', $this->localMessage);
            $stmt->bindParam(':order_trans_id', $this->transId);
            $stmt->bindParam(':order_payment_status', $this->errorCode);
            $result = $stmt->execute();
        }
    }

    public function updateAndCheckOrder($data)
    {
        $response = $this->validation($data);
        return $response;
    }
}
