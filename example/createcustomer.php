<?php 
include("/../braintreeClass.php");
$bt = new BraintreePayment();
$userInfo=array();
$userInfo['id']=12;
$userInfo['firstName']="";
$userInfo['company']="testcompamy";
$userInfo['email']="wakeel_3@test.com";
$userInfo['phone']=212222;
$userInfo['website']="http://wiki.com";

$c = $bt->CreateCustomer($userInfo);
print_r($c);


?>