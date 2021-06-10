<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
    
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

$get_url_1 = explode("//", $url);

if (strpos($get_url_1[1], "www.") !== false) {
    $get_url_2 = explode("www.", $get_url_1[1]);
}
else {
    $get_url_2 = explode("/", $get_url_1[1]);
    $get_url_3 = explode(":", $get_url_2[0]);
    $main_url = $get_url_3[0];
}
?>