<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/GigsController.php';

$gig=new GigsController();

$gig->authCheck();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['create_gig_step1'])){

    $res=$gig->store_gigs_step1();

   if($res){
    header("Location:/apps/work/ui/views/post/post_gig_step2.php?gig=$res");
    }else{
        echo "error";
    }

}

if(isset($_POST['create_gig_step2'])){

    $res=$gig->store_gigs_step2();

   if($res){
        header("Location:/apps/work/ui/views/browse/browse_gigs.php");
    }else{
        echo "error";
    }

}

/*
if($_GET['act']=="list"){
    $res=$gig->get_gigs($uid);
    while($row=mysqli_fetch_assoc($res)){
        echo 
        '

                <div class="col-12 col-md-4">
                    <div class="d-flex flex-column gap-3 my-1">
                        <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column gap-1">
                                    <img class="w-100" src="'.$row['gigimages'].'">
                                    <ul
                                        class="mtext-black ls-none d-flex gap-2 ps-3 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                        <li>
                                            <div
                                                class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                <img src="/ui/profileimage/user.jpg"
                                                    alt="logo">
                                                                                            </div>
                                        </li>
                                        <li> Hi</li>
                                    </ul>




                                    <ul class="d-flex gap-4 ps-3 flex-wrap">
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">
                                                Posted 16 hours ago
                                            </h4>
                                        </li>
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                        </li>

                                    </ul>
                                </div>

                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    gfdgdfg
                                </p>
                                <hr>
                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    Starting At <strong>$23424</strong>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-flex flex-column gap-3 my-1">
                        <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column gap-1">
                                    <img class="w-100" src="http://itsugestion.com/dev/workhouse/public/gigpic/image.png">



                                    <ul
                                        class="mtext-black ls-none d-flex gap-2 ps-3 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                        <li>
                                            <div
                                                class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                    <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg"
                                                    alt="logo">
                                                </div>
                                        </li>
                                        <li> Hi</li>
                                    </ul>




                                    <ul class="d-flex gap-4 ps-3 flex-wrap">
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">
                                                Posted 16 hours ago
                                            </h4>
                                        </li>
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                        </li>

                                    </ul>
                                </div>

                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    Test
                                </p>
                                <hr>
                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    Starting At <strong>$Test</strong>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-flex flex-column gap-3 my-1">
                        <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column gap-1">
                                    <img class="w-100" src="http://itsugestion.com/dev/workhouse/public/gigpic/image.png">



                                    <ul
                                        class="mtext-black ls-none d-flex gap-2 ps-3 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                        <li>
                                            <div
                                                class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                                    <img src="http://itsugestion.com/dev/workhouse/public/profileimage/user.jpg"
                                                    alt="logo">
                                                </div>
                                        </li>
                                        <li> Hi</li>
                                    </ul>




                                    <ul class="d-flex gap-4 ps-3 flex-wrap">
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">
                                                Posted 16 hours ago
                                            </h4>
                                        </li>
                                        <li>
                                            <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                        </li>

                                    </ul>
                                </div>

                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    Test
                                </p>
                                <hr>
                                <p class="vclip d-block mytext-black fs-14 mt-1">
                                    Starting At <strong>$Test</strong>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
        

            
        ';
    }
}
*/
//Create script to purchase gigs

if(isset($_POST['pur_gig'])){
    $gig_id=$_POST['gig_id'];
    $freelancer_id=$_POST['user_id'];
    $client_id=$_POST['client_id'];

    $payment=$_POST['payment'];
    $price=$_POST['price'];
    $order_date=$_POST['order_date'];
    
    $res=$gig->purchase_gig($gig_id,$freelancer_id,$client_id,$price,$payment,$order_date);
    if($res){
        $gig->alert_redirect("Gig Purchased","/apps/work/ui/views/browse/browse_gigs.php");
    }else{
        $gig->alert_redirect("Error, Try Again","/apps/work/ui/views/browse/browse_gigs.php");
    }
}







