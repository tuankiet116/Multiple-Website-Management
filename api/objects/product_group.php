<?php 
    class Product_group{
        private $conn;
        private $table = 'product_group';

        public $product_gr_id;
        public $product_gr_name;
        public $product_gr_description;
        public $product_gr_active;
        public $web_id;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProductGroupById(){
            $query = "SELECT * FROM ".$this->table." WHERE web_id = :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
            $stmt->execute();
             return $stmt;
        }
    }
?>