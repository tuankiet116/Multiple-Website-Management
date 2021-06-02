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

        function getPostType ($web_id){
            $query = "SELECT * FROM".$this->table_name."WHERE web_id=?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $web_id);

            $stmt->execute();

            return $stmt;
        }

        
    }
?>