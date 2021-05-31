<?php
    class PostType{
        private $conn;
        private $table_name = "post_type";

        public $post_type_id;
        public $post_type_title;
        public $post_type_description;
        public $post_type_show;
        public $cmp_id;
        public $post_type_active;
        public $term;

        public function __construct($db){
            $this->conn = $db;
        }

        function searchTerm(){
            $query = "SELECT * FROM ".$this->table_name." WHERE post_type_title LIKE '%".$this->term."%' AND post_type_active = 1 AND cmp_id = :cmp_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cmp_id', $this->cmp_id);
            $stmt->execute();
            return $stmt;
        }
    }
?>