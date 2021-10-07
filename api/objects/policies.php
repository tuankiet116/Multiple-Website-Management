<?php
    class Service{
        private $conn;
        private $table ='policies';

        public $policies_id;
        public $policies_title;
        public $policies_image_background;
        public $policies_meta_description;
        public $policies_content;
        public $policies_rewrite_name;
        public $policies_active;
        public $policies_datetime_create;
        public $policies_datetime_update;
        public $term;
        public $web_id;

        public function __construct($db){
            $this->conn = $db;
        }

        public function createPolicies(){
            $message ="";
            $query = "SELECT * FROM ".$this->table." WHERE web_id = :web_id AND policies_title = :policies_title";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":web_id"        , $this->web_id, PDO::PARAM_INT);
            $stmt->bindParam(":policies_title", $this->policies_title,);
            
            if($stmt->execute() === true){
                if($stmt->rowCount() === 0){
                    $query = "INSERT INTO ".$this->table." (policies_title, service_description, service_content, service_gr_id, service_image)
                              VALUES (:service_name, :service_description, :service_content, :service_gr_id, :service_image)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":service_name",        $this->service_name);
                    $stmt->bindParam(":service_description", $this->service_description);
                    $stmt->bindParam(":service_content",     $this->service_content);
                    $stmt->bindParam(":service_image",       $this->service_image);
                    $stmt->bindParam(":service_gr_id",       $this->service_gr_id, PDO::PARAM_INT);

                    if($stmt->execute()==true){
                        $message = true;
                        return $message;
                    }
                    else{
                        $message = "Cannot create service. Contact to admin.";
                        return $message;
                    }
                }
                else{
                    $message = "Service Name Duplicate!";
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
                      service_id     = :service_id AND
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
                $message = "failure";
                return $message;
            }
        }

        public function getServiceById(){
            $query = "SELECT * FROM ".$this->table." WHERE service_id = :service_id AND service_gr_id = :service_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":service_id",    $this->service_id, PDO::PARAM_INT);
            $stmt->bindParam(":service_gr_id", $this->service_gr_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

        public function updateService(){
            $message ="";
            $total = 0;
            $arrDuplicate =[];
            $query = "SELECT * FROM ".$this->table." WHERE service_gr_id = :service_gr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":service_gr_id", $this->service_gr_id, PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($arrDuplicate, $row);
                }
            }
            else{
                $message = 'Something Has Wrong!!';
                return $message;
            }

            foreach($arrDuplicate as $item){
                if($item['service_name'] == $this->service_name || $item['service_id'] == $this->service_id){
                    $total += 1;
                }
            }

            if($total == 1){
                $query = "UPDATE ".$this->table." SET
                          service_name = :service_name,
                          service_description = :service_description,
                          service_content = :service_content,
                          service_image   = :service_image WHERE
                          service_id = :service_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":service_name",        $this->service_name);
                $stmt->bindParam(":service_description", $this->service_description);
                $stmt->bindParam(":service_content",     $this->service_content);
                $stmt->bindParam(":service_image",       $this->service_image);
                $stmt->bindParam(":service_id",          $this->service_id, PDO::PARAM_INT);

                if($stmt->execute()){
                    $message = true;
                    return $message;
                }
                else{
                    $message = "Cannot Update Service!!";
                    return $message;
                }
            }
            else{
                $message = "Service Existed!!";
                return $message;
            }
        }
    }
?>