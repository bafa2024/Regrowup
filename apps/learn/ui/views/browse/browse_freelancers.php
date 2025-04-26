<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();

include $path . '/work/ui/layouts/nav.php';

$role = $_SESSION['role'];

if ($role == 'freelancer' || $role == 'Freelancer') {

    ?>
    
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
                                    Browse Freelancers                            </h2>

                            </div>
                    
                        </div>

                        <form method="get" action="" enctype="multipart/form-data">
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

                                    $contract->select_countries();
                                      ?>
                                                                                                        
                                </div>
                        
                                <div class="col-md-3">
                                    <select name="price" id=""
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Charges</option>
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

                                        <option value="250" >£250+
                                        </option>
                                    </select>
                                </div>
                        
                                <div class="col-md-4">
                                    <label for="" class="text-white fs-14 text-uppercase mb-2 d-none d-md-block">s</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/work/ui/views/browse/browse_contracts.php" class="clear-btn float-md-end">
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
                <div class="card mb-3 shadow" style="max-width: 1300px;">
                <?php
                    if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['price']) 
                    && !empty($_GET['price']) && isset($_GET['city']) && !empty($_GET['city'])) {

                        $search_query = array($search_query1, $search_query2, $search_query3);

                        if (!empty($search_query)) {
                            $contract->filter_freelancers($search_query);
                        }

                    } else {

                        $contract->freelancers();
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
include $path . '/work/ui/layouts/footer.php';


?>