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
    public $web_url;
    public $web_icon;
    public $web_description;
    public $term;
    public $result;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function searchTerm($query){
        $count = 0;
        // query to read single record
        if(!isset($query)){
            $query = "SELECT * FROM " .$this->table_name. " WHERE web_name LIKE '%".$this->term."%'";
        }
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //excute query
        $stmt->execute();

        return $stmt;
    }

    function getWebsiteByID(){
        $query = "SELECT * FROM " .$this->table_name. " WHERE web_id =:web_id ";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id);
        
        //excute query
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->web_name        = $row['web_name'];
            $this->web_active      = $row['web_active'];
            $this->web_icon        = $row['web_icon'];
            $this->web_description = $row['web_description'];
            return true;
        }
        return false;
    }
}
?>