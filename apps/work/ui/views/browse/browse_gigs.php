<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/GigsController.php';

$gig = new GigsController();

$gig->authCheck();

$role = $_SESSION['role'];

include $path . '/apps/work/ui/layouts/nav.php';
?>


<style>
.ls-none {
    list-style: none;
    padding: 0 !important;
}

.col-md-4 hr {
    margin: 5px 0;
}
</style>
<section class="d-block py-60">
    <div class="container-lg">
        <div class="row gy-4">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <div class="d-flex flex-column mb-4">
                        <div class="d-flex flex-row align-items-center justify-content-between mb-4">
                            <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                Browse Gigs
                            </h2>
                        
                        </div>
                        <p class="mytext-black text-uppercase fs-16 fs-md-18">
                            Clear price, great quality, express delivery
                        </p>
                    </div>

                    <form method="get" action="" enctype="multipart/form-data">
                        <input type="hidden" name="" value="">                       
                         <div class="row gy-4">
                            <div class="col-md-3">
                                <div class="d-flex">
                                    <input type="text"
                                        class="bg-white border w-md-400 border-seacondary border-opcity-25 p-2 fs-14"
                                        name="search" placeholder="Search by category company or......"
                                        value="" />
                                    <button type="submit"
                                        class=" border border-seacondary border-opcity-25 bg-white px-2"><i
                                            class="fal fa-search mytext-black fs-16" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="col-md-3">
                            
                            <?php

                            $gig->select_countries();

                            ?>
                            
                        </div>
                            <div class="col-md-3">
                                <select name="price" id=""
                                    class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                    <option value="">Price</option>
                                    <option value="1-10" >£1-10
                                    </option>
                                    <option value="10-20" >
                                        £10-20</option>
                                    <option value="20-30" >
                                        £20-30</option>
                                    <option value="40-50" >
                                        £40-50</option>
                                    <option value="50-70" >
                                        £50-70</option>
                                    <option value="75-100" >
                                        £75-100</option>
                                    <option value="100-150" >
                                        £100-150</option>
                                    <option value="150-250" >
                                        £150-250</option>
                                    <option value="250-1000"
                                        >£250-1000</option>
                                    <option value="1000" >£1000+
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="category" id=""
                                    class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                    <option value="">Category</option>
                                
    <option value="Local Jobs">Local Jobs</option>
    <option value="Writing">Writing</option>
    <option value="Web, Mobile & Software Dev">Web, Mobile & Software Dev</option>
    <option value="Translation">Translation</option>
    <option value="Sales & Marketing">Sales & Marketing</option>
    <option value="Legal">Legal</option>
    <option value="IT & Networking">IT & Networking</option>
    <option value="Engineering & Architecture">Engineering & Architecture</option>
    <option value="Design & Creative">Design & Creative</option>
    <option value="Data Science & Analytics">Data Science & Analytics</option>
    <option value="Customer Service">Customer Service</option>
    <option value="Admin Support">Admin Support</option>
    <option value="Accounting & Consulting">Accounting & Consulting</option>
                                                                                                        </select>
                            </div>

                            
                            <div class="col-md-4">
                                <label for="" class="text-white fs-14 text-uppercase mb-2 d-none d-md-block">s</label>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="/apps/work/ui/views/browse/browse_gigs.php" class="clear-btn float-md-end">
                                            Clear
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="post-btn float-md-end">
                                            Apply filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- New GiGS -->
            <div class="row gy-4 gigview bg-white p-3 p-md-5 bg-white rounded-3 shadow">
            <?php



            $search = $gig->url_var('search');
            $contract_type = $gig->url_var('con_ty');
            $location = $gig->url_var('country');
            $price = $gig->url_var('price');

            if ($search) {

                $gig->gigs_search($search);

            } elseif ($contract_type) {

                $gig->filter_jobs_type($contract_type);

            } elseif ($location) {

                $gig->filter_gigs_location($location);

            } elseif ($price) {

                $gig->filter_gigs_price($price);

            } else {

                $gig->list_gigs();

            }


            ?>

            </div>

            <!-- New GiGS End-->


        </div>
    </div>
</section>

<?php
include $path . '/apps/work/ui/layouts/footer.php';


?>