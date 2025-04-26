<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/FinancesController.php';

$payment= new FinancesController();
//////////////////////////////////////////////////////////Below methods are working///////////////////////////////////////////

//$res=$payment->stripe_connect_account("Abdulu","Fakhry","abdul23@gmail.com","US","express","1993","05","09","individual");
//$name="Mark Francis";
//$email="mark123@gmail.com";
//$res=$payment->stripe_customer($name, $email);
//$res=$payment->create_payment_method("card","4242424242424242",12,2026,123,"Abdul Fakhri","abdul12@gmail.com","1234567890","123 Main Street","Apt 2","Toronto","ON","CA","M1M1M1");
//$res=$payment->payment_method_details('pm_1N2LY9BG6J77VsYBKhl7w97B');
//$res=$payment->attach_payment_method_customer('pm_1N2LY9BG6J77VsYBKhl7w97B','cus_NnxVGVTPwKFVzL');
//$res=$payment->detach_payment_method('pm_1N2LY9BG6J77VsYBKhl7w97B');
//$res=$payment->create_source("usd","abdul@gmail.com");
//$res=$payment->retrieve_source('src_1N2LqbBG6J77VsYB4fwP08Zo');
//$res=$payment->attach_source('src_1N2LqbBG6J77VsYB4fwP08Zo','cus_NnxVGVTPwKFVzL');
//$res=$payment->checkup_balance();
/*
$token=$payment->create_token_cards('4000 0000 0000 0077',12,2026,123);
$res=$payment->charge_payment($token,10000,'cad','premium');
$res=$payment->payout_normal(10,'cad');
$res=$payment->create_token_bank('CA','cad','Abdul Fakhri','individual','110000000','67809');
$token=$payment->create_token_cards('4000000000000077',12,2026,123);
$res=$payment->charge_payment($token,10000,'cad','premium');

$res=$payment->list_connected_accounts();
$res=$payment->create_stripe_connect_accounts("Abd","Fak","abb@gmail.com","CA","express","individual");
$res=$payment->retrieve_connect_account("acct_1N3O1HBL37Fzpqk9");
$res=$payment->login_link_express_account("acct_1N3O1HBL37Fzpqk9");
$res=$payment->payout_normal(1000,'cad');
$res=$payment->account_cap("acct_1McbfRPZ018eXznj");
$res=$payment->subscription(19,'cad','month','premium');
$res=$payment->charge_amount(10,'usd','premium');
$res = $payment->payout("acct_1N3O4aBLplOl4z0Y",10,"cad");
$res=$payment->attach_payment_method_customer('pm_1N2LY9BG6J77VsYBKhl7w97B','acct_1N3O1HBL37Fzpqk9');
$res=$payment->payout_normal(10,'cad');
*/
//$res=$payment->payout("acct_1N3O1HBL37Fzpqk9",100,"cad");
//$source=$payment->create_source("usd","woned@gmail.com");
//$res=$payment->retrieve_source('src_1N2LqbBG6J77VsYB4fwP08Zo');
//$res=$payment->attach_source($source,'acct_1N3O1HBL37Fzpqk9');
//$token=$payment->create_token_cards('4000000000000077',12,2026,123);
//$res=$payment->charge_payment($token,1000000,'cad','premium');
//$res=$payment->checkup_balance();
//$res=$payment->payout("cus_NupL5uTVLJlK7G",100,"cad");
//$res=$payment->credit_to_customer("cus_NuppMglSyXHrIJ");
$res=$payment->customer_balance("cus_NuppMglSyXHrIJ");
print $res;




?>