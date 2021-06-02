<?php
    class PostDetail{
        private $conn;
        private $table = 'post_detail';

        public $ptd_id;
        public $ptd_text;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        
    }
?>