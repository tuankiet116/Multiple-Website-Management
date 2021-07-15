<?php
    Class Domain{
        private $conn;
        public $domain_id;
        public $domain_active;
        public $domain_name;
        public $domain_web_id;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create(){
            $query = "Insert Into domain(domain_name, web_id) Values(:domain_name, :web_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':domain_name', $this->domain_name);
            $stmt->bindParam(':web_id', $this->web_id);
            if($stmt->execute() === true){
                return true;
            }
            return false;
        }

        public function update(){
            $query = "Update domain Set domain_name =:domain_name Where domain_id =:domain_id";
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(':domain_name', $this->domain_name);
            $stmt->bindParam(':domain_id', $this->domain_id);
            if($stmt->execute() === true){
                return true;
            }
            return false;
        }

        public function getAll(){
            $query = "Select domain.*, web_name From domain INNER Join website_config On domain.web_id = website_config.web_id";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute() === true){
                return $stmt;
            }
            return false;
        }

        public function getByID(){
            $query = "Select domain.*, web_name From domain Where domain_id = :domain_id INNER JOIN website_config ON domain.web_id = website_config.web_id";
            $stmt = $this->conn->prepare($query);
            $stmt ->bindParam(':domain_id', $this->domain_id);
            if($stmt->execute() === true){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->domain_name   = $result['domain_name'];
                $this->web_id        = $result['web_id'];
                $this->web_name      = $result['web_name'];
                $this->domain_active = $result['domain_active'];
                return true;
            }
            return false;
        }

        public function getAllByWebID(){
            $query = "SELECT * FROM domain WHERE web_id = :web_id INNER JOIN website_config ON domain.web_id = website_config.web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_id', $this->web_id);
            if($stmt->execute() === true){
                return $stmt;
            }
            return false;
        }
    }
?>