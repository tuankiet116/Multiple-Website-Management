<?php
    class User {
        private $conn;

        public $user_id;
        public $user_name;
        public $user_password;

        public function __construct($db){
            $this->conn = $db;
        }
        
        function login() 
        {
            $message = "";
            $query = "SELECT user_name, user_password FROM user_tb WHERE user_name = :user_name AND user_password = :user_password";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_name', $this->user_name);
            $stmt->bindParam(':user_password', md5($this->user_password));
           
            if ($stmt->execute() === true) {
                if($stmt->rowCount() === 1){
                    return true;
                }
                else{
                    $message = "Cannot login!";
                }
            }
            else{
                $message = "Something has wrong!?";
            }
            return $message;
        }
    }
?>