<?php
class Domain
{
    private $conn;
    public $domain_id;
    public $domain_active;
    public $domain_name;
    public $web_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $message = array();
        //check if domain has existed?
        $query = "SELECT * FROM domain WHERE domain_name = :domain_name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':domain_name', $this->domain_name);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = array('code' => 2, 'message' => "The domain name has already existed!");
            return $message;
        } else {
            $query = "Insert Into domain(domain_name, web_id, domain_active) Values(:domain_name, :web_id, 1)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':domain_name', $this->domain_name);
            $stmt->bindParam(':web_id', $this->web_id);
            if ($stmt->execute() === true) {
                $message = array('code' => 200, 'message' => "Create Success");
                return $message;
            }
            $message = array('code' => 1, 'message' => "The system's got error while creating domain name");
            return $message;
        }
    }

    public function update()
    {
        $message = array();
        //Check Existed Domain
        $query = "SELECT * FROM domain WHERE domain_name =:domain_name AND domain_id != :domain_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':domain_name', $this->domain_name);
        $stmt->bindParam(':domain_id', $this->domain_id);
        if ($stmt->execute() === true) {
            if ($stmt->rowCount() === 0) {
                $query = "Update domain Set domain_name =:domain_name Where domain_id =:domain_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':domain_name', $this->domain_name);
                $stmt->bindParam(':domain_id', $this->domain_id);
                if ($stmt->execute() === true) {
                    return true;
                }
                $message = array('code' => 1, 'message' => "System's got error while Updating");
                return $message;
            } else {
                $message = array('code' => 2, 'message' => "Domain Name Has Existed.");
                return $message;
            }
        }
        $message = array('code' => 3, 'message' => "System's got error while get information for updating.");
        return $message;
    }

    public function getAll()
    {
        $query = "Select domain.*, web_name From domain INNER Join website_config On domain.web_id = website_config.web_id";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute() === true) {
            return $stmt;
        }
        return false;
    }

    public function getByID()
    {
        $query = "Select domain.*, web_name From domain INNER JOIN website_config ON domain.web_id = website_config.web_id AND domain_id = :domain_id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':domain_id', $this->domain_id);
        if ($stmt->execute() === true) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->domain_name   = $result['domain_name'];
            $this->web_id        = $result['web_id'];
            $this->web_name      = $result['web_name'];
            $this->domain_active = $result['domain_active'];
            return true;
        }
        return false;
    }

    public function getAllByWebID()
    {
        $query = "SELECT domain.*, web_name FROM domain INNER JOIN website_config ON domain.web_id = website_config.web_id AND domain.web_id = :web_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':web_id', $this->web_id);
        $stmt->execute();
        return $stmt;
    }

    public function ActiveInactiveDomain(){
        $query = "Update domain Set domain_active =:domain_active Where domain_id = :domain_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':domain_active', $this->domain_active, PDO::PARAM_INT);
        $stmt->bindParam(':domain_id', $this->domain_id);
        if($stmt->execute() === true){
            return true;
        }
        return false;
    }
}
