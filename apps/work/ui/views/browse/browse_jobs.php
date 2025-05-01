<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();



include $path . '/apps/work/ui/layouts/nav.php';


if ($role == 'Professional') {

    ?>
            <section class="d-block py-60">
            <div class="container-lg">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                            <div class="d-flex flex-column mb-4">
                                <div class="d-flex flex-row align-items-center justify-content-between mb-4">
                                    <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                        Browse Jobs </h2>

                                </div>
                
                            </div>

                            <form method="get" action="" >
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="text"
                                                class="bg-white border w-md-700 border-seacondary border-opcity-25 p-2 fs-14"
                                                name="search" placeholder="Search by category company or......"
                                                value="" />
                                            <button type="submit"
                                                class=" border border-seacondary border-opcity-25 bg-white px-2"><i
                                                    class="fal fa-search mytext-black fs-16" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                            

                                    <div class="col-md-3">
                                        <?php

                                        $job->select_countries();
                                        ?>
                                                                                                        
                                    </div>
                        
                                    <div class="col-md-3">
                                    
                                        <select  name="con_ty"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="">Select Contract Type</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Freelance">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="text-white fs-14 text-uppercase mb-2 d-none d-md-block">s</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/apps/work/ui/views/browse/browse_jobs.php" class="clear-btn float-md-end">
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
    
                    <div class="d-flex flex-column gap-3">
                    <div class="card mb-3  bordered shadow" style="max-width: 1300px;">
                    <?php



                    $search = $job->url_var('search');
                    $contract_type = $job->url_var('con_ty');
                    $location = $job->url_var('country');

                    if ($search) {

                        $job->search_jobs($search);

                    }elseif($contract_type){

                        $job->filter_jobs_type($contract_type);
                    
                    }elseif($location){

                        $job->filter_jobs_location($location);
                    
                    }else {

                        $job->list_jobs();

                    }


                    ?>
            
                    </div>
                    </div>
            
        


                </div>
            </div>
        </section>

        <?php
} elseif ($role == 'client' || $role == 'Client') {

    ?>
<section class="d-block py-60">
            <div class="container-lg">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                            <div class="d-flex flex-column mb-4">
                                <div class="d-flex flex-row align-items-center justify-content-between mb-4">
                                    <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                        Browse Jobs </h2>

                                </div>
                
                            </div>

                            <form method="get" action="" >
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="text"
                                                class="bg-white border w-md-700 border-seacondary border-opcity-25 p-2 fs-14"
                                                name="search" placeholder="Search by category company or......"
                                                value="" />
                                            <button type="submit"
                                                class=" border border-seacondary border-opcity-25 bg-white px-2"><i
                                                    class="fal fa-search mytext-black fs-16" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                            

                                    <div class="col-md-3">
                                        <?php

                                        $job->select_countries();
                                        ?>
                                                                                                        
                                    </div>
                        
                                    <div class="col-md-3">
                                    
                                        <select  name="con_ty"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="">Select Contract Type</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Freelance">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="text-white fs-14 text-uppercase mb-2 d-none d-md-block">s</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/apps/work/ui/views/browse/browse_jobs.php" class="clear-btn float-md-end">
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
    
                    <div class="d-flex flex-column gap-3">
                    <div class="card mb-3  bordered shadow" style="max-width: 1300px;">
                    <?php



                    $search = $job->url_var('search');
                    $contract_type = $job->url_var('con_ty');
                    $location = $job->url_var('country');

                    if ($search) {

                        $job->search_jobs($search);

                    }elseif($contract_type){

                        $job->filter_jobs_type($contract_type);
                    
                    }elseif($location){

                        $job->filter_jobs_location($location);
                    
                    }else {

                        $job->list_jobs();

                    }


                    ?>
            
                    </div>
                    </div>
            
        


                </div>
            </div>
        </section>


    <?php
}
?>


<?php
include $path . '/apps/work/ui/layouts/footer.php';


?>