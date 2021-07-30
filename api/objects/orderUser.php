<?php
class OrderUser
{
    private $conn;
    private $list_product_info = array();

    public $order_id;
    public $user_id;
    public $order_payment_status;
    public $order_payment;
    public $web_id;
    public $order_request_id;
    public $order_trans_id;
    public $order_sum_price;
    public $order_paytype;
    public $order_datetime;
    public $order_status;
    public $order_reason;
    public $term;
    public $user_token;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setWebID($url)
    {
        $get_url_1 = explode("//", $url);
        $get_url_2 = explode("/", $get_url_1[1]);
        $get_url_3 = explode(":", $get_url_2[0]);
        $main_url = $get_url_3[0];
        $query = "SELECT domain.domain_name, wc.* FROM domain 
                    INNER JOIN website_config wc ON wc.web_id = domain.web_id 
                                                AND domain.domain_name = :url 
                                                AND domain.domain_active = 1 
                                                AND wc.web_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':url', $main_url);
        if ($stmt->execute() === true) {
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->web_id = $result['web_id'];
                return true;
            }
            return false;
        }
        return false;
    }

    private function validateToken()
    {
        $user_token = new userToken();
        $user_token->token = $this->user_token;
        $user_token->web_id = $this->web_id;
        if ($user_token->validation() === true) {
            $this->user_id = $user_token->user_id;
            $this->user_token = $user_token->tokenId;
            return true;
        } else {
            return false;
        }
    }

    private function prepareQueryPDO($query){
        $stmt = $this->conn->prepare($query);
        return $stmt;
    }

    private function removeCart(){
        $query = 'DELETE FROM cart WHERE user_id =:user_id AND web_id =:web_id';
        $stmt = $this->prepareQueryPDO($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':web_id', $this->web_id);
        if($stmt->execute()===true){
            return true;

        }
        return false;
    }

    private function getCartInformation(){
        $this->list_product_info = array();
        $this->order_sum_price = 0;

        $query = "SELECT * FROM cart WHERE user_id =:user_id AND web_id =:web_id";
        $stmt = $this->prepareQueryPDO($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':web_id', $this->web_id);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = array(
                    'product_id'=>$row['product_id'],
                    'cart_quantity' => $row['cart_quantity'],
                    'cart_price' => $row['cart_price']
                );
                $this->order_sum_price += floatval($row['cart_price']) * intVal($row['cart_quantity']);
                array_push($this->list_product_info, $result);
            }

            return true;
        }
        else{
            return false;
        }
    }

    private function createOrderCOD(){
        if($this->getCartInformation() === true){
            $this->order_id = $this->createOrderID();
            $query = 'INSERT INTO order_tb(order_id, user_id, order_payment_status, order_payment, web_id, order_sum_price, order_datetime, order_status, order_description, order_momo_error_text)
                        VALUES(:order_id, :user_id, 1, 1, :web_id, :order_sum_price, CURRENT_TIMESTAMP(), 1, :order_description, "")';
            $stmt = $this->prepareQueryPDO($query);
            $stmt->bindParam(':order_id'         , $this->order_id);
            $stmt->bindParam(':user_id'          , $this->user_id);
            $stmt->bindParam(':web_id'           , $this->web_id);
            $stmt->bindParam(':order_sum_price'  , $this->order_sum_price);
            $stmt->bindParam(':order_description', $this->order_description);
            if($stmt->execute() === true){
                $values = "";
                foreach ($this->list_product_info as $key => $value) {
                    $product_id = $value['product_id'];
                    $quantity = $value['cart_quantity'];
                    $unit_price = $value['cart_price'];
                    $amount = floatVal(intVal($quantity) * floatval($unit_price));
                    $values .= "('".$this->order_id."','". $product_id."','". $quantity."','". $unit_price."','". $amount."')";
                    if($key != array_key_last($this->list_product_info)){
                        $values .= ',';
                    }
                }
                $query = "INSERT INTO order_detail(order_id, product_id, order_detail_quantity, order_detail_unit_price, order_detail_amount)
                VALUES ".$values;
                $stmt_detail = $this->prepareQueryPDO($query);

                if($stmt_detail->execute() === false){
                    $result = array('code'=>500, 'message' => "Cannot Create Order Detail COD method payment.");
                    return $result;
                }
                $this->removeCart();
                $result = array('code'=>200, 'message' => "Order COD payment method success created.");
                return $result;
            }
            else{
                $result = array('code'=>500, 'message' => "Cannot Create Order COD payment method.");
                return $result;
            }
        }
        else{
            $result = array('code'=>404, 'message' => "Cart's empty");
            return $result;
        }
    }
    
    private function createOrderID(){
        $id = uniqid('ORDER', true);
        while(true){
            $query = "SELECT order_id FROM order_tb WHERE order_id =:order_id";
            $stmt = $this->prepareQueryPDO($query);
            $stmt->bindParam(':order_id', $id);
            $stmt->execute();
            if($stmt->rowCount() === 0){
                break;
            }
        }
        return $id;
    }


    public function createOrder()
    {
        if($this->validateToken() === true){
            $result = array();
            switch($this->order_payment){
                case 1:
                    $result = $this->createOrderCOD();
                    break;
                case 2:
                    break;
                case 3:
                    $result = array('code' => 400, 'message'=>'No Payment Method Choosed');
            }
            return $result;
        }
        else{
            $result = array('code' => 403, 'message' => 'Token Expired');
            return $result;
        }
    }
}
