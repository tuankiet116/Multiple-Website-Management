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
        $this->notifyUrl = "http://" . $_SERVER['HTTP_HOST'] . "/api/Controller/Payment/momoNotify.php";
        $this->returnUrl = $returnUrl;
        $this->getMomoInformation();
    }

    private function getMomoInformation()
    {
        $query = "SELECT payment_partner_code, payment_access_key, payment_secret_key FROM payment WHERE payment_active = 1 AND web_id =:web_id AND payment_method = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->partnerCode = $result['payment_partner_code'];
            $this->accessKey   = $result['payment_access_key'];
            $this->secretKey   = $result['payment_secret_key'];
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
    protected function execPostRequest($data)
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
    private $userID;
    private $orderID;

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

    protected function getMomoInformation()
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
                        $this->getUserInformationByOrder();
                        $this->removeCart();
                        $this->updateOrder(false, true);
                    } else {
                        $this->updateOrder(false, false);
                    }
                    $this->response['message'] = "Received payment result success";
                } else {
                    $this->updateOrder(true, true);
                    $this->response['message'] = "ERROR! Fail checksum";
                }
            } else {
                $this->getUserInformationByOrder();
                $this->removeCart();
                $query = "UPDATE order_tb SET order_text =:order_text, order_active = 1 WHERE order_id =:order_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':order_text', 'Cannot get payment information to update order payment');
            }
            $debugger = array();
            $debugger['rawData'] = $this->rawHash;
            $debugger['momoSignature'] = $this->m2signature;
            $debugger['partnerSignature'] = $this->partnerSignature;
            $this->response['debugger'] = $debugger;
            return $this->response;
        } else {
            $debugger = array();
            $debugger['rawData'] = $this->rawHash;
            $debugger['momoSignature'] = $this->m2signature;
            $debugger['partnerSignature'] = $this->partnerSignature;
            $this->response['debugger'] = $debugger;
            return $this->response;
        }
    }

    private function getUserInformationByOrder()
    {
        $query = "SELECT user_id FROM order_tb WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->orderID);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->userID = $result['user_id'];
            return true;
        }
        return false;
    }

    private function updateOrder($suspicious, $active = true)
    {
        //check thanh toán khả nghi
        if ($suspicious === true) {
            $query = "UPDATE order_tb SET order_suspicious = 1, order_active = 1 WHERE order_id =:order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $this->orderID);
            $stmt->execute();
        } else {
            if ($active === true) {
                $query = "UPDATE order_tb SET 
                order_payment_status =:order_payment_status, 
                order_trans_id =:order_trans_id, 
                order_active = 1,
                order_text =:order_text, order_suspicious = 0 WHERE order_id =:order_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':order_id', $this->orderID);
                $stmt->bindParam(':order_text', $this->localMessage);
                $stmt->bindParam(':order_trans_id', $this->transId);
                $stmt->bindParam(':order_payment_status', $this->errorCode);
                $result = $stmt->execute();
            } else {
                $query = "UPDATE order_tb SET 
                order_payment_status =:order_payment_status, 
                order_trans_id =:order_trans_id, 
                order_active = 0,
                order_text =:order_text, order_suspicious = 0 WHERE order_id =:order_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':order_id', $this->orderID);
                $stmt->bindParam(':order_text', $this->localMessage);
                $stmt->bindParam(':order_trans_id', $this->transId);
                $stmt->bindParam(':order_payment_status', $this->errorCode);
                $result = $stmt->execute();
            }
        }
    }

    private function removeCart()
    {
        $query = 'DELETE FROM cart WHERE user_id =:user_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->userID);
        if ($stmt->execute() === true) {
            return true;
        }
        return false;
    }

    public function updateAndCheckOrder($data)
    {
        $response = $this->validation($data);
        return $response;
    }
}

class momoRefund extends Momo
{
    private $transId;
    private $requestType = "refundMoMoWallet";
    private $order_id;

    public function __construct($db, $order_id)
    {
        $this->conn = $db;
        $this->order_id = $order_id;
        $this->getOrderInformation();
        $this->getMomoInformation();
    }

    private function getOrderInformation()
    {
        $query = "SELECT * FROM order_tb WHERE order_id =:order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id);
        if ($stmt->execute() === true && $stmt->rowCount() === 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->transId = $result['order_trans_id'];
            $this->amount  = $result['order_sum_price'];
            $this->web_id  = $result['web_id'];
            return true;
        }
        return false;
    }

    private function getMomoInformation()
    {
        $query = "SELECT payment_partner_code, payment_access_key, payment_secret_key FROM payment WHERE payment_active = 1 AND web_id =:web_id AND payment_method = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->partnerCode = $result['payment_partner_code'];
            $this->accessKey   = $result['payment_access_key'];
            $this->secretKey   = $result['payment_secret_key'];
            return true;
        }
        return false;
    }

    private function createRefund()
    {
        $this->requestId   = time() . "";
        $this->getMomoInformation();
        $rawHash =  "partnerCode=" . $this->partnerCode .
            "&accessKey="  . $this->accessKey  .
            "&requestId="  . $this->requestId  .
            "&amount="     . $this->amount     .
            "&orderId="    . $this->order_id    .
            "&transId="    . $this->transId    .
            "&requestType=" . $this->requestType;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);
        $data = array(
            "partnerCode" => $this->partnerCode,
            "accessKey"   => $this->accessKey,
            "requestId"   => $this->requestId,
            "amount"      => $this->amount,
            "orderId"     => $this->order_id,
            "transId"     => $this->transId,
            "requestType" => $this->requestType,
            "signature"   => $signature
        );

        $data = json_encode($data);
        $result = $this->execPostRequest($data);
        return $result;
    }

    public function refund()
    {
        $resultJSON = $this->createRefund();
        $result = json_decode($resultJSON);
        $errorCodeRefund = $result->errorCode;
        $localMessage = $result->localMessage;
        $requestId = $result->requestId;
        //update order has been refunded
        $query = "UPDATE order_tb 
        SET order_refund_code       =:order_refund_code, 
            order_refund_message    =:order_refund_message, 
            order_refund_request_id =:request_id
        WHERE order_id =:order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_refund_code'   , $errorCodeRefund);
        $stmt->bindParam(':order_refund_message', $localMessage);
        $stmt->bindParam(':request_id'          , $requestId);
        $stmt->bindParam(':order_id'            , $this->order_id);
        $reslt = $stmt->execute();
        if ($result->errorCode == 0) {
            return true;
        } 
        return false;
    }
}
