<?
    require("inc_security.php");
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../resource/css/configuations.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/configuationsModule.js"></script>
</head>

<body>
    <div class="main_container">
        <div class="pick_website_container">
            <div class="box js-example-basic-single">
                <select>
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div>
        </div>
    </div>
</body>