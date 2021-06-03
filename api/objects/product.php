<?php
    class Product{
        private $conn;
        private $table = 'product';

        public $product_id;
        public $product_name;
        public $product_description;
        public $product_image_path;
        public $product_price;
        public $product_currency;
        public $web_id;
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }

        function searchTermActive(){
            $query = "SELECT * FROM " .$this->table. " WHERE product_name LIKE '%".$this->term."%' AND web_id = :web_id
                     AND product_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            return $stmt;
        }

        function getByID(){
            $query = "SELECT * FROM ".$this->table." WHERE product_id = :product_id AND product_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $this->product_id);
            if($stmt->execute()){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->product_id          = $row["product_id"];
                $this->product_name        = $row['product_name'];
                $this->product_description = $row['product_description'];
                $this->product_image_path  = $row['product_image_path'];
                $this->product_price       = $row['product_price'];
                $this->product_currency    = $row['product_currency'];
                $this->web_id              = $row['web_id'];
                return true;
            }
            else{
                return false;
            }
        }
    }
?>