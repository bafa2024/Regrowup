<?php
include 'Controller.php';

class FinancesController extends Controller  {
    use StripeController;
    public function __construct(){
        parent::__construct();
        
    }

    public function view($user_id)
    {

        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $result = $this->run_query($sql);
        $res=$result->fetch_assoc();
        return $res;
    }

    public function user_fp($user_id,$email,$stripe_connect_id,$stripe_customer_id,$source_id,$card_token){
      
      $sql="INSERT INTO financial_profile (user_id,email,stripe_connect_id,stripe_customer_id,stripe_source_id,card_token) 
      values ('$user_id','$email','$stripe_connect_id','$stripe_customer_id','$source_id','$card_token')";
      $result=$this->run_query($sql);
      if($result){
         return true;
      }else{
        return false;
      }
    }

    public function fp_check($user_id)
    {

        $sql = "SELECT * FROM financial_profile WHERE id='$user_id'";
        $result = $this->run_query($sql);
        $res=$result->fetch_assoc();
        if($res){
          return $res['id'];
        }else{
          return false;
        }
    }

    //Get user balance
    public function get_balance($user_id){
     //select sum of initial balance
      $sql1="SELECT SUM(initial_balance) AS initial_balance FROM balance WHERE user_id='$user_id'";
      //select sum of current balance
      $sql2="SELECT SUM(current_balance) AS current_balance FROM balance WHERE user_id='$user_id'";
      //select sum of owed balance
      $sql3="SELECT SUM(owing) AS owed_balance FROM balance WHERE user_id='$user_id'";
      
      $result1=$this->run_query->query($sql1);
      $result2=$this->run_query->query($sql2);
      $result3=$this->run_query->query($sql3);
      $res1=$result1->fetch_assoc();
      $res2=$result2->fetch_assoc();
      $res3=$result3->fetch_assoc();
      $initial_balance=number_format($res1['initial_balance'],2);
      $owed_balance=number_format($res3['owed_balance'],2);
      $balance=$res2['current_balance']-$res3['owed_balance'];
      $balance=number_format($balance,2);
      echo '<div class="form-group p-3">
      <label for="">Initial Balance</label>
      <input type="text" class="form-control"   disabled value="'.$initial_balance.'">
  </div>
  <div class="form-group p-3">
      <label for="">Current Balance</label>
      <input type="text" class="form-control"   value="'.$balance.'" disabled>
  </div>

  <div class="form-group p-3">
      <label for="">Owing Balance</label>
      <input type="text" class="form-control"  value="'.$owed_balance.'" disabled>
  </div>
</div>';
    }

    //Create user balance
    public function create_balance($user,$initial_balance,$currency,$current_balance){
    
      $sql="INSERT INTO balance(user_id,initial_balance,currency,current_balance) 
      VALUES('$user','$initial_balance','$currency','$current_balance')";
      $result=$this->run_query($sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }


    //Make deposit
    public function make_deposit(){
      $user_id=$_SESSION['user_id'];
      $card_number=$_POST['card_number'];
      $card_name=$_POST['card_name'];
      $amount=$_POST['amount'];
      $billing_address=$_POST['billing_address'];
      $card_expiry_mm=$_POST['card_expiry_mm'];
      $card_expiry_year=$_POST['card_expiry_yy'];
      $card_cvv=$_POST['card_cvv'];
      $token=$this->create_token_cards($card_number,$card_expiry_mm,$card_expiry_year,$card_cvv);
      $res=$this->charge_payment($token,$amount,'USD','Deposit');
      if($res){
        $this->create_balance($user_id,$amount,'USD',$amount);
        $sql="INSERT INTO deposits(user_id,amount,card_no,card_name,billing_address,deposit_status,card_expiry_month,card_expiry_year,card_cvv) 
        VALUES('$user_id','$amount','$card_number','$card_name','$billing_address','$res','$card_expiry_mm','$card_expiry_year','$card_cvv')";
        $result=$this->run_query($sql);
        if($result){
          return true;
        }else{
          return false;
        }

    }


  

  }

    public function add_payout_method(){

      $user_id=$_SESSION['user_id'];
      $bank_name=$_POST['bank_name'];
      $account_name=$_POST['account_name'];
      $account_no=$_POST['account_no'];
      $transit_no=$_POST['transit_no'];
      $institution_no=$_POST['institution_no'];

      $first_name=$_SESSION['first_name'];
      $last_name=$_SESSION['last_name'];
      $email=$_SESSION['email'];
      $country=$_SESSION['country'];
      $type=$_SESSION['business_type'];
      $business_type=$_SESSION['business_type'];
      $type="express";
      $name=$_SESSION['full_name'];
      $dob=$_SESSION['dob'];
    

    

      
      $sql="INSERT INTO payment_method_banks (user_id,bank_name,account_name,account_no,transit_no,institution_no) 
      VALUES ('$user_id','$bank_name','$account_name','$account_no','$transit_no','$institution_no')";
      $result=$this->run_query($sql);
      if($result ){
        $this->alert_redirect("Payment Method Updated","/work/ui/views/finance/finances.php");
      }else{
        $this->alert_redirect("Failed Try Again","/work/ui/views/finance/finances.php");
      }

    }


    //Get the user financial profile

    public function get_financial_profile($user_id){
      $sql="SELECT * FROM financial_profile WHERE user_id='$user_id'";
      $result=$this->run_query($sql);
      $res=$result->fetch_assoc();
      return $res;
    }

      //Write a function to record the payment method of the user

  public function add_payment_methods(){
    $user_id=$_SESSION['user_id'];
  
    $card_number=$_POST['card_number'];
    $card_name=$_POST['card_name'];
    $billing_address=$_POST['billing_address'];
    $card_expiry_mm=$_POST['card_expiry_mm'];
    $card_expiry_year=$_POST['card_expiry_yy'];
    $card_cvv=$_POST['card_cvv'];
    $card_array=array("card_number"=>$card_number,"card_name"=>$card_name,"billing_address"=>$billing_address,"card_expiry_mm"=>$card_expiry_mm,"card_expiry_year"=>$card_expiry_year,"card_cvv"=>$card_cvv);
    $card_json=json_encode($card_array);
    $sql="INSERT INTO payment_methods (user_id,card_details) VALUES ('$user_id','$card_json')";
    $result=$this->run_query($sql);
    if($result){
      return true;
    }else{
      return false;
    }
  }

  }  



   





?>