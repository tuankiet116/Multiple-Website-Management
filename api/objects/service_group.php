<?php 

    class Service_group{
        private $conn;
        private $table = 'service_group';

        public $service_gr_id;
        public $service_gr_name;
        public $service_gr_description;
        public $service_gr_active;
        public $web_id;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getServiceGroup($web_id = false){
            $query = "SELECT service_group.*, website_config.web_name FROM ".$this->table." INNER JOIN website_config 
            ON service_group.web_id = website_config.web_id";
            if($web_id == true){
                $query .= " WHERE service_group.web_id = :web_id";
            }

            $stmt = $this->conn->prepare($query);

            if($web_id == true){
                $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt;
        }

        
        public function createServiceGroup(){
            $message ="";
            $query = "SELECT * FROM ".$this->table." WHERE service_gr_name = :service_gr_name AND web_id = :web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":service_gr_name", $this->service_gr_name);
            $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
            
            if($stmt->execute() === true){
                if($stmt->rowCount() === 0){
                    $query = "INSERT INTO ".$this->table." (service_gr_name, service_gr_description, web_id)
                              VALUES (:service_gr_name, :service_gr_description, :web_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":service_gr_name", $this->service_gr_name);
                    $stmt->bindParam(":service_gr_description", $this->service_gr_description);
                    $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);

                    if($stmt->execute()==true){
                        $message = true;
                        return $message;
                    }
                    else{
                        $message = "Cannot create Service Group!!";
                        return $message;
                    }
                }
                else{
                    $message = "Service group Name Duplicate!!";
                    return $message;
                }
            }
            else{
                $message = "Something has Wrong!!";
                return $message;
            }
        }


        
    }
?>