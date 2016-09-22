<?php 
include("/../braintreeClass.php");
$bt = new BraintreePayment();
$cid=1212;
$token ="get_from_client";
$c = $bt->CreateSubMerchant($cid) ;
//$c = $bt->PaymentWithCreditCard($amount,$token) ;
print_r($c);
?>