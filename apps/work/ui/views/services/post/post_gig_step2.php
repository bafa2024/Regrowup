<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/HomeController.php';

$home = new HomeController();

$home->authCheck();

//$home->notications();

$user_type = $_SESSION['user_type'];

include $path . '/apps/work/ui/layouts/nav.php';

?>
<style>
.step3 {
    display: none;
}

.step2 {
    display: none;
}
</style>
<section class="d-block py-60">
    <div class="container-lg">
        <div class="row gy-4">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <div class="d-flex flex-column mb-4">
                        <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                            Create Gig
                        </h2>
                    </div>
                    <form method="POST" action="/api/gigsAPI.php" enctype="multipart/form-data">
                                        
                            
                        <input type="hidden" name="gig_id" value="<?php $_GET['gig'];?>">  

                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Description</label>
                                    <textarea name="step2_description" id="step2_description" required cols="30"
                                        rows="4" placeholder="Description of the Gig offered"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">create FAQ</label>
                                    <!-- loop -->
                                    <ol class="d-flex flex-column gap-2 ps-2 appendfaq">
                                        <li class="">
                                            <input type="text" name="question" required
                                                placeholder="Type questions here....."
                                                class="question_1 bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2 mb-2" />
                                            <textarea name="answer" required id="" cols="30" rows="4"
                                                placeholder="Type answers here....."
                                                class="ans_1 bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                        </li>
                                    </ol>
                                    <!-- <div class="appendfaq">

                                    </div> -->
                                    
                                </div>

                            </div>
                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Requirements from client e.g
                                        a link, files, information etc.</label>
                                    <textarea name="requirement" id="" required cols="30" rows="4"
                                        placeholder="Type here....."
                                        class="requirement bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                        
                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Upload Images
                                        <span class="ince">Maximum 5</span></label>
                                    <div class="row row-cols-2 row-cols-md-5 addmoreimage">
                                        <div class="col">
                                            <div
                                                class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden">
                                                <div class="text-center d-flex flex-column">
                                                    <i class="fal fa-image fs-40 text-secondary"></i>
                                                    <h6 class="fs-14 text-secondary fw-400 ">Drag a photo or <span
                                                            class="mytext-primary">Browse</span></h6>
                                                </div>
                                                <input type="file"  name="image" id=""
                                                    class="file-upload images">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 step3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="submi-btn border-0 addimages"> <i
                                                    class="fal fa-plus"></i>
                                                Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Upload Videos
                                        <span>Maximum 5</span></label>
                                    <div class="row row-cols-2 row-cols-md-5 addmorevideo">
                                        <div class="col">
                                            <div
                                                class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden">
                                                <div class="text-center d-flex flex-column">
                                                    <i class="fal fa-image fs-40 text-secondary"></i>
                                                    <h6 class="fs-14 text-secondary fw-400 ">Drag a video or <span
                                                            class="mytext-primary">Browse</span></h6>
                                                </div>
                                                <input type="file" name="video" id="" class="file-upload">
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-12 step1">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="submi-btn border-0" name="create_gig_step2">
                                        Publish gig</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include $path . '/apps/work/ui/layouts/footer.php';
?>
<script>

var appendfaq = $('.appendfaq');
var addfaq = $('.addfaq');
var i = 2;
$(addfaq).click(function() {
    if (i <= 100) {
        i++;
        var html =
            ' <div class="rem_' + i +
            '"><li> <input type="text" placeholder="Type questions here....." class="question_' + i +
            ' bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2 mb-2 q_' +
            i +
            '" name="question[]" /> <textarea name="ans[]" id="" cols="30" rows="4" placeholder="Type answers here....." class="ans_' +
            i +
            ' bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea> </li> <div class=""><button type="button" class="btn btn-danger" onclick="return removediv(' +
            i + ')">Remove</button></div></div>';
        $(appendfaq).append(html);
    }
});

function removediv(id) {
    $('.rem_' + id).remove();
}

function formstep2() {
    var step2_description = $('#step2_description').val();
    var question_1 = $('.question_1').val();
    var requirement = $('.requirement').val();
    var ans_1 = $('.ans_1').val();
    if (step2_description != "" && question_1 != "" && ans_1 != "" && requirement != "") {
        $('.formstep2').attr('type', 'button');
        $('.step2').css('display', 'none');
        $('.step3').css('display', 'block');
    }
}
var ix = 1;
var ii = 1;
var addimages = $('.addimages');
var addmoreimage = $('.addmoreimage');
$(addimages).click(function() {
    if (ii < 5) {
        ii++;

        var html =
            '<div class="col remoimage_' + ii +
            '"> <div class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden"> <div class="text-center d-flex flex-column"> <i class="fal fa-image fs-40 text-secondary"></i> <h6 class="fs-14 text-secondary fw-400 ">Drag a photo or <span class="mytext-primary">Browse</span></h6> </div> <input type="file" required name="image[]" id="" class="file-upload images"> </div> <button type="button" class="mt-4 btn btn-danger" onclick="return removeimage(' +
            ii + ')">Remove</button></div>';
        $(addmoreimage).append(html);
    }
});

function removeimage(id) {
    $('.remoimage_' + id).remove();
}
var addvideos = $('.addvideos');
var addmorevideo = $('.addmorevideo');
$(addvideos).click(function() {
    if (ix < 5) {
        ix++;

        var html =
            '<div class="col remvideo_' + ix +
            '"> <div class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden"> <div class="text-center d-flex flex-column"> <i class="fal fa-image fs-40 text-secondary"></i> <h6 class="fs-14 text-secondary fw-400 ">Drag a video or <span class="mytext-primary">Browse</span></h6> </div> <input type="file" name="file[]" id="" class="file-upload"> </div> <button type="button" class="mt-4 btn btn-danger" onclick="return removevideo(' +
            ix + ')">Remove</button> </div>';
        $(addmorevideo).append(html);
    }
});

function removevideo(id) {
    $('.remvideo_' + id).remove();
}
</script>