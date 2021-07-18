<?
require_once("inc_security.php");


?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/payment_detail.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/helper/function.js"></script>
    <script language="javascript" src="../../resource/js/payment_detail.js"></script>

</head>

<body>
    <!-- Loading HTML -->
    <div class="loader-container">
        <div class="loader"></div>
    </div>

    <!-- Alert HTML -->
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Main Body -->
    <div class="container container_post_infor">
        <form class="needs-validation" action="">
            <div class="payment_info_title">
                <h2><?= translate_text('Chỉnh Sửa Thanh Toán') ?></h2>
            </div>
            <div class="container payment-info">
                <table>
                    <tr>
                        <td><label for="payment_method"><?= translate_text('Hình Thức Thanh Toán: ') ?></label></td>
                        <td>
                            <p id="payment_method" style="font-weight: bold;">NULL</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="website"><?= translate_text('Website: ') ?></label></td>
                        <td>
                            <p id="website" style="font-weight: bold;">NULL</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="payment_partner_code"><?= translate_text('Partner Code:') ?></label></td>
                        <td><input autocomplete="off" style="margin-left: 10px;" type="text" require id="payment_partner_code"><small></small></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="payment_access_key"><?= translate_text('Access Key: ') ?></label></td>
                        <td><input autocomplete="off" style="margin-left: 10px;" type="text" require id="payment_access_key"><small></small></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="payment_secret_key"><?= translate_text('Secret Key: ') ?></label></td>
                        <td><input autocomplete="off" style="margin-left: 10px;" type="text" require id="payment_secret_key"><small></small></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="btn_action" style="justify-content: center; ">
                            
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>