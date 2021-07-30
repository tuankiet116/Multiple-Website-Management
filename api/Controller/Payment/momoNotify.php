<?php
header("content-type: application/json; charset=UTF-8");
http_response_code(200); //200 - Everything will be 200 Oke
if (!empty($_POST)) {
    $response = array();
    try {
        $partnerCode  = $_POST["partnerCode"];
        $accessKey    = $_POST["accessKey"];
        $orderId      = $_POST["orderId"];
        $localMessage = $_POST["localMessage"];
        $message      = $_POST["message"];
        $transId      = $_POST["transId"];
        $orderInfo    = $_POST["orderInfo"];
        $amount       = $_POST["amount"];
        $errorCode    = $_POST["errorCode"];
        $responseTime = $_POST["responseTime"];
        $requestId    = $_POST["requestId"];
        $extraData    = $_POST["extraData"];
        $payType      = $_POST["payType"];
        $orderType    = $_POST["orderType"];
        $extraData    = $_POST["extraData"];
        $m2signature  = $_POST["signature"]; //MoMo signature
    } catch (Exception $e) {
        echo $response['message'] = $e;
    }

    $debugger = array();
    $debugger['rawData'] = $rawHash;
    $debugger['momoSignature'] = $m2signature;
    $debugger['partnerSignature'] = $partnerSignature;

    if ($m2signature == $partnerSignature) {
        $response['message'] = "Received payment result success";
    } else {
        $response['message'] = "Invalid Payment";
    }
    $response['debugger'] = $debugger;
    echo json_encode($response);
}

?>
