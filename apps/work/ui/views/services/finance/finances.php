<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/FinancesController.php';
$profile = new FinancesController();
$user_id = $_SESSION['user_id'];
$details=$profile->view($user_id);

$profile_photo = $details['profile_image'];
$first_name=$profile->sanitize($details['first_name']);
$last_name=$profile->sanitize($details['last_name']);
$dob=$profile->sanitize($details['dob']);
$phone=$profile->sanitize($details['phone']);
$email=$profile->sanitize($details['email']);
$state=$profile->sanitize($details['state']);
$city=$profile->sanitize($details['city']);
$country=$profile->sanitize($details['country']);
$zip_code=$profile->sanitize($details['zip_code']);
$address=$profile->sanitize($details['address']);
$role=$profile->sanitize($details['role']);


$role = $_SESSION['role'];

include $path . '/apps/work/ui/layouts/nav.php';
?>
<style>
    body{
    margin-top:0px;
    background:#F0F8FF;
}
.card {
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e5e9f2;
    border-radius: .2rem;
}
.card-header:first-child {
    border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
}
.card-header {
    border-bottom-width: 1px;
}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    color: inherit;
    background-color: #fff;
    border-bottom: 1px solid #e5e9f2;
}


</style>


<div class="container pt-3">

    <div class="row">
        <div class="col-md-5 col-xl-4">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Financial Dashboard</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                  <a class="list-group-item list-group-item-action" data-toggle="list" href="/apps/work/ui/views/finance/payment_system.php" role="tab">
                      Fees & Payments
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=balance" role="tab">
                      Balance
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=deposits" role="tab">
                      Deposits
                    </a>
                    <a class="list-group-item list-group-item-action " data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=withdrawals" role="tab">
                      Withdrawals
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=payments" role="tab">
                      Payment Setup
                    </a>
                    <a class="list-group-item list-group-item-action " data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=payouts" role="tab">
                    Payout Setup
                    </a>
                    <a class="list-group-item list-group-item-action " data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=transactions" role="tab">
                      Transactions History
                    </a>
                    <a class="list-group-item list-group-item-action " data-toggle="list" href="/apps/work/ui/views/finance/finances.php?form=fp_profile" role="tab">
                      Financial Profile
                    </a>
                  
                </div>
            </div>
        </div>

        <div class="col-md-7 col-xl-8">
            <div class="tab-content">
            <?php
            $form = $_GET['form'];
            if ($form == null) {
                $form = 'balance ';
            }
            switch ($form) {

              case 'withdrawals':
                ?>

<div class="tab-pane fade show active" id="" role="tabpanel">    


<div class="card">
    <div class="card-header">
        
        <h5 class="card-title mb-0">Withdrawal</h5>
    </div>
    <div class="card-body">
    <form action="/api/financesAPI.php" method="post">
            <div class="row">
            

                <div class="col-12">
            <input type="text" id="amount" name="amount" class="form-control" value="" placeholder="Withdrawal Amount" >
             </div>
              
          
            <br/><br/>

            <button class="btn btn-warning rounded-pill fw-bold py-2 px-5" type="submit"  name="withdraw">
            Withdraw 
          </button>

          
        </form>

    </div>
</div>

</div>
</div>

                



 
               <?php
               break;
                case 'payouts':
                    ?>

        <div class="tab-pane fade show active" id="account" role="tabpanel">

        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Payout Setup</h5>
            </div>
            <div class="card-body">
            <form  method="post" action="/api/financesAPI.php" >
    

    
            <div class="row">
            <div class="col-12">
            <input type="text" id="bank_name" name="bank_name" class="form-control" value="" placeholder="Bank Name" aria-label="Bank Name">
             </div>
             <div class="col-12">
            <input type="text" id="account_name" name="account_name" class="form-control" value="" placeholder="Account Holder Name" aria-label="Account Holder Name">
             </div>
              <div class="col-12">
                <input type="text" id="account_no" name="account_no" class="form-control" value="" placeholder="Account No" aria-label="Account No">
              </div>
              <div class="col-6">
                <input type="text" id="transit_no" name="transit_no" class="form-control" placeholder="Transit No" value="" aria-label="Transit No">
              </div>
    

              <div class="col-6">
                <input type="text" id="institution_no" name="institution_no" class="form-control" placeholder="Institution No" value="" aria-label="Institution No">
              </div>
            </div>
            </br>
            <button class="btn btn-warning rounded-pill fw-bold py-2 px-5" type="submit"  name="add_bank">
            Add Bank 
          </button>
          </br>
            <br>
            </form>

            </div>
        </div>

      
                
                           <?php
                           break;


                case 'deposits':
                    ?>
        
        
        
                        <div class="tab-pane fade show active" id="" role="tabpanel">    
        
        
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Payments</h5>
            
                            </div>
                            <div class="card-body">
        
                <form action="/api/financesAPI.php" method="post">
             
                              <div class="row">
                              <div class="col-12">
                                  <input type="text" id="amount" name="amount" class="form-control" placeholder="Deposit Amount " value="" aria-label="Card Name">
                                </div>
                              <div class="col-12">
                                  <input type="text" id="card_name" name="card_name" class="form-control" placeholder="Name on Card " value="" aria-label="Card Name">
                                </div>
                              <div class="col-12">
                              <input type="text" id="billing_address" name="billing_address" class="form-control" placeholder="Billing Address" value="" aria-label="Billing Addres">
                            </div>
            
                                <div class="col-12">
                                  <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card Number" value="" aria-label="Card Number">
                                </div>
                
                                <div class="col-6">
                                  <input type="text" id="card_expiry_mm" name="card_expiry_mm" class="form-control" placeholder="Card Expiry MM" value="" aria-label="Card Expiry MM">
                                </div>
                                <div class="col-6">
                                  <input type="text" id="card_expiry_yy" name="card_expiry_yy" class="form-control" placeholder="Card Expiry YY" value="" aria-label="Card Expiry YY">
                                </div>
                                <div class="col-6">
                                  <input type="text" id="card_cvv" name="card_cvv" class="form-control" placeholder="Card CVV" value="" aria-label="Card CVV">
                                </div>
              
                              <div class="d-grid mx-auto pt-3 pb-2">
                                <button class="btn btn-warning rounded-pill fw-bold py-2 px-5" type="submit"  name="make_deposit">
                                 Make Deposit
                                </button>
                
                  
                                  </form>
        
        
                            </div>
                        </div>
        
                        </div>
        
                        
        
        
        
                                        <?php
                                        break;
                case 'fp_profile':
                    ?>

                                <div class="tab-pane fade show active" id="account" role="tabpanel">

                                <div class="card">
                                    <div class="card-header">
        
                                        <h5 class="card-title mb-0">Finanacial Profile </h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="/api/financesAPI.php" method="POST" >
                                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                          <input type="hidden" name="role" value="<?php echo $role; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
    
                                                        <div class="form-group">
                                                        <label for="Name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Phone">Phone#</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Phone#">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Email">Email</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="State">State</label>
                                                        <input type="text" class="form-control" id="state" name="state" value="<?php echo $state; ?>" placeholder="State">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="City">City</label>
                                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" placeholder="City">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Zip">Zip Code</label>
                                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo $zip_code; ?>" placeholder="Zip Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Address">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Address">
                                                    </div>
                                          
                    
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="Name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="Name">Date of Birth</label>
                                                        <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" placeholder="DoB">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="Name">Country</label>
                                                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $country; ?>" placeholder="Country">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Banking Information</h5>
                                            <br>

                                            <div class="row">
            <div class="col-md-6">
            <input type="text" id="bank_name" name="bank_name" class="form-control" value="" placeholder="Bank Name" aria-label="Bank Name">
             </div>
             <div class="col-md-6">
            <input type="text" id="account_name" name="account_name" class="form-control" value="" placeholder="Account Holder Name" aria-label="Account Holder Name">
             </div>
              <div class="col-md-6">
                <input type="text" id="account_no" name="account_no" class="form-control" value="" placeholder="Account No" aria-label="Account No">
              </div>
              <div class="col-6">
                <input type="text" id="transit_no" name="transit_no" class="form-control" placeholder="Transit No" value="" aria-label="Transit No">
              </div>
    

              <div class="col-md-6">
                <input type="text" id="institution_no" name="institution_no" class="form-control" placeholder="Institution No" value="" aria-label="Institution No">
              </div>
            </div>


                                            <hr>
                                            <h5>Debit Card</h5>
                                            <br>
                                  
                              <div class="col-12">
                                  <input type="text" id="card_name" name="card_name" class="form-control" placeholder="Name on Card " value="" aria-label="Card Name">
                                </div>
                              <div class="col-12">
                              <input type="text" id="billing_address" name="billing_address" class="form-control" placeholder="Billing Address" value="" aria-label="Billing Addres">
                            </div>
            
                                <div class="col-12">
                                  <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card Number" value="" aria-label="Card Number">
                                </div>
                
                                <div class="col-6">
                                  <input type="text" id="card_expiry_mm" name="card_expiry_mm" class="form-control" placeholder="Card Expiry MM" value="" aria-label="Card Expiry MM">
                                </div>
                                <div class="col-6">
                                  <input type="text" id="card_expiry_yy" name="card_expiry_yy" class="form-control" placeholder="Card Expiry YY" value="" aria-label="Card Expiry YY">
                                </div>
                                <div class="col-6">
                                  <input type="text" id="card_cvv" name="card_cvv" class="form-control" placeholder="Card CVV" value="" aria-label="Card CVV">
                                </div>

                                           </hr>

                                            <button type="submit" class="btn btn-primary" name="fi_profile">Setup</button>
                                        </form>

                                    </div>
                                </div>

                                </div>

                              

                                              <?php
                                              break;
                case 'balance':
                    ?>
                                <div class="tab-pane fade show active" id="" role="tabpanel">    


                                <div class="card">
                                    <div class="card-header">
                                        
                                        <h5 class="card-title mb-0">Balance</h5>
                                    </div>
                                    <div class="card-body">
                                    <form action="/api/settingsAPI.php" method="post">
                                            <div class="row">
                                                <div class="col-md-8 p-3">

                                            <?php
                                            $profile ->get_balance($user_id);
                                            ?>
            
                                            </div>
                                            <br/>

                                          
                                        </form>

                                    </div>
                                </div>

                                </div>

                            <?php
                            break;
          
                            case 'payments':
                                ?>
                    
                    
                    
                                    <div class="tab-pane fade show active" id="" role="tabpanel">    
                    
                    
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Payments</h5>
                        
                                        </div>
                                        <div class="card-body">
                    
                            <form action="/api/financesAPI.php" method="post">
                         
                                          <div class="row">
                                          <div class="col-12">
                                              <input type="text" id="card_name" name="card_name" class="form-control" placeholder="Name on Card " value="" aria-label="Card Name">
                                            </div>
                                          <div class="col-12">
                                          <input type="text" id="billing_address" name="billing_address" class="form-control" placeholder="Billing Address" value="" aria-label="Billing Addres">
                                        </div>
                        
                                            <div class="col-12">
                                              <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card Number" value="" aria-label="Card Number">
                                            </div>
                            
                                            <div class="col-6">
                                              <input type="text" id="card_expiry_mm" name="card_expiry_mm" class="form-control" placeholder="Card Expiry MM" value="" aria-label="Card Expiry MM">
                                            </div>
                                            <div class="col-6">
                                              <input type="text" id="card_expiry_yy" name="card_expiry_yy" class="form-control" placeholder="Card Expiry YY" value="" aria-label="Card Expiry YY">
                                            </div>
                                            <div class="col-6">
                                              <input type="text" id="card_cvv" name="card_cvv" class="form-control" placeholder="Card CVV" value="" aria-label="Card CVV">
                                            </div>
                          
                                          <div class="d-grid mx-auto pt-3 pb-2">
                                            <button class="btn btn-warning rounded-pill fw-bold py-2 px-5" type="submit"  name="add_card">
                                              Add Card 
                                            </button>
                            
                              
                                              </form>
                    
                    
                                        </div>
                                    </div>
                    
                                    </div>
                    
                                    
                    
                    
                    
                                                    <?php
                                                    break;
                

            }

            ?>
            
                
            </div>
        </div>
    </div>

</div>

  <?php
  include $path . '/apps/work/ui/layouts/footer.php';


  ?>