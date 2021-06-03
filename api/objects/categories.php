<?php
//require_once("../inc_security.php");

use function Aws\flatmap;

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
    public $post_type_id;
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
        $message ='';
        $query = "UPDATE categories_multi_parent SET cmp_has_child = 1 WHERE cmp_id = :cmp_parent_id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cmp_parent_id", $this->cmp_parent_id, PDO::PARAM_INT);

        if($stmt->execute()===true){

            $query = "INSERT INTO categories_multi_parent(cmp_name, cmp_rewrite_name, cmp_icon, cmp_has_child, 
                  cmp_background, bgt_type, cmp_meta_description, cmp_active, cmp_parent_id, web_id, post_type_id)
                  Values(?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1,  $this->cmp_name);
            $stmt->bindParam(2,  $this->cmp_rewrite_name);
            $stmt->bindParam(3,  $this->cmp_icon);
            $stmt->bindParam(4,  $this->cmp_has_child, PDO::PARAM_INT);
            $stmt->bindParam(5,  $this->cmp_background);
            $stmt->bindParam(6,  $this->bgt_type);
            $stmt->bindParam(7,  $this->cmp_meta_description);
            $stmt->bindParam(8,  $this->cmp_active, PDO::PARAM_INT);
            $stmt->bindParam(9,  $this->cmp_parent_id, PDO::PARAM_INT);
            $stmt->bindParam(10, $this->web_id, PDO::PARAM_INT);
            $stmt->bindParam(11, $this->post_type_id);

            if($stmt->execute()){
                $message = true;
            }
            else{
                $message = 'Cannot Create Category';
            }
        }
        else{
            $message = 'Cannot Update Category Parent';
        }
        return $message;
    }

    function updateCategories(){
        $query = "UPDATE categories_multi_parent SET 
                 cmp_name             = :cmp_name
                 cmp_rewrite_name     = :cmp_rewrite_name
                 cmp_icon             = :cmp_icon
                 cmp_has_child        = :cmp_has_child
                 cmp_background       = :cmp_background
                 bgt_type             = :bgt_type
                 cmp_meta_description = :cmp_meta_description
                 cmp_active           = :cmp_active
                 cmp_parent_id        = :cmp_parent_id
                 post_type_id         = :post_type_id
                 WHERE web_id         = :web_id";

        $stmt =  $this->conn->prepare($query);

        $stmt->bindParam(':cmp_name',             $this->cmp_name);
        $stmt->bindParam(':cmp_rewrite_name',     $this->cmp_rewrite_name);
        $stmt->bindParam(':cmp_icon',             $this->cmp_icon);
        $stmt->bindParam(':cmp_has_child',        $this->cmp_has_child);
        $stmt->bindParam(':cmp_background',       $this->cmp_background);
        $stmt->bindParam(':bgt_type',             $this->bgt_type);
        $stmt->bindParam(':cmp_meta_description', $this->cmp_meta_description);
        $stmt->bindParam(':cmp_active',           $this->cmp_active);
        $stmt->bindParam(':cmp_parent_id',        $this->cmp_parent_id);
        $stmt->bindParam(':post_type_id',         $this->post_type_id);
        $stmt->bindParam(':web_id',               $this->web_id);

        if($stmt->execute()){
            return true;
        }
        return $stmt;
    }

    function searchTermActive(){
        $query = "SELECT * FROM categories_multi_parent WHERE web_id = :web_id AND cmp_name LIKE '%" .$this->term. "%'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id',  $this->web_id, PDO::PARAM_INT);
        
        return $stmt;
    }
}
?>
