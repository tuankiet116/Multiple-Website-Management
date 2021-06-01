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

        function searchTerm(){
            $query = "SELECT * FROM " .$this->table. " WHERE product_name LIKE '%".$this->term."%' AND web_id = :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            return $stmt;
        }
    }
?>