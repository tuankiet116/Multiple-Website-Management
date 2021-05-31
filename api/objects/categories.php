<?php
//require_once("../inc_security.php");
class Categories{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories_multi_parent";
  
    // object properties
    public $cmp_id;
    public $cmp_name;
    public $cmp_rewrite_name;
    public $cmp_icon;
    public $cmp_has_child;
    public $cmp_background;
    public $bgt_type;
    public $cmp_meta_description;
    public $cmp_active;
    public $cmp_parent_id;
    public $web_id;
    public $term;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function searchTermActive(){
        $count = 0;
        // query to read single record
        $query = "SELECT * FROM " .$this->table_name. " WHERE cmp_name LIKE '%".$this->term."%' AND web_id = :web_id AND cmp_active = 1";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id);
        
        //excute query
        $stmt->execute();

        return $stmt;
    }

    // function getLangByID(){
    //     $query = "SELECT * FROM " .$this->table_name. " WHERE lang_id = ?";
        
    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->lang_id);

    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->lang_name   = $row['lang_name'];
    //     $this->lang_path   = $row['lang_path'];
    //     $this->lang_image  = $row['lang_image'];
    //     $this->lang_domain = $row['lang_domain'];
    // }
}
?>