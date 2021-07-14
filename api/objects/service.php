<?php
    class Service{
        private $conn;

        public $service_id;
        public $service_name;
        public $service_description;
        public $service_content;
        public $service_gr_id;

        public function __construct($db){
            $this->conn = $db;
        }

        
    }
?>