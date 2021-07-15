<?php
    class Service{
        private $conn;
        private $table ='service';

        public $service_id;
        public $service_name;
        public $service_description;
        public $service_content;
        public $service_gr_id;
        public $service_active;
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }

        public function createService(){
            $message ="";
            $query = "SELECT * FROM ".$this->table." WHERE service_gr_id = :service_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":service_gr_id", $this->service_gr_id, PDO::PARAM_INT);
            
            if($stmt->execute() === true){
                if($stmt->rowCount() === 0){
                    $query = "INSERT INTO ".$this->table." (service_name, service_description, service_content, service_gr_id)
                              VALUES (:service_name, :service_description, :service_content, :service_gr_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":service_name",        $this->service_name);
                    $stmt->bindParam(":service_description", $this->service_description);
                    $stmt->bindParam(":service_content",     $this->service_content);
                    $stmt->bindParam(":service_gr_id",       $this->service_gr_id, PDO::PARAM_INT);

                    if($stmt->execute()==true){
                        $message = true;
                        return $message;
                    }
                    else{
                        $message = "Cannot create Service!!";
                        return $message;
                    }
                }
                else{
                    $message = "Service Name Duplicate!!";
                    return $message;
                }
            }
            else{
                $message = "Something has Wrong!!";
                return $message;
            }
        }

        public function getAllService(){
            $queryWhere ="";
            if($this->service_gr_id != null && $this->service_gr_id != ""){
                $queryWhere .= " AND service_group.service_gr_id = ".$this->service_gr_id;
            }
            if($this->service_active !== null && $this->service_active !== ""){
                $queryWhere .= " AND service.service_active = ".$this->service_active;
            }
            $query = "SELECT service.*, service_group.service_gr_name FROM service 
                      INNER JOIN service_group ON service.service_gr_id = service_group.service_gr_id ".$queryWhere." 
                      WHERE service_name LIKE '%".$this->term."%' OR service_gr_name LIKE '%".$this->term."%' OR 
                      service_description LIKE '%".$this->term."%'";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function activeStatus(){
            $message ='';
            $query = "UPDATE ".$this->table." SET
                      service_active = :service_active WHERE
                      service_id     = :service_id
                      service_gr_id  = :service_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":service_active", $this->service_active, PDO::PARAM_INT);
            $stmt->bindParam(":service_id"    , $this->service_id, PDO::PARAM_INT);
            $stmt->bindParam(":service_gr_id" , $this->service_gr_id, PDO:: PARAM_INT);
            
            if($stmt->execute()===true){
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