<?php
class Momo
{
    private $conn;
    private $endPoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    private $partnerCode;
    private $accessKey;
    private $secretKey;
    private $returnUrl;
    private $notifyUrl = "";
    private $extraData = "merchantName=MoMo Partner";
    private $requestType = "captureMoMoWallet";
    private $orderInfo;
    private $amount;
    private $orderID;
    private $requestId;
    private $web_id;

    public function __construct($orderID, $orderInfo, $amount, $db, $web_id)
    {
        $this->orderID = $orderID;
        $this->orderInfo = $orderInfo;
        $this->amount = $amount;
        $this->web_id = $web_id;
        $this->conn = $db;
        $this->getMomoInformation();
    }

    private function queryPreparePDO($query)
    {
        $stmt = $this->conn->prepare($query);
        return $stmt;
    }

    private function getMomoInformation()
    {
        $query = "SELECT payment_partner_code, payment_access_key, payment_secret_key FROM payment WHERE payment_active = 1 AND web_id =:web_id";
        $stmt = $this->queryPreparePDO($query);
        $stmt->bindParam(':web_id', $this->web_id);
        $result = $stmt->execute();
        if ($stmt->rowCount() > 0) {
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

    private function createPayment(){
        $data = $this->createData();
        $result = $this->execPostRequest($data);
        $resultJson = json_decode($result, true);
        return $resultJson;
    }
    
    public function initPayment(){
        $result = $this->createPayment();
        return $result;
    }
}
