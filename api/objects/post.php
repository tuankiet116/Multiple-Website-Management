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
    }
?>