<?php
class User
{
    private $conn;

    public $user_id;
    public $user_name;
    public $user_password;
    public $user_number_phone;
    public $user_email;
    public $user_address;
    public $user_token;
    public $token;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {
        $message = "";
        $password = md5($this->user_password);

        $query = "SELECT * FROM user_tb WHERE user_name = :user_name AND user_password = :user_password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':user_password', $password);

        if ($stmt->execute() === true) {
            if ($stmt->rowCount() === 1) {
                $result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $user_id    = $result['user_id'];
                $userToken  = new userToken();
                $userData   = array(
                    'user_name'         => $this->user_name,
                    'user_number_phone' => $result['user_number_phone'],
                    'user_email'        => $result['user_email'],
                    'user_address'      => $result['user_address']
                );
                $this->token= $userToken->createToken($user_id, $userData);
                return true;
            } else {
                $message = array(
                    'message' => "Error account or password",
                    'code'    => 3
                );
            }
        } else {
            $message = array(
                'message' => "Server's got error while loging in",
                'code'    => 4
            );
        }
        return $message;
    }

    public function signUp()
    {
        $message = "";
        $query = "SELECT * FROM user_tb WHERE user_name = :user_name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_name',      $this->user_name);
        $user_id = "";

        if ($stmt->execute() === true) {
            $count = $stmt->rowCount();
            if ($count === 0) {
                $count_id = 1;
                while ($count_id !== 0) {
                    $user_id = uniqid();
                    $query_id = "SELECT * FROM user_tb WHERE user_id = :user_id";
                    $stmt_id = $this->conn->prepare($query_id);
                    $stmt_id->bindParam(':user_id',     $user_id);
                    if ($stmt_id->execute() === true) {
                        $count_id = $stmt_id->rowCount();
                    } else {
                        $message = "The system's got error while creating ID user";
                        return $message;
                    }
                }

                $query = "INSERT INTO user_tb (user_id, user_name, user_password, user_email, user_number_phone,
                              user_address)
                              Values(:user_id, :user_name, :user_password, :user_email, :user_number_phone, :user_address)";
                $stmt = $this->conn->prepare($query);
                $password = md5($this->user_password);

                $stmt->bindParam(':user_id',              $user_id);
                $stmt->bindParam(':user_name',            $this->user_name);
                $stmt->bindParam(':user_password',        $password);
                $stmt->bindParam(':user_email',           $this->user_email);
                $stmt->bindParam(':user_number_phone',    $this->user_number_phone, PDO::PARAM_INT);
                $stmt->bindParam(':user_address',         $this->user_address);

                if ($stmt->execute() === true) {
                    return true;
                } else {
                    $code = 1;
                    $message = "Cannot sign up";
                    return array('code' => $code, 'message' => $message);
                }
            } else {
                $code = 2;
                $message = "Duplicate account";
                return array('code' => $code, 'message' => $message);
            }
        } else {
            $message = "Something has wrong while creating user account";
            return $message;
        }
    }

    private function checkTokenExist($token, $user_id){
        $query = "Select * From user_tb Where user_token =:user_token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_token', $token);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $query = "Update user_tb SET user_token =:user_token Where user_id =:user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_token', $token);
            $stmt->bindParam(':user_id'   , $user_id);
            if($stmt->execute()==true){
                return true;
            }
            return false;
        }
        return false;
    }

    public function checkTokenUser($token){

    }
}

?>
