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
        public $product_active;
        public $product_gr_id;

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

        function getAll(){
            $queryWhere = "";
            if($this->web_id != "" && $this->web_id != null){
                $queryWhere = " AND website_config.web_id = ".$this->web_id;
            }

            if($this->product_active !== null){
                $queryWhere .= "AND product.product_active = ".$this->product_active;
            }
            $query = "SELECT product.*, web_name FROM product
                    INNER JOIN website_config ON product.web_id = website_config.web_id ".$queryWhere."
                    WHERE product_name LIKE '%".$this->term."%' OR web_name LIKE '%".$this->term."%' 
                    OR product_description LIKE '%".$this->term."%'";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            return $stmt;
        }

        function getByIDActive($get = true){ //Get Count And Get By ID With Activity
            $query = "SELECT * FROM ".$this->table." WHERE product_id = :product_id AND product_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $this->product_id);
            if($get === true){
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
            else{
                $query = "SELECT * FROM ".$this->table." WHERE product_id = :product_id ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->execute();
                return $stmt->rowCount();
            }
            
        }

        function getByIDAll($get = true){ //Get Count And Get By ID With Activity
            $query = "SELECT * FROM ".$this->table." WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $this->product_id);
            if($get === true){
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
            else{
                $query = "SELECT * FROM ".$this->table." WHERE product_id = :product_id ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->execute();
                return $stmt->rowCount();
            }
            
        }

        public function ActiveInactiveProduct(){
            $query = "UPDATE ".$this->table." SET product_active =:product_active WHERE product_id =:product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':product_active', $this->product_active, PDO::PARAM_INT);
            if($stmt->execute() === true){
                return true;
            }
            return false;
        }

        public function update(){
            $message = '';
            $query = "SELECT * FROM ".$this->table." WHERE product_name =:product_name AND web_id =:web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_name', $this->product_name);
            $stmt->bindParam(':web_id', $this->web_id);

            $stmt->execute();
            $id_product = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($id_product, $row['product_id']);
            }
            if(sizeof($id_product) > 0){
                if(sizeof($id_product) === 1 && in_array($this->product_id, $id_product)){
                    $query = "UPDATE ".$this->table." 
                            SET product_name        =:product_name,
                                product_description =:product_description,
                                product_image_path  =:product_image_path,
                                product_price       =:product_price,
                                product_currency    =:product_currency,
                                web_id              =:web_id 
                            WHERE product_id =:product_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':product_id'         , $this->product_id);
                    $stmt->bindParam(':product_name'       , $this->product_name);
                    $stmt->bindParam(':product_description', $this->product_description);
                    $stmt->bindParam(':product_image_path' , $this->product_image_path);
                    $stmt->bindParam(':product_price'      , $this->product_price);
                    $stmt->bindParam(':product_currency'   , $this->product_currency);
                    $stmt->bindParam(':web_id'             , $this->web_id);
                    if($stmt->execute() === true){
                        return true;
                    }
                    $message = "Error While Updating";
                    return $message;
                }
                else{
                    $message = "Product Name Duplicate";
                    return $message;
                }
            }
            else{
                $query = "UPDATE ".$this->table." 
                        SET product_name        =:product_name,
                            product_description =:product_description,
                            product_image_path  =:product_image_path,
                            product_price       =:product_price,
                            product_currency    =:product_currency,
                            web_id              =:web_id 
                        WHERE product_id =:product_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':product_id'         , $this->product_id);
                $stmt->bindParam(':product_name'       , $this->product_name);
                $stmt->bindParam(':product_description', $this->product_description);
                $stmt->bindParam(':product_image_path' , $this->product_image_path);
                $stmt->bindParam(':product_price'      , $this->product_price);
                $stmt->bindParam(':product_currency'   , $this->product_currency);
                $stmt->bindParam(':web_id'             , $this->web_id);
                if($stmt->execute() === true){
                    return true;
                }

                $message = "Error While Updating";
                return $message;
            }
        }

        public function create(){
            $message = '';
            $query = "SELECT * FROM ".$this->table." WHERE product_name =:product_name AND web_id =:web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_name', $this->product_name);
            $stmt->bindParam(':web_id', $this->web_id);

            $stmt->execute();
            $count = $stmt->rowCount();
            if($count === 0){
                $query = "INSERT INTO ".$this->table."(product_name, product_description, product_image_path, product_price, product_currency, web_id, product_gr_id) 
                            VALUES (:product_name,:product_description,:product_image_path,:product_price,:product_currency,:web_id, :product_gr_id )";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':product_name'       , $this->product_name);
                $stmt->bindParam(':product_description', $this->product_description);
                $stmt->bindParam(':product_image_path' , $this->product_image_path);
                $stmt->bindParam(':product_price'      , $this->product_price);
                $stmt->bindParam(':product_currency'   , $this->product_currency);
                $stmt->bindParam(':web_id'             , $this->web_id);
                $stmt->bindParam(':product_gr_id'      , $this->product_gr_id);
                if($stmt->execute() === true){
                    return true;
                }
                $message = "Error While Creating";
                return  $stmt;
                
            }
            else{
                $message = "Product Name Duplicate In This Website";
                return $message;
            }
        }
    }
?>