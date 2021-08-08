<?php 
    class Order{
        private $conn;
        private $table = 'order_tb';

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
        public $user_token;
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }


        private function validateToken(){
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

        public function setWebID($url){
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

        public function getOrder($web_id_check = false, $order_id_check = false){
            $queryWhere="";
            if($web_id_check == true){
                $queryWhere .= " AND order_tb.web_id = ".$this->web_id;
            }

            if($order_id_check == true){
                $queryWhere .= " AND order_tb.order_id = '".$this->order_id."'";
            }
            $query = "SELECT order_tb.*, 
                      user_tb.user_name, 
                      user_tb.user_number_phone,
                      user_tb.user_email,
                      website_config.web_name
                      FROM order_tb 
                      INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id 
                      INNER JOIN website_config ON order_tb.web_id = website_config.web_id ".$queryWhere." AND order_tb.order_status = :order_status AND order_active = 1 
                      WHERE order_tb.order_id LIKE '%".$this->term."%' OR order_tb.order_trans_id LIKE '%".$this->term."%' ORDER BY order_tb.order_datetime DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":order_status", $this->order_status, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

        public function getOrderDetail(){
            $query = "SELECT order_detail.*, 
                      product.product_name, 
                      product.product_currency,
                      product.product_image_path 
                      FROM order_detail 
                      INNER JOIN order_tb ON order_detail.order_id = order_tb.order_id AND order_tb.order_active =1
                      INNER JOIN product  ON order_detail.product_id = product.product_id 
                      AND order_detail.order_id = :order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":order_id", $this->order_id);
            $stmt->execute();
            return $stmt;
        }

        public function confirm(){
            $message = "";
            $query ="UPDATE ".$this->table." 
                     SET order_status = :order_status
                     WHERE order_id = :order_id";
                     
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":order_status",  $this->order_status, PDO::PARAM_INT);
            $stmt->bindParam(":order_id",      $this->order_id);

            if($stmt->execute() === true){
                $message = true;
                return $message;
            }
            else{
                $message="failure";
                return $message;
            }
        }

        public function cancel(){
            $message ="";
            $query = "UPDATE ".$this->table." 
                      SET order_status = :order_status,
                          order_reason = :order_reason
                      WHERE order_id = :order_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":order_status",  $this->order_status, PDO::PARAM_INT);
            $stmt->bindParam(":order_reason",   $this->order_reason, PDO::PARAM_INT);
            $stmt->bindParam(":order_id",      $this->order_id);

            if($stmt->execute() === true){
                $message = true;
                return $message;
            }
            else{
                $message="failure";
                return $message;
            }
        }

        public function getOrderByUser(){
            if($this->validateToken() === true){
                $query = "SELECT * FROM order_tb WHERE user_id = :user_id AND web_id = :web_id AND order_status = :order_status AND order_tb.order_active = 1 ORDER BY order_tb.order_datetime DESC";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":user_id",      $this->user_id);
                $stmt->bindParam(":web_id",       $this->web_id, PDO::PARAM_INT);
                $stmt->bindParam(":order_status", $this->order_status, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt;
            }
        }
    }
?>