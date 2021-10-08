<?php
    /**
     * check value payment method to the name equals to the value
     * 1: COD
     * 2: MOMO
     * 
     * @param int $payment_method
     * @return string
     */

    function payment_method_named($payment_method ){
        switch($payment_method){
            case 1:
                $payment_method = 'COD';
                return $payment_method;
            case 2:
                $payment_method = 'MOMO';
                return $payment_method;
            default:
                $payment_method = 'NULL';
                return $payment_method;
        }
    }
    function check_payment_method($payment_method){
        $field = array();
        switch($payment_method){
            case 1:
                $field = array('payment_partner_code', 'payment_access_key', 'payment_secret_key');
                return $field;
            case 2:
                $field = [];
                return $field;
            default:
                return false;
        }
    }

    
?>