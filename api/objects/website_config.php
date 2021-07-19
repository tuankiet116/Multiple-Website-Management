<?php
//require_once("../inc_security.php");
class Website_Config{
  
    // database connection and table name
    private $conn;
    private $table_name = "website_config";
  
    // object properties
    public $web_id;
    public $web_name;
    public $web_active;
    public $domain;
    public $web_icon;
    public $web_description;
    public $term;
    public $result;
    public $domain_status;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function searchTerm($query){
        $count = 0;
        // query to read single record
        if(!isset($query)){
            $query = "SELECT * FROM " .$this->table_name. " WHERE web_name LIKE '%".$this->term."%' AND web_active = 1";
        }
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //excute query
        $stmt->execute();

        return $stmt;
    }

    function getWebsiteByID(){
        $query = "SELECT website_config.*, GROUP_CONCAT(domain.domain_name) as list_domain, GROUP_CONCAT(CAST(domain.domain_active as INT)) as list_domain_status
                    FROM website_config 
                    LEFT JOIN domain On domain.web_id = website_config.web_id  
                    WHERE website_config.web_id = :web_id 
                    GROUP BY website_config.web_id";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id, PDO::PARAM_INT);
        
        //excute query
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->web_id          = $row['web_id'];
            $this->web_name        = $row['web_name'];
            $this->domain         = $row['list_domain'];
            $this->web_active      = $row['web_active'];
            $this->web_icon        = $row['web_icon'];
            $this->web_description = $row['web_description'];
            $this->domain_status   = $row['list_domain_status'];
            return true;
        }
        return false;
    }

    function getAllWebSite(){
        $query = " SELECT website_config.*, GROUP_CONCAT(domain.domain_name) as domain_name_list FROM website_config 
                        LEFT JOIN domain On FIND_IN_SET(domain.web_id, website_config.web_id ) 
                        GROUP BY website_config.web_id ";
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt;
    }

    function activeStatus(){
        $message = '';
        $query = "UPDATE website_config SET web_active = :web_active WHERE web_id = :web_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_active', $this->web_active, PDO::PARAM_INT);
        $stmt->bindParam(':web_id',     $this->web_id, PDO::PARAM_INT);

        if($stmt->execute()){
            $message = true;
            return $message;
        }
        else{
            $message = 'failure';
            return $message;
        }
    }

    function updateWebsite(){
        $allWeb = array();
        $total  = 0;
        $message='';

        $query ="SELECT * FROM website_config";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($allWeb, $row);
            }
        }
        foreach($allWeb as $web){
            if($web['web_name'] == $this->web_name ){
                $total+=1;
            }
        }
        if($total == 1){
            $query ="UPDATE website_config SET 
                    web_name        = :web_name,
                    web_icon        = :web_icon,
                    web_description = :web_description
                    WHERE web_id    = :web_id";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':web_name',        $this->web_name);
            $stmt->bindParam(':web_icon',        $this->web_icon);
            $stmt->bindParam(':web_description', $this->web_description);
            $stmt->bindParam(':web_id',          $this->web_id, PDO::PARAM_INT);
    
            if($stmt->execute()){
                $message = true;
                return $message;
            }
            else{
                $message = "Cannot Update Website!!";
                return $message;
            }
        }
        else{
            $message = "Web Name Or Domain Duplicate";
            return $message;
        }
    }

    function createWebsite(){
        $message='';
        $query ="SELECT web_name FROM website_config WHERE web_name = :web_name ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_name', $this->web_name);

        if($stmt->execute()===true){
            if($stmt->rowCount() == 0){
                $query = "INSERT INTO website_config (web_name, web_icon, web_description)
                          VALUES(:web_name, :web_icon, :web_description)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':web_name',        $this->web_name);
                $stmt->bindParam(':web_icon',        $this->web_icon);
                $stmt->bindParam(':web_description', $this->web_description);

                if($stmt->execute()){
                    $message = true;
                    return $message;
                }
                else{
                    $message = "Cannot create Website!!";
                    return $message;
                }
            }
            else{
                $message = "Web Name Or Domain Duplicate!";
                return $message;
            }
        }
        else{
            $message = "Something has wrong!";
            return $message;
        }
    }
}
?>