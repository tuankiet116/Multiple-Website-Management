<?php
class Configuations{
  
    // database connection and table name
    private $conn;
    private $table_name = "configuration";
  
    // object properties
    public $con_id;
    public $web_id;
    public $con_admin_email;
    public $con_site_title;
    public $con_meta_description;
    public $con_meta_keyword;
    public $con_mod_rewrite;
    public $con_extenstion;
    public $lang_id;
    public $con_active_contact;
    public $con_hotline;
    public $con_hotline_banhang;
    public $con_hotline_hotro_kythuat;
    public $con_address;
    public $con_background_homepage;
    public $con_info_payment;
    public $con_fee_transport;
    public $con_contact_sale;
    public $con_info_company;
    public $con_logo_top;
    public $con_logo_bottom;
    public $con_page_fb;
    public $con_link_fb;
    public $con_link_twitter;
    public $con_link_insta;
    public $con_map;
    public $con_banner_image;
    public $con_banner_title;
    public $con_banner_description;
    public $con_banner_active;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function getByWebID($id_web){
        $count = 0;
        // query to read single record
        $query = "SELECT * FROM " .$this->table_name. " WHERE web_id = ?";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $id_web);
        
        //excute query
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->con_id                    = $row["con_id"];
            $this->web_id                    = $row["web_id"];
            $this->con_admin_email           = $row["con_admin_email"];
            $this->con_site_title            = $row["con_site_title"];
            $this->con_meta_description      = $row["con_meta_description"];
            $this->con_meta_keyword          = $row["con_meta_keyword"];
            $this->con_mod_rewrite           = $row["con_mod_rewrite"];
            $this->con_extenstion            = $row["con_extenstion"];
            $this->lang_id                   = $row["lang_id"];
            $this->con_active_contact        = $row["con_active_contact"];
            $this->con_hotline               = $row["con_hotline"];
            $this->con_hotline_banhang       = $row["con_hotline_banhang"];
            $this->con_hotline_hotro_kythuat = $row["con_hotline_hotro_kythuat"];
            $this->con_address               = $row["con_address"];
            $this->con_background_homepage   = $row["con_background_homepage"];
            $this->con_info_payment          = $row["con_info_payment"];
            $this->con_fee_transport         = $row["con_fee_transport"];
            $this->con_contact_sale          = $row["con_contact_sale"];
            $this->con_info_company          = $row["con_info_company"];
            $this->con_logo_top              = $row["con_logo_top"];
            $this->con_logo_bottom           = $row["con_logo_bottom"];
            $this->con_page_fb               = $row["con_page_fb"];
            $this->con_link_fb               = $row["con_link_fb"];
            $this->con_link_twitter          = $row["con_link_twitter"];
            $this->con_link_insta            = $row["con_link_insta"];
            $this->con_map                   = $row["con_map"];
            $this->con_banner_image          = $row["con_banner_image"];
            $this->con_banner_title          = $row["con_banner_title"];
            $this->con_banner_description    = $row["con_banner_description"];
            $this->con_banner_active         = $row["con_banner_active"];
        }
        return $query;
    }
}
?>