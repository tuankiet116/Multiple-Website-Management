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
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getOrder($web_id_check = false, $order_id_check = false){
            $queryWhere="";
            if($web_id_check == true){
                $queryWhere .= " AND order_tb.web_id = ".$this->web_id;
            }

            if($order_id_check == true){
                $queryWhere .= " AND order_tb.order_id = ".$this->order_id;
            }
            $query = "SELECT order_tb.*, 
                      user_tb.user_name, 
                      user_tb.user_number_phone,
                      user_tb.user_email,
                      website_config.web_name
                      FROM order_tb 
                      INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id 
                      INNER JOIN website_config ON order_tb.web_id = website_config.web_id ".$queryWhere." AND order_tb.order_status = :order_status 
                      WHERE order_tb.order_id LIKE '%".$this->term."%' OR order_tb.order_trans_id LIKE '%".$this->term."%' ";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":order_status", $this->order_status, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

        public function getOrderDetail(){
            $query = "SELECT order_detail.*, product.product_name FROM order_detail 
                      INNER JOIN order_tb ON order_detail.order_id = order_tb.order_id
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
    }
?>