<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/FinancesController.php';
$finances = new FinancesController();
$settings = $finances;


include $path . '/config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['add_bank'])){
  

  $finances->add_payout_method();

}

if(isset($_POST['withdraw'])){
  

  $amount=$_POST['amount'];
  $amount=$amount*100;
  $user_id=$_SESSION['user_id'];
  $fp=$finances->get_financial_profile($user_id);
  $connect_id=$fp['stripe_connect_id'];
  $st_customer=$fp['stripe_customer_id'];
//  $destination=$fp['card_token'];
  //connect is the destination
  $destination=$connect_id;
  //$destination=  $st_customer;
  $currency="cad";



  $res = $finances->payout($destination,$amount,$currency);
  if($res){
    $finances->alert_redirect("Withdrawal Successful","/work/ui/views/finance/finances.php");
  }else{
    $finances->alert_redirect("Withdrawal Failed","/work/ui/views/finance/finances.php");
  }

}

if(isset($_POST['make_deposit'])){
  

  $finances->make_deposit();

}



if(isset($_POST['contract_deposit'])){
  
  $amount=$_POST['amount'];

  $dp=$finances->make_deposit();
  if($dp){
    $finances->alert_redirect("Deposit Successful","/work/ui/views/manage/manage_contracts.php");
  }else{
    $finances->alert_redirect("Deposit Failed","/work/ui/views/finance/deposit.php?am=$amount");
  }

}

if(isset($_POST['add_card'])){
  

if ($finances->add_payment_methods()){
  $finances->alert_redirect("Card Added","/work/ui/views/finance/finances.php");
}else{
  $finances->alert_redirect("Card Failed","/work/ui/views/finance/finances.php");
}



}




if(isset($_POST['fi_profile'])){
  

  $role = $_POST['role'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $country = $_POST['country'];

  

  $currency="usd";
  $account_holder_type="individual";

  $account_holder_name = $_POST['account_name'];
  $account_number = $_POST['account_no'];
  $routing_number = $_POST['transit_no'];
  $institution_no = $_POST['institution_no'];

  $card_number=$_POST['card_number'];
  $card_name=$_POST['card_name'];
  $billing_address=$_POST['billing_address'];
  $card_expiry_mm=$_POST['card_expiry_mm'];
  $card_expiry_year=$_POST['card_expiry_yy'];
  $card_cvv=$_POST['card_cvv'];

  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $address = $_POST['address'];
  $zip = $_POST['zip_code'];
  $user_id=$_POST['user_id'];
  $full_name=$first_name." ".$last_name;
  $business_type=  $_SESSION["business_type"];
  $type="express";
  $dob_ar=explode("-",$dob);
      $year=$dob_ar[0];
      $month=$dob_ar[1];
      $day=$dob_ar[2];
$fp_ch=$finances->fp_check($user_id);
if($fp_ch){


    $finances->alert_redirect("Financial Profile Already Existed","/work/ui/views/finance/finances.php?form=fp_profile");

  }else{
  
      
        $stripe_connect_id=$finances->stripe_connect_account($first_name, $last_name, $email, $country, $type,$year, $month, $day,$business_type);
  
        $stripe_customer_id=$finances->stripe_customer($user_id,$email,$full_name);

        

        $source_id=$finances->create_source($currency, $email);



      //  $bank_token=$finances->create_token_bank($country, $currency, $account_holder_name, $account_holder_type, $routing_number, $account_number);
       
      //  $card_token=$finances->create_token_cards($card_number,$card_expiry_mm,$card_expiry_year,$card_cvv);
        $card_token=null;

      //  $stripe_bank_external_account=$finances->external_bank_account($stripe_connect_id,$card_token);
        
        $fp=$finances->user_fp($user_id,$email,$stripe_connect_id,$stripe_customer_id,$source_id,$card_token);

        if($fp){
          $finances->alert_redirect("Financial Profile Created","/work/ui/views/finance/finances.php?form=fp_profile");
        }else{
          $finances->alert_redirect("Financial Profile Creation Failed","/work/ui/views/finance/finances.php?form=fp_profile");
        }

        
   
  
      
  }


}





