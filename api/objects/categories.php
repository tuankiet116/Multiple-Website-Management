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

    function getCategories($web_id){
        
        $query = "SELECT * FROM " .$this->table_name. " WHERE web_id = ?";
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $web_id);
        
        $stmt->execute();
        return $stmt;
    }

    function creatCategories(){
        $query = "INSERT INSERT INTO categories_multi_parent(cmp_id, cmp_name, cmp_rewrite_name, cmp_icon, cmp_has_child, 
                  cmp_background, bgt_type, cmp_meta_description, cmp_active, cmp_parent_id, web_id, post_type_id)
                  Values(?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(1,  $this->cmp_id, PDO::PARAM_INT);
        $stmt->bindParam(2,  $this->cmp_name);
        $stmt->bindParam(3,  $this->cmp_rewrite_name);
        $stmt->bindParam(4,  $this->cmp_icon);
        $stmt->bindParam(5,  $this->cmp_has_child, PDO::PARAM_INT);
        $stmt->bindParam(6,  $this->cmp_background);
        $stmt->bindParam(7,  $this->bgt_type);
        $stmt->bindParam(8,  $this->cmp_meta_description);
        $stmt->bindParam(9,  $this->cmp_active, PDO::PARAM_INT);
        $stmt->bindParam(10, $this->cmp_parent_id, PDO::PARAM_INT);
        $stmt->bindParam(11, $this->web_id, PDO::PARAM_INT);
        $stmt->bindParam(12, $this->post_type_id);

        if($stmt->execute()){
            return true;
        }
        return false;
         
    }

    function searchTermActive(){
        $query = "SELECT * FROM categories_multi_parent WHERE web_id = :web_id AND cmp_name LIKE '%" .$this->term. "%'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id',  $this->web_id, PDO::PARAM_INT);
        
        return $stmt;
    }
}
?>