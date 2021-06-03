<?php
    class PostType{
        private $conn;
        private $table_name = "post_type";

        public $post_type_id;
        public $post_type_title;
        public $post_type_description;
        public $post_type_show;
        public $post_type_active;
        public $allow_show_homepage;
        public $web_id;
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }

        function searchTerm(){
            $query = "SELECT * FROM categories_multi_parent WHERE cmp_id = :cmp_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cmp_id', $this->cmp_id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $post_type_id = $row['post_type_id'];

            $query = "SELECT * FROM ".$this->table_name." WHERE post_type_title LIKE '%".$this->term."%' AND post_type_active = 1 
                        AND post_type_id IN (".$post_type_id.")";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        function getPostType($web_id){
            $query = "SELECT * FROM ".$this->table_name." WHERE web_id = ? AND post_type_active = 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $web_id);
            $stmt->execute();

            return $stmt;
        }


    }
?>