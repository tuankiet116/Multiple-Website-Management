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
?>