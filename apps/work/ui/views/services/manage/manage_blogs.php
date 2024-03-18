<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();

include $path . '/apps/work/ui/layouts/nav.php';

$role = $_SESSION['role'];


?>
<section class="d-block py-200">

    <div class="container">
    <div class="row ">
    <div class="col-12">
                <div class="d-block bg-white p-1 p-md-5 bg-white rounded-3 shadow">
                

                    <form method="get" action="" >
                                       
                         <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <input type="text"
                                        class="bg-white border w-100 border-seacondary border-opcity-25 p-2 fs-14"
                                        name="search" placeholder="Search by category company or......"
                                        value="" />
                                    <button type="submit"
                                        class=" border border-seacondary border-opcity-25 bg-white px-2"><i
                                            class="fal fa-search mytext-black fs-16" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            </div>
                        
                          
                    </form>
                </div>
            </div>
    

    <div class="row gy-4 pb-5">
     <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Posted </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Ongoing </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Completed </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Cancelled </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Open </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">  Applications</button>
  </li>


</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    Posted Contracts
    

</div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    Ongoing Contracts
    
</div>
<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    Completed Contracts
    
</div>
<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    Cancelled Contracts
    
</div>
<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    Open Contracts
    
</div>
<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
     Contracts Applications
    
</div>
  
</div>

</div>

</div>
</section>
<?php
include $path . '/apps/work/ui/layouts/footer.php';
?>