<!DOCTYPE html>
<html>

<head>
    <title> Error </title>
    <? include("./includes/inc_head.php"); ?>
    <link rel="stylesheet" href="../Green_website/resource/css/news.css">
</head>

<body>

    <!--------------- CONTENT --------------->

    <div id="error">
        <img src="<?php echo $base_url ?>data/image/post/error1.png" alt="background error">
    </div>


</body>

<style>

    body {
        background-color: white;
    }

    #error {
        width: 40%;
        display: flex;
        align-items: center;
        padding: 0;
        margin: 0 auto;
    }

    #error img {
        width: 100%;
        height: auto;
    }
</style>

</html>