<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();


include $path . '/work/ui/layouts/nav.php';

$role = $_SESSION['role'];

if($role == 'freelancer' || $role=='Freelancer'){
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
<button class="nav-link active" id="open-tab" data-bs-toggle="tab" data-bs-target="#open-tab-pane" type="button" role="tab" aria-controls="open-tab-pane" aria-selected="false">Offers </button>
</li>
 <li class="nav-item" role="presentation">
<button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted-tab-pane" type="button" role="tab" aria-controls="accepted-tab-pane" aria-selected="false">  Accepted</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected-tab-pane" type="button" role="tab" aria-controls="rejected-tab-pane" aria-selected="false">Rejected </button>
</li>




</ul>

<div class="tab-content" id="myTabContent">
<div class="tab-pane fade" id="open-tab-pane" role="tabpanel" aria-labelledby="open-tab" tabindex="0">
Offers
<?php
$contract->fr_offers($_SESSION['id']);
?>

</div>

<div class="tab-pane fade" id="accepted-tab-pane" role="tabpanel" aria-labelledby="accepted-tab" tabindex="0">
Accepted Offers
<?php
$contract->my_contracts($_SESSION['id']);
?>
</div>
<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
Rejected Offers
</div>


</div>

</div>

</div>
</section>



<?php
}elseif($role == 'client' || $role=='Client'){
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
<button class="nav-link active" id="open-tab" data-bs-toggle="tab" data-bs-target="#open-tab-pane" type="button" role="tab" aria-controls="open-tab-pane" aria-selected="false">Open </button>
</li>
 <li class="nav-item" role="presentation">
<button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted-tab-pane" type="button" role="tab" aria-controls="accepted-tab-pane" aria-selected="false">  Awarded Contracts</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected-tab-pane" type="button" role="tab" aria-controls="rejected-tab-pane" aria-selected="false">Closed Contracts </button>
</li>




</ul>

<div class="tab-content" id="myTabContent">
<div class="tab-pane fade" id="open-tab-pane" role="tabpanel" aria-labelledby="open-tab" tabindex="0">
Offered Contracts
<?php
$contract->cl_contract_applications($_SESSION['id']);
?>

</div>

<div class="tab-pane fade" id="accepted-tab-pane" role="tabpanel" aria-labelledby="accepted-tab" tabindex="0">
Accepted Offers
<?php
$contract->awarded_contracts($_SESSION['id']);
?>

</div>
<div class="tab-pane fade" id="rejected-tab-pane" role="tabpanel" aria-labelledby="rejected-tab" tabindex="0">
Closed Contracts
</div>


</div>

</div>

</div>
</section>



  <?php
}
include $path . '/work/ui/layouts/footer.php';
?>