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

        // public function update()
        // {
        //     $query_up = "SELECT * FROM post_type WHERE post_type_title =:post_type_title";
        //     $stmt_up = $this->conn->prepare($query);
        //     $stmt_up->bindParam(':post_type_title', $this->post_type_title);
        //     if ($stmt_up->execute() === true) {
        //         $row = $stmt_up->fetch(PDO::FETCH_ASSOC);
        //         $ptd_id = $row['ptd_id'];

        //         $query = "UPDATE post_detail SET ptd_text = :ptd_text  WHERE ptd_id = :ptd_id";
        //         $stmt = $this->conn->prepare($query);
        //         $stmt->bindParam(':ptd_id', $ptd_id);
        //         $stmt->bindParam(':ptd_text', $this->content);

        //         if ($stmt->execute() === true) {
        //             $query_post = "UPDATE post
        //                         SET post_title            =:post_title, 
        //                             post_description      =:post_description,
        //                             post_image_background =:post_image_background, 
        //                             post_color_background =:post_color_background,
        //                             post_meta_description =:post_meta_description, 
        //                             post_rewrite_name     =:post_rewrite_name,
        //                             product_id            =:product_id,
        //                             post_datetime_update  = CURRENT_TIMESTAMP() 
        //                         WHERE post_id = :post_id ";
        //             $stmt_post = $this->conn->prepare($query_post);

        //             $stmt_post->bindParam(':post_title', $this->post_title);
        //             $stmt_post->bindParam(':post_description', $this->post_description);
        //             $stmt_post->bindParam(':post_image_background', $this->post_image_background);
        //             $stmt_post->bindParam(':post_color_background', $this->post_color_background);
        //             $stmt_post->bindParam(':post_meta_description', $this->post_meta_description);
        //             $stmt_post->bindParam(':post_rewrite_name', $this->post_rewrite_name);
        //             $stmt_post->bindParam(':product_id', $this->product_id);
        //             $stmt_post->bindParam(':post_id', $this->post_id);

        //             if ($stmt_post->execute() === true) {
        //                 return true;
        //             }
        //             return $stmt_post;
        //         } else {
        //             return $stmt;
        //         }
        //     } else {
        //         return $stmt_ptd;
        //     }
        // }

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
                             post_type.allow_show_homepage, post_type.web_id 
                      FROM post_type 
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