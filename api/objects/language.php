<?php
//require_once("../inc_security.php");
class LanguageConfig{
  
    // database connection and table name
    private $conn;
    private $table_name = "languages";
  
    // object properties
    public $lang_id;
    public $lang_name;
    public $lang_path;
    public $lang_image;
    public $lang_domain;
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
            $query = "SELECT * FROM " .$this->table_name. " WHERE lang_name LIKE '%".$this->term."%'";
        }
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //excute query
        $stmt->execute();

        return $stmt;
    }
}
?>