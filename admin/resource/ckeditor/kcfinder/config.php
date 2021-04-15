<?php
require_once("../../../session.php");

// Kiểm tra sesion
$disable = true;
if ( isset($_SESSION['Logged']) && $_SESSION['Logged'] == 1 ){
    $disable = false;
}

$_CONFIG = array(

    'disabled' => $disable,
    'denyZipDownload' => true,
    'denyUpdateCheck' => true,
    'denyExtensionRename' => true,

    'theme' => "oxygen",

    'uploadURL' => "/upload_images/",
    'uploadDir' => "../../../../upload_images/",

    'dirPerms' => 0777,
    'filePerms' => 0777,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => false,
            'copy'   => false,
            'move'   => false,
            'rename' => false
        ),

        'dirs' => array(
            'create' => true,
            'delete' => false,
            'rename' => false
        )
    ),

    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",

    'types' => array(

        // CKEditor & FCKEditor types
        'files' =>  "",
        'flash' =>  "swf",
        'Image' =>  "*img",

        // TinyMCE types
        // 'file'    =>  "",
        // 'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        // 'image'   =>  "*img",
    ),

    'filenameChangeChars' => array(
        ' ' => "_",
        ':' => "."
    ),

    'dirnameChangeChars' => array(
        ' ' => "_",
        ':' => "."
    ),

    'mime_magic'     => "",
    
    'maxImageWidth'  => 0,
    'maxImageHeight' => 0,
    
    'thumbWidth'     => 100,
    'thumbHeight'    => 100,

    'thumbsDir' 		=> ".thumb",

    'jpegQuality' => 90,

    'cookieDomain' => "",
    'cookiePath'   => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    //'_check4htaccess' => true,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    '_sessionLifetime' => 30,
    //'_sessionDir' => $session_save_path,

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);

?>