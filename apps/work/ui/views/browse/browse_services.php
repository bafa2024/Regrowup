<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ServicesController.php';

$services=new ServicesController();

$services->authCheck();

include $path.'/apps/work/ui/layouts/nav.php';
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
                                Browse Local Services                         </h2>

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
                                    $services->select_countries();
                                    ?>
                                
                            </div>
                            

                            <div class="col-md-4">
                                <label for="" class="text-white fs-14 text-uppercase mb-2 d-none d-md-block">s</label>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="/apps/work/ui/views/browse/browse_services.php" class="clear-btn float-md-end">
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
            <?php



                    $search = $services->url_var('search');
                
                    $location = $services->url_var('country');

                    if ($search) {

                        $services->search_services($search);

                
                    }elseif($location){

                        $services->filter_services($location);
                    
                    }else {

                        $services->list_services();

                    }


                    ?>
            
            </div>
        
                
        

            
        
        
            
            
                                


        </div>
    </div>
</section>
<?php
include $path.'/apps/work/ui/layouts/footer.php';


?>