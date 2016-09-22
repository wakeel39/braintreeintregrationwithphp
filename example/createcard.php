<?php 
include("/../braintreeClass.php");
$bt = new BraintreePayment();
$cid=12;
$nounce ="";
$c = $bt->CreateCard($cid,$nounce);
print_r($c);
?>