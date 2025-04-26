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
.chatbtn {
    display: none;
}
</style>
<section class="d-block py-35">
    <div class="container-lg">
        <div class="row g-md-0">
            <div class="col-md-3 gbg border border-secondary border-opacity-25">
                <div class="search-box-category d-flex align-items-center mb-3">
                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="txxKPEpx1cgnpT1yGU7r4sEBJ7LOmzmFCuEajf7C">                        <div class="search-box-category d-flex align-items-center">
                            <input type="text" name="searchcontact" value=""
                                placeholder="Search contact" class="searchcontact" />
                            <button type="button" onclick="return searchcontacts();"
                                class=" border border-seacondary border-opcity-25 bg-white"><i
                                    class="fal fa-search mytext-black fs-16" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
                <div class="contact-boxes d-flex flex-column">
                                        <div class="d-flex flex-column gap-1">
                        No results found!
                    </div>
                                    </div>
            </div>
            <style>
            .contact-boxes .active {
                background: #4BADF2;
            }
            </style>
            <div class="col-md-9 bg-white shadow">
                <div
                    class="d-flex align-items-center gbg justify-content-between border-bottom border-secondary border-opacity-25 py-6 px-10">
                    <div class="flex-grow-1">
                        <h3 class="mytext-black fw-800 fs-18 text-uppercase">
                            Your conversation
                        </h3>
                    </div>
                    <div class="shrink-0">
                        <button type="button" class="mytext-black fs-14 border-0 bg-transparent">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-column p-2 p-md-5 outer-chat-box fromchat">
                                                            <div id="downscroll"></div>
                    

                </div>
                            </div>
        </div>
    </div>
</section>
<?php
include $path.'/apps/work/ui/layouts/footer.php';


?>
