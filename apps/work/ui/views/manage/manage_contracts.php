<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();

include $path . '/apps/work/ui/layouts/nav.php';

$role = $_SESSION['role'];

if($role=="Client" || $role=="client"){

?>
<section class="d-block py-200">

<div class="container">
<div class="row ">
<div class="col-12">
            <div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 shadow">
        

                <form method="get" action="" >
                <h6 class="align-center">Clients Contracts Dashboard</h6>   
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


<div class="row gy-3 pb-3  shadow">
<ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="open-tab" data-bs-toggle="tab" data-bs-target="#open-tab-pane" type="button" role="tab" aria-controls="open-tab-pane" aria-selected="true">Open </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids-tab-pane" type="button" role="tab" aria-controls="bids-tab-pane" aria-selected="false">Applications </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="awarded-tab" data-bs-toggle="tab" data-bs-target="#awarded-tab-pane" type="button" role="tab" aria-controls="awarded-tab-pane" aria-selected="false">Awarded Contracts </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing-tab-pane" type="button" role="tab" aria-controls="ongoing-tab-pane" aria-selected="false">Ongoing </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link " id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed </button>
</li>

</ul>

<div class="tab-content " id="myTabContent" >
<div class="tab-pane fade show active" id="open-tab-pane" role="tabpanel" aria-labelledby="open-tab" tabindex="0">
Open Contracts
<?php

$contract->open_contracts_cl($_SESSION['id']);
?>

</div>
<div class="tab-pane fade" id="awarded-tab-pane" role="tabpanel" aria-labelledby="awarded-tab" tabindex="0">
Awarded-tab Contracts
<?php

$contract->awarded_contracts($_SESSION['id']);
?>
</div>
<div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
Completed Contracts
<?php
$contract->completed_contracts($_SESSION['id']);

?>


</div>
<div class="tab-pane fade show" id="bids-tab-pane" role="tabpanel" aria-labelledby="bids-tab" tabindex="0">


<?php

$contract->cl_contract_applications($_SESSION['id']);

?>
</div>
<div class="tab-pane fade" id="ongoing-tab-pane" role="tabpanel" aria-labelledby="ongoing-tab" tabindex="0">
Ongoing Contracts
<br>
<button onclick="showClock()" class="btn btn-primary">Track</button>
</br>
<?php
$contract->ongoing_contracts($_SESSION['id']);

?>
</div>



</div>

</div>

</div>
</div>
</section>

<?php

}elseif($role=="Professional" || $role=="professional"){

?>
<section class="d-block py-50">

<div class="container">
<div class="row ">
<div class="col-12">
            <div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 shadow">
            

                <form method="get" action="" >
                                <h6>My Contracts </h6>   
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


<div class="row gy-3 pb-3  shadow">
 <ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="open-tab" data-bs-toggle="tab" data-bs-target="#open-tab-pane" type="button" role="tab" aria-controls="open-tab-pane" aria-selected="true">Open </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids-tab-pane" type="button" role="tab" aria-controls="bids-tab-pane" aria-selected="false">Applications </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="offers-tab" data-bs-toggle="tab" data-bs-target="#offers-tab-pane" type="button" role="tab" aria-controls="offers-tab-pane" aria-selected="false">Offers</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing-tab-pane" type="button" role="tab" aria-controls="ongoing-tab-pane" aria-selected="false">Ongoing </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link " id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed </button>
</li>





</ul>

<div class="tab-content " id="myTabContent" >
<div class="tab-pane fade show active" id="open-tab-pane" role="tabpanel" aria-labelledby="open-tab" tabindex="0">
Open Contracts
<?php

$contract->open_contracts_fr();

?>

</div>
<div class="tab-pane fade" id="offers-tab-pane" role="tabpanel" aria-labelledby="offers-tab" tabindex="0">
Offers
<?php
$contract->fr_offers($_SESSION['id']);
?>
</div>
<div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
Completed Contracts
<?php

$contract->completed_contracts_fr($_SESSION['id']);

?>


</div>
<div class="tab-pane fade show" id="bids-tab-pane" role="tabpanel" aria-labelledby="bids-tab" tabindex="0">


<?php

$contract->contract_applications($_SESSION['id']);

?>
</div>
<div class="tab-pane fade" id="ongoing-tab-pane" role="tabpanel" aria-labelledby="ongoing-tab" tabindex="0">
Ongoing Contracts
<?php
$contract->ongoing_contracts_fr($_SESSION['id']);
?>
</div>


</div>

</div>

</div>
</section>



<?php
}


include $path . '/apps/work/ui/layouts/footer.php';
?>