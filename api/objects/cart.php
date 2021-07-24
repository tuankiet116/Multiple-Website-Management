<?php
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
    public $web_id;
    public $URI;

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

    private function getProductPrice()
    {
        $query = "SELECT product_price FROM product WHERE product_id =:product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->execute();
        if ($stmt->rowCount() === 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $product_price = $result['product_price'];
            $this->cart_price = $product_price;
            return true;
        }
        return false;
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

    public function getCart()
    {
        if ($this->validateToken() === true) {
            $query = 'SELECT cart.*, product.product_name, product.product_image_path FROM cart 
                      INNER JOIN product ON product.product_id = cart.product_id 
                                            AND cart.user_id =:user_id 
                                            AND cart.web_id =:web_id 
                                            AND product.web_id =:web_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $item = array(
                        'cart_id'            => $row['cart_id'],
                        'product_id'         => $row['product_id'],
                        'cart_price'         => $row['cart_price'],
                        'cart_quantity'      => $row['cart_quantity'],
                        'product_name'       => $row['product_name'],
                        'product_image_path' => $row['product_image_path']
                    );
                    array_push($data, $item);
                }
                $message = array('code' => 200,'quantity'=> $stmt->rowCount(), 'data' => $data);
                return $message;
            } else {
                $message = array('code' => 404,'quantity'=> 0, 'message' => 'Cart is empty.');
                return $message;
            }
        } else {
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }

    /**
     * Undocumented function
     *
     * @return array 
     * 
     * - code 200: success
     * - code 500: error
     * - code 403: token expired
     */
    public function addCart()
    {
        if ($this->validateToken() === true) {
            $query = "SELECT * FROM cart WHERE user_id =:user_id AND product_id =:product_id AND cart_active = 1 AND web_id =:web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                if ($this->getProductPrice() === true) {
                    $query = "INSERT INTO cart(user_id, product_id, cart_price, web_id, cart_quantity, cart_active) 
                              VALUES(:user_id, :product_id, :cart_price, :web_id, 1, 1)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':user_id', $this->user_id);
                    $stmt->bindParam(':product_id', $this->product_id);
                    $stmt->bindParam(':cart_price', $this->cart_price);
                    $stmt->bindParam(':web_id', $this->web_id);
                    if ($stmt->execute() === true) {
                        $message = array('code' => 200, 'message' => "Add Product To Cart Success");
                        return $message;
                    } else {
                        $message = array('code' => 500, 'message' => "Error while create cart");
                        return $message;
                    }
                } else {
                    $message = array('code' => 500, 'message' => "Error while getting product information");
                    return $message;
                }
            } else {
                if ($this->getProductPrice() === true) {
                    $query = "UPDATE cart SET cart_quantity = cart_quantity+1 WHERE user_id =:user_id AND product_id =:product_id AND web_id =:web_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':user_id', $this->user_id);
                    $stmt->bindParam(':product_id', $this->product_id);
                    $stmt->bindParam(':web_id', $this->web_id, PDO::PARAM_INT);
                    if ($stmt->execute() === true) {
                        $message = array('code' => 200, 'message' => "Add Product To Cart Success");
                        return $message;
                    } else {
                        $message = array('code' => 500, 'message' => "Error update cart");
                        return $message;
                    }
                } else {
                    $message = array('code' => 500, 'message' => "Error while getting product information");
                    return $message;
                }
            }
        } else {
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }

    /**
     * Undocumented function
     *
     * @return array 
     * 
     * - code 200: success
     * - code 500: error
     * - code 403: token expired
     */
    public function removeCart()
    {
        if ($this->validateToken() === true) {
            $query = "SELECT * FROM cart WHERE user_id =:user_id AND product_id =:product_id AND cart_active = 1 AND web_id =:web_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':web_id', $this->web_id);
            $stmt->execute();
            if ($stmt->rowCount() === 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->cart_quantity = $result['cart_quantity'];
                $this->cart_id = $result['cart_id'];
                if ($this->cart_quantity > 1) {
                    $query = "UPDATE cart SET cart_quantity = cart_quantity-1 WHERE cart_id =:cart_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':cart_id', $this->cart_id);
                    if ($stmt->execute() === true) {
                        $message = array('code' => 200, 'message' => "Remove Quantity Success");
                        return $message;
                    } else {
                        $message = array('code' => 500, 'message' => "Error updating cart");
                        return $message;
                    }
                } else {
                    $query = "DELETE FROM cart WHERE cart_id =:cart_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':cart_id', $this->cart_id);
                    if ($stmt->execute() === true) {
                        $message = array('code' => 200, 'message' => "Remove Product In Cart Success");
                        return $message;
                    } else {
                        $message = array('code' => 500, 'message' => "Error updating cart");
                        return $message;
                    }
                }
            }
            else{
                $message = array('code' => 400, 'message' => "Cart Not Found Or Product has removed");
                return $message;
            }
        } else {
            $message = array('code' => 403, 'message' => "You need to login!");
            return $message;
        }
    }
}
