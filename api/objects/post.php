<?php
    class Post{
        private $conn;
        private $table = 'post';

        public $post_id;
        public $post_title;
        public $post_description;
        public $post_image_background;
        public $post_color_background;
        public $post_meta_description;
        public $post_rewrite_name;
        public $cmp_id;
        public $ptd_id; //post detail ID
        public $post_type_id;
        public $product_id;
        public $post_date_time_create;
        public $post_date_time_update;
        public $content;
        public $term;
        public $web_id;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            
            $query = "INSERT INTO post_detail (ptd_text) Values(:ptd_text)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ptd_text', $this->content);
            $stmt->execute();
            $this->ptd_id = $this->conn->lastInsertId();

            $query = "INSERT INTO ".$this->table."(post_title, post_description, post_image_background,
                        post_color_background, post_meta_description, post_rewrite_name, cmp_id, 
                        ptd_id, post_type_id, product_id) 
                        VALUES(:post_title, :post_description, :post_image_background,
                        :post_color_background, :post_meta_description, :post_rewrite_name, :cmp_id, 
                        :ptd_id, :post_type_id, :product_id)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':post_title',            $this->post_title);
            $stmt->bindParam(':post_description',      $this->post_description);
            $stmt->bindParam(':post_image_background', $this->post_image_background);
            $stmt->bindParam(':post_color_background', $this->post_color_background);
            $stmt->bindParam(':post_meta_description', $this->post_meta_description);
            $stmt->bindParam(':post_rewrite_name',     $this->post_rewrite_name);
            $stmt->bindParam(':cmp_id',                $this->cmp_id);
            $stmt->bindParam(':ptd_id',                $this->ptd_id);
            $stmt->bindParam(':post_type_id',          $this->post_type_id);
            $stmt->bindParam(':product_id',            $this->product_id);

            if($stmt->execute()){
                return true;
            }
            else{
                return $stmt;
            }
        }

        public function getAll(){
            $query_website = "";
            if($this->web_id != "" || $this ->web_id != null){
                $query_website = " AND website_config.web_id = ".$this->web_id;
            }
            $query = "SELECT post.post_id , post.post_title , post.post_description, post_type.post_type_title, 
                             product.product_name, website_config.web_name, post.post_active, website_config.web_id 
                      FROM post
                      LEFT JOIN post_type       ON post.post_type_id     = post_type.post_type_id  
                      LEFT JOIN product         ON post.product_id       = product.product_id  
                      INNER JOIN website_config ON website_config.web_id = post_type.web_id ".$query_website.
                      " WHERE product.product_name        LIKE '%" .$this->term. "%' 
                            OR post_type.post_type_title  LIKE '%" .$this->term. "%' 
                            OR post.post_title            LIKE '%" .$this->term. "%'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getPostByID(){
            $query = 'SELECT * FROM post WHERE post_id = :post_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':post_id', $this->post_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->post_id               = $row['post_id'];
            $this->post_title            = $row['post_title'];
            $this->post_description      = $row['post_description'];
            $this->post_image_background = $row['post_image_background'];
            $this->post_color_background = $row['post_color_background'];
            $this->post_meta_description = $row['post_meta_description'];
            $this->post_rewrite_name     = $row['post_rewrite_name'];
            $this->cmp_id                = $row['cmp_id'];
            $this->ptd_id                = $row['ptd_id'];
            $this->post_type_id          = $row['post_type_id'];
            $this->product_id            = $row['product_id'];
            $this->post_datetime_create  = $row['post_datetime_create'];
            $this->post_datetime_update  = $row['post_datetime_update'];

            $query = 'SELECT * FROM post_detail WHERE ptd_id = :ptd_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ptd_id', $this->ptd_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->content = $row['ptd_text'];
        }
    }
?>