<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();

$jobId=$job->url_var('jo');

$job_details = $job->get_job_details($jobId);


$job_title = $job_details['job_title'];
$company = $job_details['company'];
$location = $job_details['location'];
$industry = $job_details['industry'];
$subindustry = $job_details['subindustry'];
$contract_type = $job_details['contract_type'];
$salary = $job_details['salary'];
$level = $job_details['level'];
$person_specifications = $job_details['person_specifications'];
$skill_requirements = $job_details['skill_requirements'];
$qualifications_requirements = $job_details['qualifications_requirements'];
$experience_requirements = $job_details['experience_requirements'];
$job_description = $job_details['job_description'];


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

<?php
$role = $_SESSION['role'];

if($role=="Client" || $role=="client"){

?>
<section class="py-60 postform">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <form method="POST" action="/api/jobsAPI.php" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
                        <div class="row gy-4">
                            <h5>Post a Job</h5>
                            <div class="col-12">
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Job Title
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="job_title" id="job_title"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Job Title"  value="<?php echo $job_title; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Company
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="company" id="company"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Company" value="<?php echo $company; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Contract Type
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <select required name="contract_type"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="<?php echo $contract_type; ?>"><?php echo $contract_type; ?></option>
                                            <hr>
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
                                            <input type="text" name="location" required value="<?php echo $location; ?>"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Salary:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="salary" required value="<?php echo $salary; ?>"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Job Description
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <textarea name="description" id="checkeyword" required cols="30" rows="7"
                                                maxlength="5000" oninput="return checksseyword()"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $job_description; ?></textarea>
                                            <span class="fs-12 text-end countype">0/5000</span>
                                        </div>
                                        <div class="d-block rel">
                                            <input type="file" name="file" placeholder=""
                                                class="position-absolute zi-3 attac-file" />
                                            <p class="mytext-black fs-14">
                                                Attached a file <i class="fal fa-paperclip"></i>
                                            </p>
                                        </div>
                                    </div>

                                
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Person Specifications:</label>
                                            <textarea name="person_specifications" id="person_specifications" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $job_description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Skill Requirements:</label>
                                            <textarea name="skill_requirements" id="skill_requirements" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $skill_requirements; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Qualifications Requirements:</label>
                                            <textarea name="qualifications_requirements" id="qualifications_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $qualifications_requirements; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Experience Requirements:</label>
                                            <textarea name="experience_requirements" id="experience_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $experience_requirements; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit"
                                    class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2" name="update_job">Update Job</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                    class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2" name="close_job">Close Job</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                    class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2" name="pause_job">Pause Job</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                    class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2" name="delete_job">Delete Job</button>
                            </div>
                            <div class="col-md-4">
                                <a href="/apps/work/ui/views/manage/manage_jobs.php" class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2"
                                >Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}else{
?>
<section class="py-60 postform">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <form method="POST" action="/api/jobsAPI.php" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
                        <div class="row gy-4">
                            <h5>Post a Job</h5>
                            <div class="col-12">
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Job Title
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="job_title" id="job_title"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Job Title"  value="<?php echo $job_title; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Company
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <input type="text" name="company" id="company"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"
                                            placeholder="Company" value="<?php echo $company; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mytext-black fs-14 text-uppercase">Contract Type
                                            <span class="fs-16 fw-900 text-danger">*</span></label>
                                        <select required name="contract_type"
                                            class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="<?php echo $contract_type; ?>"><?php echo $contract_type; ?></option>
                                            <hr>
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
                                            <input type="text" name="location" required value="<?php echo $location; ?>"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Salary:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="salary" required value="<?php echo $salary; ?>"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2 mb-4">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Job Description
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <textarea name="description" id="checkeyword" required cols="30" rows="7"
                                                maxlength="5000" oninput="return checksseyword()"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $job_description; ?></textarea>
                                            <span class="fs-12 text-end countype">0/5000</span>
                                        </div>
                                        <div class="d-block rel">
                                            <input type="file" name="file" placeholder=""
                                                class="position-absolute zi-3 attac-file" />
                                            <p class="mytext-black fs-14">
                                                Attached a file <i class="fal fa-paperclip"></i>
                                            </p>
                                        </div>
                                    </div>

                                
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Person Specifications:</label>
                                            <textarea name="person_specifications" id="person_specifications" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $job_description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Skill Requirements:</label>
                                            <textarea name="skill_requirements" id="skill_requirements" cols="30" rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $skill_requirements; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Qualifications Requirements:</label>
                                            <textarea name="qualifications_requirements" id="qualifications_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $qualifications_requirements; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="mytext-black fs-14 text-uppercase">Experience Requirements:</label>
                                            <textarea name="experience_requirements" id="experience_requirements" cols="30"
                                                rows="3"
                                                class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"><?php echo $experience_requirements; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <a href="/apps/work/ui/views/manage/manage_jobs.php" class="btn-primary btn-lg border-0 bg-lblue text-white fw-600 px-4 py-2"
                                >Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
<?php
include $path.'/apps/work/ui/layouts/footer.php';
?>


