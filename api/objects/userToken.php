<?php

use Firebase\JWT\JWT;

require_once('../../vendor/autoload.php');
require_once('../config/database.php');

class userToken
{
    private $secretKey;
    private $serverName = "www.vveco.vn";
    private $lifetime = '+300 minutes';
    private $conn;

    public $user_id;

    public function __construct()
    {
        $database   = new ConfigAPI();
        $this->conn = $database->getConnection();
        $this->getSecretKey();
    }

    private function getSecretKey()
    {
        $json_data  = file_get_contents("../../config.json");
        $array      = json_decode($json_data, true);
        $secretKey  = $array['secret_key'];
        $this->secretKey = $secretKey;
    }

    /**
     * @param array  $data
     * @param string $user_id
     * @return token
     */
    public function createToken($user_id, $data)
    {
        $tokenId    = base64_encode(random_bytes(16));
        while ($this->checkTokenExist($tokenId, $user_id) == false) {
            $tokenId    = base64_encode(random_bytes(16));
        }

        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify($this->lifetime)->getTimestamp(); // Add 60 seconds
        $serverName = $this->serverName;                                  // Retrieved from filtered POST data

        // Create the token as an array
        $data = [
            'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
            'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,                  // Issuer
            'nbf'  => $issuedAt->getTimestamp(),    // Not before
            'exp'  => $expire,                      // Expire
            'data' => $data                         // Data related to the signer user
        ];

        // Encode the array to a JWT string.
        $token = JWT::encode(
            $data,            //Data to be encoded in the JWT
            $this->secretKey, // The signing key
            'HS512'           // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        return $token;
    }

    private function checkTokenExist($token, $user_id)
    {
        $query = "Select * From user_tb Where user_token =:user_token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_token', $token);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $query = "Update user_tb SET user_token =:user_token Where user_id =:user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_token', $token);
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute() == true) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function validation()
    {

    }
}
