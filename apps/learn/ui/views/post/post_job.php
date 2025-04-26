<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();

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


<section class="py-60 postform">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <form method="POST" action="/api/jobsAPI.php" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <h5>Post a Job</h5>
                            <div class="col-12">
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Job Title
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="job_title" id="job_title"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Job Title">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Company
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="company" id="company"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Company">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Contract Type
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <select required name="contract_type"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="">Select Contract Type</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Freelance">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Choose Your Industry:
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="hidden" name="jobstatus" id="jobstatus" value="1">
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="<?php echo $_SESSION['user_id']; ?>">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Industry:<span class="fs-16 fw-900 text-danger">*</span></label>
                                        
                                            <?php

                                            echo $job->get_industries();

                                            ?>
                                        
                                    </div>
                                    <div class="col-md-6 addsubcat">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Sub-Industry:
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        
                                            <?php

                                            echo $job->get_sub_industries();

                                            ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for=""
                                                class="mytext-black fs-14 text-uppercase">Location:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="location" required
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Salary:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="salary" required
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Describe Your Job Offer?
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <textarea name="description" id="checkeyword" required cols="30" rows="7"
                                                maxlength="5000" oninput="return checksseyword()"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                            <span class="fs-12 text-end countype">0/5000</span>
                                        </div>
                                        <div class="d-block rel">
                                            <input type="file" name="file" placeholder=""
                                                class="" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Person Specifications:</label>
                                            <textarea name="person_specifications" id="person_specifications" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Skill Requirements:</label>
                                            <textarea name="skill_requirements" id="skill_requirements" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Qualifications Requirements:</label>
                                            <textarea name="qualifications_requirements" id="qualifications_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Experience Requirements:</label>
                                            <textarea name="experience_requirements" id="experience_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-primary btn-lg p-3" name="post_job">Post Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include $path.'/apps/work/ui/layouts/footer.php';
?>

<script>
function checksseyword() {
    var len = $('#checkeyword').val().length;
    $('.countype').text(len + '/5000');
}
</script>
