<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/JobController.php';
include $path.'/apps/work/ui/layouts/nav.php';
$job = new JobController();

$job->authCheck();

$job_id = $job->url_var('jo');
$client_id = $job->url_var('cl');
$user_id = $_SESSION['user_id'];
if($job->check_if_applied($job_id, $user_id)){
    $job->alert_redirect("You have already applied for this job", "/apps/work/ui/views/browse/browse_jobs.php");
}

$act= $job->url_var('act');
if($act == 'save'){

    //check if job is already saved

    if($job->check_if_saved($job_id,$user_id,$client_id)){

        $job->alert_redirect("You have already saved this job", "/apps/work/ui/views/browse/browse_jobs.php");

    }else{

        if ($job->save_jobs($job_id,$user_id,$client_id)) {

            $job->alert_redirect("Job  Saved successfully", "/apps/work/ui/views/browse/browse_jobs.php");
    
        } else {
            
            $job->alert_redirect("Failed to Save", "/apps/work/ui/views/browse/browse_jobs.php");
    
        }


    }


    
}else{
?>
<section class="py-60 postform">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <form method="POST" action="/api/jobsAPI.php" enctype="multipart/form-data">
                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <div class="row gy-4">
                            <h5>Job Application</h5>
                            <div class="col-12">
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="first_name" class="mytext-black fs-14 text-uppercase">First Name:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="first_name" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="last_name" class="mytext-black fs-14 text-uppercase">Last Name:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="text" name="last_name" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="contact_email" class="mytext-black fs-14 text-uppercase">Contact Email:
                                                <span class="fs-16 fw-900 text-danger">*</span></label>
                                            <input type="email" name="contact_email" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="contact_phone" class="mytext-black fs-14 text-uppercase">Contact Phone:</label>
                                            <input type="tel" name="contact_phone" class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-block rel">
                                            <input type="file" name="cv_resume" placeholder="" class="position-absolute zi-3 attac-file" />
                                            <p class="mytext-black fs-14">
                                                Attached CV/Resume <i class="fal fa-paperclip"></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="person_specifications" class="mytext-black fs-14 text-uppercase">Your Specifications:</label>
                                            <textarea name="person_specifications" id="person_specifications" cols="30" rows="3" class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="skill_requirements" class="mytext-black fs-14 text-uppercase">Your Skills:</label>
                                            <textarea name="skill_requirements" id="skill_requirements" cols="30" rows="3" class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="qualifications_requirements" class="mytext-black fs-14 text-uppercase">Your Qualifications:</label>
                                            <textarea name="qualifications_requirements" id="qualifications_requirements" cols="30" rows="3" class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="experience_requirements" class="mytext-black fs-14 text-uppercase">Your Experience:</label>
                                            <textarea name="experience_requirements" id="experience_requirements" cols="30" rows="3" class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary" name="apply_job">Submit</button>
                                    </div>
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
}
?>


<?php
include $path.'/apps/work/ui/layouts/footer.php';
?>
