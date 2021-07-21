<?php
require_once('./user.php');
class Cart
{
    private $conn;

    public $cart_id;
    public $user_id;
    public $cart_active;
    public $product_id;
    public $cart_price;
    public $cart_quantity;
    public $user_token;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    private function validateToken()
    {
        $user_token = new userToken();
        $user_token->token = $this->user_token;
        if ($user_token->validation() === true) {
            $this->user_id = $user_token->user_id;
            $this->user_token = $user_token->tokenId;
            return true;
        } else {
            return false;
        }
    }

    public function getCart(){
        if($this->validateToken() === true){

        }
        else{
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }

    public function addCart(){
        if($this->validateToken() === true){
            
        }
        else{
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }

    public function removeCart(){
        if($this->validateToken() === true){

        }
        else{
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }
}