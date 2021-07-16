<?php
    class Payment{
        private $conn;
        private $table = 'payment';

        public $payment_id;
        public $payment_partner_code;
        public $payment_access_key;
        public $payment_secret_key;
        public $payment_method;
        public $web_id;
        public $payment_active;
        public $web_name;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $message = "";
            $query = "SELECT * FROM payment WHERE payment_method =:payment_method AND web_id = :web_id";
            $stmt =  $this->conn->prepare($query);
            $stmt->bindParam(':payment_method', $this->payment_method);
            $stmt->bindParam(':web_id'        , $this->web_id);
            if($stmt->execute() === true){
                $count = $stmt->rowCount();
                if($count===0){
                    $query = "INSERT INTO ".$this->table."(payment_partner_code, payment_access_key, payment_secret_key,
                                payment_method, web_id) 
                                VALUES(:payment_partner_code, :payment_access_key, :payment_secret_key,
                                :payment_method, :web_id)";
                    $stmt = $this->conn->prepare($query);

                    $stmt->bindParam(':payment_partner_code', $this->payment_partner_code);
                    $stmt->bindParam(':payment_access_key',   $this->payment_access_key);
                    $stmt->bindParam(':payment_secret_key',   $this->payment_secret_key);
                    $stmt->bindParam(':payment_method',       $this->payment_method);
                    $stmt->bindParam(':web_id',               $this->web_id);

                    if($stmt->execute()){
                        return true;
                    }
                    else{
                        $message = "The System Cannot Create Payment For Your Website";
                        return $message;
                    }
                }
                else{
                    $message = "This Website Has Existed The Same Payment Method";
                    return $message;
                }
            }
            else{
                $message = "Having Trouble While The System Was Creating Payment Method";
                return $message;
            }
        }

        public function update(){
            $message = "";
            //check if payment method is available 
            $query_check_payment = "SELECT payment_method From payment WHERE payment_id = :payment_id";
            $stmt = $this->conn->prepare($query_check_payment);
            $stmt->bindParam(':payment_id', $this->payment_id);
            if($stmt->execute() === true){
                if($stmt->rowCount() === 1){
                    $query = "Update payment 
                              SET payment_partner_code = :payment_partner_code, payment_access_key = :payment_access_key, 
                                  payment_secret_key = :payment_secret_key
                              WHERE payment_id = :payment_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':payment_partner_code', $this->payment_partner_code);
                    $stmt->bindParam(':payment_access_key'  , $this->payment_access_key);
                    $stmt->bindParam(':payment_secret_key'  , $this->payment_secret_key);
                    $stmt->bindParam(':payment_id'          , $this->payment_id);
                    if($stmt->execute()===true){
                        return true;
                    }
                    else{
                        $message = "The system's got error while it was updating payment information";
                        return $message;
                    }
                }
                else{
                    $message = "Your payment method's not accepted or not exists";
                    return $message;
                }
            }
            else{
                $message = "The system got error while it was taking payment's information";
                return $message;
            }
        }

        public function ActiveInactivePayment(){
            $message="";
            $query = "UPDATE ".$this->table." SET payment_active =:payment_active WHERE payment_id =:payment_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':payment_id'    , $this->payment_id);
            $stmt->bindParam(':payment_active', $this->payment_active, PDO::PARAM_INT);
            if($stmt->execute() === true){
                return true;
            }
            $message = "The system's got error while active/inactive payment method";
            return $message;
        }

        public function getAll(){
            $query_website = "";
            $query_payment = "";
            if($this->web_id != null && $this ->web_id != 0){
                $query_website = " AND website_config.web_id = ".$this->web_id;
            }

            if($this->payment_active !== null){
                $query_payment = " WHERE payment.payment_active = ".$this->payment_active;
            }

            if($this->payment_method !== null){
                $query_payment = " WHERE payment.payment_method = ".$this->payment_method;
            }

            if($this->payment_method !== null && $this->payment_active !== null){
                $query_payment = " WHERE payment.payment_active = ".$this->payment_active.
                                    " AND payment.payment_method = ".$this->payment_method;
            }

            $query = "SELECT payment.payment_id , payment.payment_partner_code , payment.payment_access_key, payment.payment_secret_key, 
                             payment.payment_active, payment.payment_method, website_config.web_name, website_config.web_id
                      FROM payment
                      INNER JOIN website_config ON website_config.web_id = payment.web_id ".$query_website.
                        $query_payment.
                     " ORDER BY payment.payment_id DESC ";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getPaymentByID($getData = true){
            $query = 'SELECT payment.*, website_config.web_name 
                      FROM payment
                      INNER JOIN website_config ON website_config.web_id = payment.web_id 
                      WHERE payment_id = :payment_id';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':payment_id', $this->payment_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($getData === true){
                $this->payment_id           = $row['payment_id'];
                $this->payment_partner_code = $row['payment_partner_code'];
                $this->payment_access_key   = $row['payment_access_key'];
                $this->payment_secret_key   = $row['payment_secret_key'];
                $this->payment_method       = $row['payment_method'];
                $this->web_id               = $row['web_id'];
                $this->payment_active       = $row['payment_active'];
                $this->web_name             = $row['web_name'];
            }
            else{
                return $stmt->rowCount();
            }
        }
    }
?>