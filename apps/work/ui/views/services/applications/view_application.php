<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();




  include $path.'/work/ui/layouts/nav.php';

?>



<section class=" py-60">
    <div class="container-lg">
        <div class="row border rounded-3 shadow bg-white p-4">
            <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
    
                <input type="hidden" name="applicant_id" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Application Details
                                </h2>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">brief description of yourself
                                        </label>
                                    <textarea name="description" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Duration</label>
                                
                                    <select name="duration" id="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select Duration</option>
                                        <option value="1 Month">1 Month</option>
                                        <option value="2 Months">2 Months</option>
                                        <option value="3 Months">3 Months</option>
                                        <option value="4 Months">4 Months</option>
                                        <option value="5 Months">5 Months</option>
                                        <option value="6 Months">6 Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Availability</label>
                                    <select name="availability" id="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select</option>
                                        <option value="Yes" >Yes</option>
                                        <option value="No"  selected >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Charges $</label>
                                    <input type="text" name="charges" required
                                        value=""
                                        placeholder="0.00$....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                    
                        

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto" name="apply">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<?php
include $path.'/work/ui/layouts/footer.php';
?>
