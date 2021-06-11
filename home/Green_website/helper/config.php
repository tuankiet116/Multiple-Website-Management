<?php
require_once("../../classes/config_database.php");
class Database{
  
    // specify your own database credentials
    private $host     = DATABASE_HOST;
    private $db_name  = DATABASE_NAME;
    private $username = DATABASE_USERNAME;
    private $password = DATABASE_PASSWORD;
    public  $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>
