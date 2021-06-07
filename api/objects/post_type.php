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

        function getPostType($web_id){
            $query = "SELECT * FROM ".$this->table_name." WHERE web_id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $web_id);
            $stmt->execute();

            return $stmt;
        }

        public function create()
        {
            $query = "INSERT INTO " . $this->table_name . "(post_type_title, post_type_description, post_type_show, post_type_active, 
                    allow_show_homepage, web_id) 
                    Values(:post_type_title, :post_type_description, :post_type_show, :post_type_active, :allow_show_homepage, :web_id)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_type_title',            $this->post_type_title);
            $stmt->bindParam(':post_type_description',      $this->post_type_description);
            $stmt->bindParam(':post_type_show',             $this->post_type_show);
            $stmt->bindParam(':post_type_active',           $this->post_type_active);
            $stmt->bindParam(':allow_show_homepage',        $this->allow_show_homepage);
            $stmt->bindParam(':web_id',                     $this->web_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return $stmt;
            }
        }

        
        // public function update()
        // {
        //     $query_ptd = "SELECT ptd_id FROM post WHERE post_id = :post_id";
        //     $stmt_ptd = $this->conn->prepare($query_ptd);
        //     $stmt_ptd->bindParam(':post_id', $this->post_id);
        //     if ($stmt_ptd->execute() === true) {
        //         $row = $stmt_ptd->fetch(PDO::FETCH_ASSOC);
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

    }
?>