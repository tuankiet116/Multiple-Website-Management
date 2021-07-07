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
    public $con_rewrite_name_homepage;
    public $con_active_product;
    public $con_active_service;
    public $con_active_sale;
  
    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function getByWebID($id_web, $getAll){
        $count = 0;
        // query to read single record
        $query = "SELECT * FROM " .$this->table_name. " WHERE web_id = ?";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $id_web);
        
        //excute query
        $stmt->execute();
        
        if($getAll == true){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $this->con_id                    = $row["con_id"];
                $this->web_id                    = $row["web_id"];
                $this->con_admin_email           = $row["con_admin_email"];
                $this->con_site_title            = $row["con_site_title"];
                $this->con_meta_description      = $row["con_meta_description"];
                $this->con_meta_keyword          = $row["con_meta_keywords"];
                $this->con_mod_rewrite           = $row["con_mod_rewrite"];
                //$this->lang_id                   = $row["lang_id"];
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
                $this->con_rewrite_name_homepage = $row["con_rewrite_name_homepage"];
                $this->con_active_product        = $row["con_active_product"];
                $this->con_active_sale           = $row["con_active_sale"];
                $this->con_active_service        = $row["con_active_service"];
            }
        }
        
        $count = $stmt->rowCount();
        return $count;
    }

    function create(){
        $query = "INSERT INTO configuration(web_id, con_admin_email, con_site_title, con_meta_description, 
                  con_meta_keywords, con_mod_rewrite, con_active_contact, con_hotline, 
                  con_hotline_banhang, con_hotline_hotro_kythuat, con_address, con_background_homepage, con_info_payment, 
                  con_fee_transport, con_contact_sale, con_info_company, con_logo_top, con_logo_bottom, con_page_fb, con_link_fb, 
                  con_link_twitter, con_link_insta, con_map, con_banner_image, con_banner_title, con_banner_description, 
                  con_banner_active, con_rewrite_name_homepage, con_active_sale, con_active_product, con_active_service)
                  Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt  = $this->conn->prepare($query);

        $stmt->bindParam(1,  $this->web_id,  PDO::PARAM_INT);
        $stmt->bindParam(2,  $this->con_admin_email);
        $stmt->bindParam(3,  $this->con_site_title);
        $stmt->bindParam(4,  $this->con_meta_description);
        $stmt->bindParam(5,  $this->con_meta_keyword);
        $stmt->bindParam(6,  $this->con_mod_rewrite, PDO::PARAM_INT);
        //$stmt->bindParam(8,  $this->lang_id, PDO::PARAM_INT);
        $stmt->bindParam(7,  $this->con_active_contact, PDO::PARAM_INT);
        $stmt->bindParam(8, $this->con_hotline);
        $stmt->bindParam(9, $this->con_hotline_banhang);
        $stmt->bindParam(10, $this->con_hotline_hotro_kythuat);
        $stmt->bindParam(11, $this->con_address);
        $stmt->bindParam(12, $this->con_background_homepage);
        $stmt->bindParam(13, $this->con_info_payment);
        $stmt->bindParam(14, $this->con_fee_transport);
        $stmt->bindParam(15, $this->con_contact_sale);
        $stmt->bindParam(16, $this->con_info_company);
        $stmt->bindParam(17, $this->con_logo_top);
        $stmt->bindParam(18, $this->con_logo_bottom);
        $stmt->bindParam(19, $this->con_page_fb);
        $stmt->bindParam(20, $this->con_link_fb);
        $stmt->bindParam(21, $this->con_link_twitter);
        $stmt->bindParam(22, $this->con_link_insta);
        $stmt->bindParam(23, $this->con_map);
        $stmt->bindParam(24, $this->con_banner_image);
        $stmt->bindParam(25, $this->con_banner_title);
        $stmt->bindParam(26, $this->con_banner_description);
        $stmt->bindParam(27, $this->con_banner_active, PDO::PARAM_INT);
        $stmt->bindParam(28, $this->con_rewrite_name_homepage);
        $stmt->bindParam(29, $this->con_active_sale, PDO::PARAM_INT);
        $stmt->bindParam(30, $this->con_active_product, PDO::PARAM_INT);
        $stmt->bindParam(31, $this->con_active_service, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){
        $query = "UPDATE configuration SET
                  con_admin_email           = :con_admin_email, 
                  con_site_title            = :con_site_title, 
                  con_meta_description      = :con_meta_description, 
                  con_meta_keywords         = :con_meta_keyword, 
                  con_mod_rewrite           = :con_mod_rewrite, 
                  con_active_contact        = :con_active_contact, 
                  con_hotline               = :con_hotline, 
                  con_hotline_banhang       = :con_hotline_banhang, 
                  con_hotline_hotro_kythuat = :con_hotline_hotro_kythuat, 
                  con_address               = :con_address, 
                  con_background_homepage   = :con_background_homepage, 
                  con_info_payment          = :con_info_payment, 
                  con_fee_transport         = :con_fee_transport, 
                  con_contact_sale          = :con_contact_sale, 
                  con_info_company          = :con_info_company,
                  con_logo_top              = :con_logo_top, 
                  con_logo_bottom           = :con_logo_bottom, 
                  con_page_fb               = :con_page_fb, 
                  con_link_fb               = :con_link_fb, 
                  con_link_twitter          = :con_link_twitter, 
                  con_link_insta            = :con_link_insta, 
                  con_map                   = :con_map, 
                  con_banner_image          = :con_banner_image,
                  con_banner_title          = :con_banner_title, 
                  con_banner_description    = :con_banner_description, 
                  con_banner_active         = :con_banner_active,
                  con_rewrite_name_homepage = :con_rewrite_name_homepage,
                  con_active_product        = :con_active_product,
                  con_active_sale           = :con_active_sale,
                  con_active_service        = :con_active_service
                  WHERE web_id              = :web_id";
        $stmt  = $this->conn->prepare($query);

        $stmt->bindParam(':web_id'                   , $this->web_id, PDO::PARAM_INT);
        $stmt->bindParam(':con_admin_email'          , $this->con_admin_email);
        $stmt->bindParam(':con_site_title'           , $this->con_site_title);
        $stmt->bindParam(':con_meta_description'     , $this->con_meta_description);
        $stmt->bindParam(':con_meta_keyword'         , $this->con_meta_keyword);
        $stmt->bindParam(':con_mod_rewrite'          , $this->con_mod_rewrite, PDO::PARAM_INT);
        $stmt->bindParam(':con_active_contact'       , $this->con_active_contact, PDO::PARAM_INT);
        $stmt->bindParam(':con_hotline'              , $this->con_hotline);
        $stmt->bindParam(':con_hotline_banhang'      , $this->con_hotline_banhang);
        $stmt->bindParam(':con_hotline_hotro_kythuat', $this->con_hotline_hotro_kythuat);
        $stmt->bindParam(':con_address'              , $this->con_address);
        $stmt->bindParam(':con_background_homepage'  , $this->con_background_homepage);
        $stmt->bindParam(':con_info_payment'         , $this->con_info_payment);
        $stmt->bindParam(':con_fee_transport'        , $this->con_fee_transport);
        $stmt->bindParam(':con_contact_sale'         , $this->con_contact_sale);
        $stmt->bindParam(':con_info_company'         , $this->con_info_company);
        $stmt->bindParam(':con_logo_top'             , $this->con_logo_top);
        $stmt->bindParam(':con_logo_bottom'          , $this->con_logo_bottom);
        $stmt->bindParam(':con_page_fb'              , $this->con_page_fb);
        $stmt->bindParam(':con_link_fb'              , $this->con_link_fb);
        $stmt->bindParam(':con_link_twitter'         , $this->con_link_twitter);
        $stmt->bindParam(':con_link_insta'           , $this->con_link_insta);
        $stmt->bindParam(':con_map'                  , $this->con_map);
        $stmt->bindParam(':con_banner_image'         , $this->con_banner_image);
        $stmt->bindParam(':con_banner_title'         , $this->con_banner_title);
        $stmt->bindParam(':con_banner_description'   , $this->con_banner_description);
        $stmt->bindParam(':con_banner_active'        , $this->con_banner_active, PDO::PARAM_INT);
        $stmt->bindParam(':con_rewrite_name_homepage', $this->con_rewrite_name_homepage);
        $stmt->bindParam(':con_active_product'       , $this->con_active_product, PDO::PARAM_INT);
        $stmt->bindParam(':con_active_sale'          , $this->con_active_sale, PDO::PARAM_INT);
        $stmt->bindParam(':con_active_service'       , $this->con_active_service, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }
        return $stmt;
    }
}
?>