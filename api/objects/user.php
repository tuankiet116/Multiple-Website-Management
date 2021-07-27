<?php

class User
{
    private $conn;
    private $web_id;

    public $user_id;
    public $user_name;
    public $user_password;
    public $user_newpassword;
    public $user_number_phone;
    public $user_email;
    public $user_address;
    public $user_token;
    public $token;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setWebID($url)
    {
        $get_url_1 = explode("//", $url);
        $get_url_2 = explode("/", $get_url_1[1]);
        $get_url_3 = explode(":", $get_url_2[0]);
        $main_url = $get_url_3[0];
        $query = "SELECT domain.domain_name, wc.* FROM domain 
                    INNER JOIN website_config wc ON wc.web_id = domain.web_id 
                                                AND domain.domain_name = :url 
                                                AND domain.domain_active = 1 
                                                AND wc.web_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':url', $main_url);
        if ($stmt->execute() === true) {
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->web_id = $result['web_id'];
                return true;
            }
            return false;
        }
        return false;
    }

    public function login()
    {
        $message = "";
        $password = md5($this->user_password);

        $query = "SELECT * FROM user_tb WHERE user_name = :user_name AND user_password = :user_password AND web_id =:web_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_name',      $this->user_name);
        $stmt->bindParam(':user_password',  $password);
        $stmt->bindParam(':web_id',         $this->web_id);

        if ($stmt->execute() === true) {
            if ($stmt->rowCount() === 1) {
                $result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $user_id    = $result['user_id'];
                $userData   = array(
                    'user_name'         => $this->user_name,
                    'user_number_phone' => $result['user_number_phone'],
                    'user_email'        => $result['user_email'],
                    'user_address'      => $result['user_address']
                );
                $userToken  = new userToken();
                $userToken->web_id = $this->web_id;
                $this->token = $userToken->createToken($user_id, $userData);
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

    public function logout()
    {
        if ($this->validateToken() === true) {
            $query = "UPDATE user_tb SET user_token = '' WHERE user_token =:user_token AND web_id =:web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_token',   $this->user_token);
            $stmt->bindParam(':web_id',       $this->web_id);
            $stmt->execute();
        }
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
                              user_address, web_id)
                              Values(:user_id, :user_name, :user_password, :user_email, :user_number_phone, :user_address, :web_id)";
                $stmt = $this->conn->prepare($query);
                $password = md5($this->user_password);

                $stmt->bindParam(':user_id',              $user_id);
                $stmt->bindParam(':user_name',            $this->user_name);
                $stmt->bindParam(':user_password',        $password);
                $stmt->bindParam(':user_email',           $this->user_email);
                $stmt->bindParam(':user_number_phone',    $this->user_number_phone);
                $stmt->bindParam(':user_address',         $this->user_address);
                $stmt->bindParam(':web_id',               $this->web_id);

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

    public function getInformation()
    {
        if ($this->validateToken() === true) {
            $query = 'SELECT * FROM user_tb WHERE user_id =:user_id AND user_token =:user_token AND web_id =:web_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':user_token', $this->user_token);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->user_name = $row['user_name'];
                $this->user_address = $row['user_address'];
                $this->user_email = $row['user_email'];
                $this->user_number_phone = $row['user_number_phone'];
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function updateInformation()
    {
        if ($this->validateToken() === true) {
            if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL) != true) {
                $message = array('code' => 1, 'message' => "Email's not valid");
                return $message;
            } else if ($this->user_address == "" || $this->user_address == NULL) {
                $message = array('code' => 2, 'message' => "Address's empty");
                return $message;
            } else if ($this->user_number_phone == "" || $this->user_number_phone == NULL) {
                $message = array('code' => 3, 'message' => "Phone number's empty.");
                return $message;
            } else {
                $query = 'UPDATE user_tb SET user_number_phone =:user_number_phone, user_address =:user_address, user_email =:user_email
                        WHERE user_token =:user_token AND web_id =:web_id';
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':user_number_phone', $this->user_number_phone);
                $stmt->bindParam(':user_address', $this->user_address);
                $stmt->bindParam(':user_email', $this->user_email);
                $stmt->bindParam(':user_token', $this->user_token);
                $stmt->bindParam(':web_id', $this->web_id);
                if ($stmt->execute() === true) {
                    $message = array('code' => 200, 'message' => 'update information success');
                    return $message;
                }
                $message = array('code' => 500, 'message' => "System's got error, login and try again!");
                return $message;
            }
        } else {
            $message = array('code' => 403, 'message' => "Your token has expired. Login and try again!");
            return $message;
        }
    }

    public function updatePassword()
    {
        if ($this->validateToken() === true) {
            if ($this->user_newpassword == "" || $this->user_newpassword == NULL) {
                $message = array('code' => 400, 'message' => "New password's empty");
                return $message;
            } else if ($this->user_password == NULL || $this->user_password == "") {
                $message = array('code' => 402, 'message' => "Old password's empty");
                return $message;
            } else {
                $query = 'UPDATE user_tb SET user_password =:new_password WHERE user_password =:old_password AND user_token =:user_token AND web_id =:web_id';
                $stmt = $this->conn->prepare($query);
                $this->user_newpassword = md5($this->user_newpassword);
                $this->user_password    = md5($this->user_password);
                $stmt->bindParam(':new_password', $this->user_newpassword);
                $stmt->bindParam(':old_password', $this->user_password);
                $stmt->bindParam(':user_token', $this->user_token);
                $stmt->bindParam(':web_id', $this->web_id);
                if ($stmt->execute() === true) {
                    if($stmt->rowCount() === 1){
                        $message = array('code' => 200, 'message' => 'Update Password Success');
                        return $message;
                    }
                    else{
                        $message = array('code' => 404, 'message' => 'Wrong Password');
                        return $message;
                    }
                } else {
                    $message = array('code' => 500, 'message' => "System's got error");
                    return $message;
                }
            }
        } else {
            $message = array('code' => 403, 'message' => 'Token expired.');
            return $message;
        }
    }

    public function checkTokenHasNotExpired()
    {
        if ($this->validateToken() === true) {
            return true;
        }
        return false;
    }

    private function validateToken()
    {
        $user_token = new userToken();
        $user_token->token = $this->user_token;
        $user_token->web_id = $this->web_id;
        if ($user_token->validation() === true) {
            $this->user_id = $user_token->user_id;
            $this->user_token = $user_token->tokenId;
            return true;
        } else {
            return false;
        }
    }
}
