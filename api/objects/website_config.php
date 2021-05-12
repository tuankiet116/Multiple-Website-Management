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
    public $term;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function searchTerm(){
        $count = 0;
        // query to read single record
        $query = "SELECT * FROM " .$this->table_name. " WHERE web_name LIKE '%".$this->term."%'";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //excute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->web_id     = $row['web_id'];
        $this->web_name   = $row['web_name'];
        $this->web_active = $row['web_active'];
        $this->web_url    = $row['web_url'];
    }
}
?>