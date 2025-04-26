<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();

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
                <h6 class="align-center">Clients Jobs Dashboard</h6>   
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
                                
                                <a href="/work/ui/views/manage/manage_jobs.php" class=" border border-seacondary border-opcity-25 bg-white px-2">Clear</a>
                            </div>
                        </div>
                        </div>
                    
                      
                </form>
            </div>
</div>


<div class="row gy-3 pb-3  shadow">
<ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="open-tab" data-bs-toggle="tab" data-bs-target="#open-tab-pane" type="button" role="tab" aria-controls="open-tab-pane" aria-selected="true">Active Adverts </button>
</li>

<li class="nav-item" role="presentation">
<button class="nav-link " id="closed-tab" data-bs-toggle="tab" data-bs-target="#closed-tab-pane" type="button" role="tab" aria-controls="closed-tab-pane" aria-selected="false">Closed Adverts</button>
</li>

</ul>

<div class="tab-content " id="myTabContent" >
<div class="tab-pane fade show active" id="open-tab-pane" role="tabpanel" aria-labelledby="open-tab" tabindex="0">
Posted Jobs
<?php
$search=$job->url_var('search');
$uid=$_SESSION['id'];
if($search){
    $job->search_list_client_open_jobs($uid,$search);
}else{
    $job->list_client_open_jobs($_SESSION['id']);
}

?>

</div>

<div class="tab-pane fade" id="closed-tab-pane" role="tabpanel" aria-labelledby="closed-tab" tabindex="0">
Closed Jobs
<?php
$search=$job->url_var('search');
$uid=$_SESSION['id'];
if($search){
    $job->search_list_client_closed_jobs($uid,$search);
}else{
    $job->list_client_closed_jobs($uid);
}

?>


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
                <h6 class="align-center">Freelancer Jobs Dashboard</h6>   
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
                                        <a href="/work/ui/views/manage/manage_jobs.php" class=" border border-seacondary border-opcity-25 bg-white px-2">Clear</a>
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