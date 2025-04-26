<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/HomeController.php';

$home=new HomeController();

$home->authCheck();

//$home->notications();

$user_type=$_SESSION['user_type'];

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
                                Read our FAQs                       </h2>

                        </div>
                        <!-- <p class="mytext-black text-uppercase fs-16 fs-md-18">
                            Clear price, great quality, express delieevery
                        </p> -->
                    </div>

                    
                </div>
            </div>

            <!-- New GiGS -->

            <!--Item 1 -->
                        
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black text-uppercase fs-18 fw-800">
                                Local Jobs
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                                Painter
                            </h4>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        Posted 1 day ago
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">3 applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">Aberaman</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                            dsisjjjjdkddpdpdpddpdpakaakmd
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                                                        <a href="http://itsugestion.com/dev/workhouse/applyjob/13" class="apply-btn">Apply Now</a>
                            
                                                        <a href="http://itsugestion.com/dev/workhouse/savejob/13"
                                class="mytext-black fs-14 border-0 bg-transparent">
                                <i class="fal fa-bookmark"></i>
                            </a>
                                                    </div>
                    </div>
                </div>
            </div>

            
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black text-uppercase fs-18 fw-800">
                                Local Jobs
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                                Funeral director
                            </h4>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        Posted 2 days ago
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">1 applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">Abingdon</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                                                        <a href="http://itsugestion.com/dev/workhouse/applyjob/12" class="apply-btn">Apply Now</a>
                            
                                                        <a href="http://itsugestion.com/dev/workhouse/savejob/12"
                                class="mytext-black fs-14 border-0 bg-transparent">
                                <i class="fal fa-bookmark"></i>
                            </a>
                                                    </div>
                    </div>
                </div>
            </div>

            
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black text-uppercase fs-18 fw-800">
                                Local Jobs
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                                Mason
                            </h4>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        Posted 2 days ago
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">1 applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">Aberystwyth</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                                                        <a href="http://itsugestion.com/dev/workhouse/applyjob/11" class="apply-btn">Apply Now</a>
                            
                                                        <a href="http://itsugestion.com/dev/workhouse/savejob/11"
                                class="mytext-black fs-14 border-0 bg-transparent">
                                <i class="fal fa-bookmark"></i>
                            </a>
                                                    </div>
                    </div>
                </div>
            </div>

            
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black text-uppercase fs-18 fw-800">
                                Local Jobs
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                                Carpenter
                            </h4>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        Posted 2 days ago
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">2 applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">Abingdon</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                                                        <a href="http://itsugestion.com/dev/workhouse/applyjob/10" class="apply-btn">Apply Now</a>
                            
                                                        <a href="http://itsugestion.com/dev/workhouse/savejob/10"
                                class="mytext-black fs-14 border-0 bg-transparent">
                                <i class="fal fa-bookmark"></i>
                            </a>
                                                    </div>
                    </div>
                </div>
            </div>

                                    <!--Item 2 -->



            <!-- New GiGS End-->


        </div>
    </div>
</section>
<?php
include $path.'/apps/work/ui/layouts/footer.php';


?>
