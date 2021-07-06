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

        public function getProductGroupByWebId(){
            $query = "SELECT * FROM ".$this->table." WHERE web_id = :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

        public function createProductGroup(){
            $message = "";
            $query = "SELECT product_gr_name FROM ".$this->table." WHERE product_gr_name= :product_gr_name AND web_id= :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_gr_name', $this->product_gr_name);
            $stmt->bindParam(':web_id', $this->web_id, PDO::PARAM_INT);

            if($stmt->execute() === true){
                $count = $stmt->rowCount();
                if($count === 0){
                    $query = "INSERT INTO ".$this->table." (product_gr_name, product_gr_description, web_id) 
                            VALUES (:product_gr_name, :product_gr_description, :web_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':product_gr_name',        $this->product_gr_name);
                    $stmt->bindParam(':product_gr_description', $this->product_gr_description);
                    $stmt->bindParam(':web_id',                 $this->web_id);

                    if($stmt->execute()==true){
                        $message = true;
                        return $message;
                    }
                    else{
                        $message = "Cannot create Product Group!!";
                        return $message;
                    }
                }
                else{
                    $message = "Product group Name Duplicate!!";
                    return $message;
                }
            }
            else{
                $message = "Something Has wrong!!";
                return $message;
            }
        }

        public function updateProductGroup(){
            $message ='';
            $total = 0;
            $arrDuplicate = [];
            $query = "SELECT * FROM ".$this->table." WHERE web_id = :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            if($stmt->rowCount()>0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($arrDuplicate, $row);
                }
            }
            else{
                $message ="Something Has Wrong!!";
                return $message;
            }

            foreach($arrDuplicate as $item){
                if($item['product_gr_name'] == $this->product_gr_name || $item['product_gr_id'] == $this->product_gr_id){
                    $total+=1;
                }
            }

            if($total == 1){
                $query = "UPDATE ".$this->table." SET 
                          product_gr_name        = :product_gr_name,
                          product_gr_description = :product_gr_description
                          WHERE product_gr_id    = :product_gr_id";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":product_gr_name",        $this->product_gr_name);
                $stmt->bindParam(":product_gr_description", $this->product_gr_description);
                $stmt->bindParam(":product_gr_id",          $this->product_gr_id, PDO::PARAM_INT);

                if($stmt->execute()){
                    $message = true;
                    return $message;
                }
                else{
                    $message = "Cannot Update Product Group!!";
                    return $message;
                }
            }
            else{
                $message = "Product Group Name Duplicate!!";
                return $message;
            }
        }

        public function getProductGroupById(){
            $message ='';
            $query = "SELECT * FROM ".$this->table." WHERE product_gr_id = :product_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":product_gr_id", $this->product_gr_id);
            $stmt->execute();
            return $stmt;
        }

        public function activeProductGroup(){
            $message ='';
            $query ="UPDATE ".$this->table." SET 
                     product_gr_active = :product_gr_active WHERE 
                     web_id            = :web_id
                     AND product_gr_id = :product_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":product_gr_active", $this->product_gr_active, PDO::PARAM_INT);
            $stmt->bindParam(":web_id",            $this->web_id, PDO::PARAM_INT);
            $stmt->bindParam(":product_gr_id",     $this->product_gr_id, PDO::PARAM_INT);
            
            if($stmt->execute()){
                $message = true;
                return $message;
            }
            else{
                $message = 'failure';
                return $message;
            }

        }
    }
?>