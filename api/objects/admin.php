<?php
class Admin
{
  
  // database connection and table name
    private $conn;

    // object properties
    public $username;
    public $password;

    //constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function checkLoginAdmin()
    {
        $query = "SELECT * FROM admin_user WHERE adm_loginname = :adm_loginname AND adm_password = :adm_password AND adm_isadmin = 1 AND adm_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':adm_loginname', $this->username);
        $stmt->bindParam(':adm_password', $this->password);
        if($stmt->execute() === true){
            if($stmt->rowCount() === 1){
                return true;
            }
        }

        return false;
    }
}

?>