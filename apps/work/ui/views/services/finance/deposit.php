<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/FinancesController.php';
$profile = new FinancesController();
$user_id = $_SESSION['user_id'];
$details=$profile->view($user_id);
$dep_amount=$profile->url_var($_GET['am']);
$amount=100*$dep_amount;
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

include $path . '/work/ui/layouts/nav.php';
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


<div class="container pt-5">

    <div class="row">
        <div class="col-md-12 col-xl-8">

        <div class="tab-pane fade show active" id="" role="tabpanel">    
        
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Payments</h5>

            </div>
            <div class="card-body">

<form action="/api/financesAPI.php" method="post">

              <div class="row">
              <div class="col-12">
                  <input type="hidden" id="amount" name="amount" class="form-control" placeholder="Deposit Amount " value="<?php echo $amount;  ?>" >
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
                <button class="btn btn-warning rounded-pill fw-bold py-2 px-5" type="submit"  name="contract_deposit">
                 Make Deposit
                </button>

  
                  </form>


            </div>
        </div>

        </div>


        </div>
    </div>

</div>

  <?php
  include $path . '/work/ui/layouts/footer.php';


  ?>