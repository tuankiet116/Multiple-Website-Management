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

        function searchTerm()
        {
            $query = "SELECT * FROM categories_multi_parent WHERE cmp_id = :cmp_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cmp_id', $this->cmp_id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $post_type_id = $row['post_type_id'];

            $query = "SELECT * FROM " . $this->table_name . " WHERE post_type_title LIKE '%" . $this->term . "%' AND post_type_active = 1 
                            AND post_type_id IN (" . $post_type_id . ")";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function getPostType($web_id){
            $query = "SELECT * FROM ".$this->table_name." WHERE web_id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $web_id);
            $stmt->execute();

            return $stmt;
        }

        public function create()
        {
            $message = "";
            $query = "SELECT * FROM post_type WHERE post_type_title =:post_type_title";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_type_title', $this->post_type_title);
            if($stmt->execute() === true) {
                $count = $stmt->rowCount();
                if($count === 0) {
                    $query = "INSERT INTO " . $this->table_name . "(post_type_title, post_type_description, post_type_show, post_type_active, 
                            allow_show_homepage, web_id) 
                            Values(:post_type_title, :post_type_description, :post_type_show, :post_type_active, :allow_show_homepage, :web_id)";
                    $stmt = $this->conn->prepare($query);

                    $stmt->bindParam(':post_type_title',            $this->post_type_title);
                    $stmt->bindParam(':post_type_description',      $this->post_type_description);
                    $stmt->bindParam(':post_type_show',             $this->post_type_show);
                    $stmt->bindParam(':post_type_active',           $this->post_type_active, PDO::PARAM_INT);
                    $stmt->bindParam(':allow_show_homepage',        $this->allow_show_homepage, PDO::PARAM_INT);
                    $stmt->bindParam(':web_id',                     $this->web_id);

                    if ($stmt->execute()) {
                        return true;
                    } else {
                        $message = "Cannot Create";
                        return $message;
                    }
                }
                else {
                    $message = "Duplicate Title Post Type";
                    return $message;
                }
            }
            else {
                $message = "Having Trouble";
                return $message;
            }
        }

        
        public function update()
        {
            $query_up = "SELECT * FROM post_type WHERE post_type_id = :post_type_id";
            $stmt_up = $this->conn->prepare($query_up);
            $stmt_up->bindParam(':post_type_id', $this->post_type_id);
            if ($stmt_up->execute() === true) {
                $query_pt = "UPDATE post_type
                            SET post_type_title            =:post_type_title, 
                                post_type_description      =:post_type_description,
                                post_type_show             =:post_type_show
                            WHERE post_type_id = :post_type_id ";
                $stmt_pt = $this->conn->prepare($query_pt);

                $stmt_pt->bindParam(':post_type_title'          , $this->post_type_title);
                $stmt_pt->bindParam(':post_type_description'    , $this->post_type_description);
                $stmt_pt->bindParam(':post_type_show'           , $this->post_type_show);
                $stmt_pt->bindParam(':post_type_id'             , $this->post_type_id);

                if ($stmt_pt->execute() === true) {
                    return true;
                }
                return $stmt_pt;

            } else {
                return $stmt_up;
            }
        }

        public function ActiveInactivePostType(){
            $query = "UPDATE ".$this->table_name." SET post_type_active =:post_type_active WHERE post_type_id =:post_type_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_type_id', $this->post_type_id);
            $stmt->bindParam(':post_type_active', $this->post_type_active, PDO::PARAM_INT);
            if($stmt->execute() === true){
                return true;
            }
            return false;
        }

        public function ActiveInactivePostTypeHome(){
            $query = "UPDATE ".$this->table_name. " SET allow_show_homepage =:allow_show_homepage WHERE post_type_id =:post_type_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_type_id', $this->post_type_id);
            $stmt->bindParam(':allow_show_homepage', $this->allow_show_homepage, PDO::PARAM_INT);
            if($stmt->execute() === true){
                return true;
            }
            return false;
        }

        public function getAll(){
            $query_website = "";
            if($this->web_id != "" || $this ->web_id != null){
                $query_website = " AND website_config.web_id = ".$this->web_id;
            }
            $query = "SELECT post_type.post_type_id , post_type.post_type_title , post_type.post_type_description, 
                             post_type.post_type_show, website_config.web_name, post_type.post_type_active, 
                             post_type.allow_show_homepage, post_type.web_id, cmp.cmp_id, cmp.cmp_name, cmp.cmp_has_child, cmp.cmp_active
                      FROM post_type 
                      INNER JOIN categories_multi_parent cmp  ON  FIND_IN_SET(post_type.post_type_id, cmp.post_type_id) AND post_type.web_id = cmp.web_id 
                      INNER JOIN website_config ON website_config.web_id = post_type.web_id ".$query_website.
                      " WHERE post_type.post_type_title   LIKE '%" .$this->term. "%'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getPostTypeByID($getData = true){
            $query = 'SELECT * FROM post_type WHERE post_type_id = :post_type_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_type_id', $this->post_type_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($getData === true){
                $this->post_type_id               = $row['post_type_id'];
                $this->post_type_title            = $row['post_type_title'];
                $this->post_type_description      = $row['post_type_description'];
                $this->post_type_show             = $row['post_type_show'];
                $this->post_type_active           = $row['post_type_active'];
                $this->allow_show_homepage        = $row['allow_show_homepage'];
                $this->web_id                     = $row['web_id'];
            }
            else{
                return $stmt->rowCount();
            }
        }
    }
?>