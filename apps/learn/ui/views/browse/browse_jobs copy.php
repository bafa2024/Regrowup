<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();



include $path . '/apps/work/ui/layouts/nav.php';
?>
    
    <section class="d-block py-60">
    <div class="container-lg">
        <div class="row g-md-0">
            <div class="col-md-3 gbg border border-secondary border-opacity-30">
                <div class="d-flex flex-column p-4 gap-4">
                    <div class="d-flex flex-column gap-1">
                        <h2 class="mytext-black fw-700 fs-16 fs-lg-18 text-uppercase mb-2">
                            Types of employment
                        </h2>
                        <div class="form-check">
                            <input class="form-check-input"
                                                                type="radio" value="Full time" name="flexRadioDefault" id="flexRadioDefault1"
                                onclick="return statusacc('Full time');" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault1">
                                Full time jobs
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                                                value="Part time" onclick="return statusacc('Part time');" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault2" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault2">
                                part time jobs
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="Remote"
                                                                onclick="return statusacc('Remote');" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault6" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault6">
                                Remote jobs
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="internship shops"
                                                                onclick="return statusacc('internship shops');" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault3" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault3">
                                internship shops
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                                                onclick="return statusacc('Contract');" value="Contract" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault4" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault4">
                                Contract
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                                                onclick="return statusacc('Training Jobs');" value="Training Jobs" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault5" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="flexRadioDefault5">
                                Training Jobs
                            </label>
                        </div>
                    </div>
                    <!--  -->
                    <div class="d-flex flex-column gap-1">
                        <h2 class="mytext-black fw-700 fs-16 fs-lg-18 text-uppercase mb-2">
                            Seniority level
                        </h2>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f1" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f1">
                                Student level
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f2" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f2">
                                Entry level
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f3" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f3">
                                MID LEVEL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f4" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f4">
                                Senior level
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f5" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f5">
                                Directors
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="f6" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="f6">
                                VP or above
                            </label>
                        </div>
                    </div>
                    <!--  -->
                    <div class="d-flex flex-column gap-1">
                        <h2 class="mytext-black fw-700 fs-16 fs-lg-18 text-uppercase mb-2">
                            Salary range
                        </h2>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('5000-12000');"
                                name="pricesel" value="5000-12000"
                                                                id="w1" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w1">
                                £5000-12000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('12000-18000');"
                                name="pricesel" value="12000-18000"
                                                                id="w2" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w2">
                                £12000-18000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('18000-25000');"
                                value="18000-25000" name="pricesel"
                                                                id="w3" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w3">
                                £18000-25000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('25000-35000');"
                                value="25000-35000" name="pricesel"
                                                                id="w4" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w4">
                                £25000-35000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('35000-50000');"
                                value="35000-50000" name="pricesel" id="w5"
                                 />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w5">
                                £35000-50000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('50000-75000');"
                                value="50000-75000"
                                                                name="pricesel" id="w6" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w6">
                                £50000-75000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('75000-100000');"
                                value="75000-100000"
                                                                name="pricesel" id="w7" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w7">
                                £75000-100000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="return searchprice('100000-150000');"
                                value="100000-150000"
                                                                name="pricesel" id="w8" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w8">
                                £100000-150000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" onclick="return searchprice('150000-250000');" type="radio"
                                value="150000-250000"
                                                                name="pricesel" id="w9" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w9">
                                £150000-250000
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" onclick="return searchprice('250000');" type="radio"
                                value="250000"
                                                                name="pricesel" id="w10" />
                            <label class="form-check-label fs-13 mytext-black text-uppercase" for="w10">
                                £250000+
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-9 bg-white">
                    <div class="search-box-category d-flex align-items-center mb-3">
                        <form action="" method="get" class="w-300 w-md-400">
                            <div class="d-flex">
                                <input type="text"
                                    class="bg-white border w-md-400 border-seacondary border-opcity-25 p-2 fs-14"
                                    name="search" placeholder="Search by category company or......" />
                                <button type="submit" class=" border border-seacondary border-opcity-25 bg-white px-2">
                                    <i class="fal fa-search mytext-black fs-16" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex gap-2">
                        <h5 class="fs-12 text-uppercase mytext-black">Jobs for you</h5>
                        <h6 class="fs-12 text-uppercase gtext fw-600">Popular</h6>
                    </div>
                    <?php

                    

                     $search=$job->url_var('search');

                     if($search){

                        $job->filter_jobs($search);
                        
                     }else{

                        $job->list_jobs();

                     }


                    ?>
                
                            
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include $path . '/apps/work/ui/layouts/footer.php';


?>