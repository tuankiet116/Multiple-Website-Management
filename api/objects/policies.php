<?php
class Policies
{
    private $conn;
    private $table = 'policies';

    public $policies_id;
    public $policies_title;
    public $policies_image;
    public $policies_meta_description;
    public $policies_content;
    public $policies_rewrite_name;
    public $policies_active;
    public $policies_datetime_create;
    public $policies_datetime_update;
    public $term;
    public $web_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createPolicies()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE web_id = :web_id AND policies_title = :policies_title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
        $stmt->bindParam(":policies_title", $this->policies_title,);

        if ($stmt->execute() === true) {
            if ($stmt->rowCount() === 0) {
                $query = "INSERT INTO " . $this->table . " (policies_title, policies_description, policies_image, policies_meta_description, 
                                policies_content, policies_rewrite_name, web_id)
                              VALUES (:policies_title, :policies_description, :policies_image, :policies_meta_description, 
                                        :policies_content, :policies_rewrite_name, :web_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":policies_title", $this->policies_title);
                $stmt->bindParam(":policies_description", $this->policies_description);
                $stmt->bindParam(":policies_image", $this->policies_image);
                $stmt->bindParam(":policies_meta_description", $this->policies_meta_description);
                $stmt->bindParam(":policies_content", $this->policies_content);
                $stmt->bindParam(":policies_rewrite_name", $this->policies_rewrite_name);
                $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);

                if ($stmt->execute() == true) {
                    return array("code" => 200, "result" => "successed.");
                }
                return array("code" => 500, "result" => "we've got error while creating.");
            }
            return array("code" => 400, "result" => "Duplicate Title.");
        }
        return array("code" => 500, "result" => "we've got error while checking.");
    }

    public function getAllPolicies()
    {
        $queryWhere = "";
        if ($this->policies_active !== null && $this->policies_active !== "") {
            $queryWhere .= " AND policies_active = " . intVal($this->policies_active);
        }

        if ($this->web_id !== null && $this->web_id !== "") {
            $queryWhere .= " AND web_id = " . intVal($this->web_id);
        }
        $query = "SELECT * FROM " . $this->table . "
                    WHERE (policies_title LIKE '%" . $this->term . "%' 
                        OR policies_description LIKE '%" . $this->term . "%')" . $queryWhere;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function activeStatus()
    {
        $query = "UPDATE " . $this->table . " SET
                      policies_active = :policies_active WHERE
                      policies_id     = :policies_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":policies_active", $this->policies_active, PDO::PARAM_INT);
        $stmt->bindParam(":policies_id", $this->policies_id, PDO::PARAM_INT);

        if ($stmt->execute() === true) {
            return array("code" => 200, "result" => "update status success.");
        } else {
            return array("code" => 500, "result" => "we've got error while updating status.");
        }
    }

    public function getPoliciesById()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE policies_id = :policies_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":policies_id", $this->policies_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function updatePolicies()
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " 
                WHERE web_id = :web_id and policies_title = :policies_title and policies_id != :policies_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":web_id", $this->web_id, PDO::PARAM_INT);
        $stmt->bindParam(":policies_title", $this->policies_title);
        $stmt->bindParam(":policies_id", $this->policies_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        if ($count == 0) {
            $query = "UPDATE " . $this->table . " SET
                        policies_title            = :policies_title,
                        policies_description      = :policies_description,
                        policies_content          = :policies_content,
                        policies_image            = :policies_image,
                        policies_meta_description = :policies_meta_description,
                        policies_rewrite_name     = :policies_rewrite_name,
                        policies_datetime_update  = CURRENT_TIMESTAMP() 
                    WHERE policies_id = :policies_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":policies_title",            $this->policies_title);
            $stmt->bindParam(":policies_description",      $this->policies_description);
            $stmt->bindParam(":policies_content",          $this->policies_content);
            $stmt->bindParam(":policies_image",            $this->policies_image);
            $stmt->bindParam(":policies_meta_description", $this->policies_meta_description);
            $stmt->bindParam(":policies_rewrite_name",     $this->policies_rewrite_name);
            $stmt->bindParam(":policies_id",               $this->policies_id, PDO::PARAM_INT);

            if ($stmt->execute() == true) {
                return array("code" => 200, "result" => "Success.");
            }
            return array("code" => 500, "result" => $this->policies_title /*"we've got error while updating policy."*/);
        } else {
            return array("code" => 401, "result" => "Policy's title's duplicate.");
        }
    }
}
