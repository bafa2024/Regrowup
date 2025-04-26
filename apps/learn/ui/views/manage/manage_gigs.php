<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/GigsController.php';

$gig = new GigsController();

$gig ->authCheck();

include $path . '/work/ui/layouts/nav.php';


$role = $_SESSION['role'];

if($role=="Client" || $role=="client"){

?>
<section class="d-block py-200">

<div class="container">
<div class="row ">
<div class="col-12">
            <div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 shadow">
            

                <form method="get" action="" >
                <h6 class="align-center">Clients Gigs Dashboard</h6>   
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
                                
                                <a href="/work/ui/views/manage/manage_gigs.php" class=" border border-seacondary border-opcity-25 bg-white px-2">Clear</a>
                            </div>
                        </div>
                        </div>
                    
                      
                </form>
            </div>
</div>


<div class="row gy-3 pb-3 shadow">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane" type="button" role="tab" aria-controls="active-tab-pane" aria-selected="true">Active</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="need-details-tab" data-bs-toggle="tab" data-bs-target="#need-details-tab-pane" type="button" role="tab" aria-controls="need-details-tab-pane" aria-selected="false">Need Details</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered-tab-pane" type="button" role="tab" aria-controls="delivered-tab-pane" aria-selected="false">Delivered</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled-tab-pane" type="button" role="tab" aria-controls="cancelled-tab-pane" aria-selected="false">Cancelled</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="false">All</button>
    </li>
  </ul>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel" aria-labelledby="active-tab" tabindex="0">
      Active 
      <!-- PHP code for displaying active adverts goes here -->
    </div>

    <div class="tab-pane fade" id="need-details-tab-pane" role="tabpanel" aria-labelledby="need-details-tab" tabindex="0">
      Need Details
      <!-- PHP code for displaying need details adverts goes here -->
    </div>

    <div class="tab-pane fade" id="delivered-tab-pane" role="tabpanel" aria-labelledby="delivered-tab" tabindex="0">
      Delivered
      <!-- PHP code for displaying delivered adverts goes here -->
    </div>

    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
      Completed
      <!-- PHP code for displaying completed adverts goes here -->
    </div>

    <div class="tab-pane fade" id="cancelled-tab-pane" role="tabpanel" aria-labelledby="cancelled-tab" tabindex="0">
      Cancelled
      <!-- PHP code for displaying cancelled adverts goes here -->
    </div>

    <div class="tab-pane fade" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
      All
      <!-- PHP code for displaying all adverts goes here -->
    </div>
  </div>
</div>





</div>

</div>

</div>
</div>
</section>

<?php

}else{

?>
<section class="d-block py-200">

<div class="container">
<div class="row ">
<div class="col-12">
            <div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 shadow">
            

                <form method="get" action="" >
                <h6 class="align-center">Gigs Dashboard</h6>   
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
                                        <a href="/work/ui/views/manage/manage_gigs.php" class=" border border-seacondary border-opcity-25 bg-white px-2">Clear</a>
                            </div>
                        </div>
                        </div>
                    
                      
                </form>
            </div>
</div>


<div class="row gy-3 pb-3  shadow">
<ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved-tab-pane" type="button" role="tab" aria-controls="saved-tab-pane" aria-selected="true">Saved Jobs </button>
</li>

<li class="nav-item" role="presentation">
<button class="nav-link" id="applied-tab" data-bs-toggle="tab" data-bs-target="#applied-tab-pane" type="button" role="tab" aria-controls="applied-tab-pane" aria-selected="false">Applied Jobs </button>
</li>


</ul>

<div class="tab-content " id="myTabContent" >
<div class="tab-pane fade show active" id="saved-tab-pane" role="tabpanel" aria-labelledby="saved-tab" tabindex="0">
Saved Jobs
<?php
$search=$job->url_var('search');
$uid=$_SESSION['id'];
if($search){
    $job->search_saved_jobs($uid,$search);
}else{
    $job->saved_jobs($uid);
}
?>
</div>
<div class="tab-pane fade" id="applied-tab-pane" role="tabpanel" aria-labelledby="applied-tab-pane" tabindex="0">
Applied Jobs

<?php
$search=$job->url_var('search');
$uid=$_SESSION['id'];
if($search){
    $job->search_applied_jobs($uid,$search);
}else{
    $job->applied_jobs($_SESSION['id']);
}



?>
</div>

</div>

</div>

</div>
</div>
</section>



<?php
}


include $path . '/work/ui/layouts/footer.php';
?>