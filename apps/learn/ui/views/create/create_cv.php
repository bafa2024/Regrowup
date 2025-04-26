<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/HomeController.php';

$home=new HomeController();

$home->authCheck();

include $path.'/work/ui/layouts/nav.php';

?>
<style>
/* Chrome, Safari, Edge, Opera */
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>

<section class=" py-60 freelancerprofile">
    <div class="container-lg">
        <div class="row">
            <form method="POST" action="/api/resumesAPI.php" enctype="multipart/form-data">
                <input type="hidden" name="status" value="1">              
                  <input type="hidden" name="id" value="">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Cv page
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Picture</label>

                                    <input type="file" name="pic"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Fisrt Name</label>
                                    <input type="text" name="firstname"
                                        value="" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Last Name</label>
                                    <input type="text" name="lastname" required
                                        value=""
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Date Of Birth</label>
                                    <input type="date" name="dob" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2 dob" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Address</label>
                                    <textarea name="address" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Professional Bio</label>
                                    <textarea name="description" required id="" cols="30" rows="6"
                                        placeholder="Type here....."
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Skill</label>
                                    <input type="text" name="skill" required
                                        value=""
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Education
                                        Qualification</label>
                                    <input type="text"
                                        value=""
                                        name="qualification" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Work Experience</label>
                                    <input type="text" name="work_exp" required
                                        value=""
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto" name="create_resume">
                                        Save details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<?php
include $path.'/work/ui/layouts/footer.php';
?>
<script>
function freelancerserverice() {
    $('.freelancerprofile').css('display', 'block');
    $('.offerpage').css('display', 'none');
}

function studentserverice() {
    $('.studentservice').css('display', 'block');
    $('.offerpage').css('display', 'none');
}

function contractserverice() {
    $('.contractservice').css('display', 'block');
    $('.offerpage').css('display', 'none');
}
$(document).ready(function() {
    var today = '';
    $('.dob').val(today);
});
</script>