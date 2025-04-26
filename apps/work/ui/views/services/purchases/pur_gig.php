<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/GigsController.php';
include $path . '/work/ui/layouts/nav.php';
$gig = new GigsController();

$gig->authCheck();

$gig_id = $gig->url_var('gig');
$seller=$gig->url_var('u');

$basic_price = $gig->get_gig_details($gig_id)['basic_price'];
$standard_price = $gig->get_gig_details($gig_id)['standard_price'];
$premium_price = $gig->get_gig_details($gig_id)['premium_price'];
$user_id = $_SESSION['user_id'];

$key="card_number";

$card_number = $gig->get_payment_details($seller, $key);



$act = $gig->url_var('act');

?>
<section class="py-60 postform">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <form method="POST" action="/api/gigsAPI.php" enctype="multipart/form-data">
                        <input type="hidden" name="gig_id" value="<?php echo $gig_id; ?>">
                        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <div class="row gy-4">
                            <h5>Gig Purchase</h5>
                        
                                <div class="row gy-3">
                                <div class="col-12">
  <div class="d-flex flex-column gap-2">
    <label class="mytext-black fs-14 text-uppercase">Choose Price:</label>
    <div>
      <input type="radio" id="price_basic" name="price" value="<?php echo $basic_price; ?>" required>
      <label for="price_basic">Basic Price: $<?php echo $basic_price; ?></label>
    </div>
    <div>
      <input type="radio" id="price_standard" name="price" value="<?php echo $standard_price; ?>" required>
      <label for="price_standard">Standard Price: $<?php echo $standard_price; ?></label>
    </div>
    <div>
      <input type="radio" id="price_premium" name="price" value="<?php echo $premium_price; ?>" required>
      <label for="price_premium">Premium Price: $<?php echo $premium_price; ?></label>
    </div>
  </div>
</div>


                                
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="last_name" class="mytext-black fs-14 text-uppercase">Order Date:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="order_date" value="<?php echo date("Y-m-d"); ?>" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="payment" class="mytext-black fs-14 text-uppercase">Payment method:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="payment" value="<?php echo $card_number; ?>" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button id="checkout-button" class="btn btn-primary" name="pur_gig">Purchase</button>
                                    </div>
                                </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>





<?php
include $path . '/work/ui/layouts/footer.php';
?>
