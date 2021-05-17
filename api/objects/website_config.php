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
}
?>