<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/JobController.php';

$job = new JobController();

$job->authCheck();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

if (isset($_POST['post_job'])) {
    $user_id = $_POST['user_id'];
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $subindustry = $_POST['subindustry'];
    $location = $_POST['location'];
    $contract_type = $_POST['contract_type'];
    $salary = $_POST['salary'];
    $person_specifications = $_POST['person_specifications'];
    $skill_requirements = $_POST['skill_requirements'];
    $qualifications_requirements = $_POST['qualifications_requirements'];
    $experience_requirements = $_POST['experience_requirements'];
    $job_description = $_POST['description'];
    $job_file = $_FILES["file"];
    $directory = '/storage/jobs_files/'; // Specify the directory where you want to store the files
    
    $destination = "";


        if ($job->store($user_id, $job_title, $company, $industry, $subindustry, $location, $contract_type, $salary, $person_specifications, $skill_requirements, $qualifications_requirements, $experience_requirements, $job_description, $job_file)) {
            $job->alert_redirect("Job posted successfully", "/work/ui/views/browse/browse_jobs.php");
        } else {
            
            $job->alert_redirect("Job post failed", "/work/ui/views/jobs/post_job.php");
        }

}

//Write a function to handle the job application form , use apply_job as REQUEST_METHOD variable and use job_apply() method from JobController.php to handle the form submission

if (isset($_POST['apply_job'])) {

    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];

    if($job->check_if_applied($job_id, $user_id)){
        $job->alert_redirect("You have already applied for this job", "/work/ui/views/browse/browse_jobs.php");
    }else{
        if ($job->apply_job()) {
            $job->alert_redirect("Job application submitted successfully", "/work/ui/views/browse/browse_jobs.php");
        } else {
            
            $job->alert_redirect("Job application failed", "/work/ui/views/jobs/apply_job.php");
        }
    }

}




if (isset($_POST['delete_job'])) {

    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];

    if ($job->delete_job($job_id)) {

        $job->alert_redirect("Job  deleted successfully", "/work/ui/views/manage/manage_jobs.php");

    } else {
        
        $job->alert_redirect("Job deletion failed", "/work/ui/views/manage/manage_jobs.php");

    }

}

//Write a function to update the job

if (isset($_POST['update_job'])) {

    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];

    if ($job->update_job()) {

        $job->alert_redirect("Job  Updated successfully", "/work/ui/views/manage/manage_jobs.php");

    } else {
        
        $job->alert_redirect("Failed to Update", "/work/ui/views/manage/manage_jobs.php");

    }

}

//write to update the job status as closed 

if (isset($_POST['close_job'])) {

    $job_id = $_POST['job_id'];
    $status = "closed";

    if ($job->job_status($job_id, $status)) {

        $job->alert_redirect("Job  Closed successfully", "/work/ui/views/manage/manage_jobs.php");

    } else {
        
        $job->alert_redirect("Failed to Close", "/work/ui/views/manage/manage_jobs.php");

    }

}

//write to update the job status as paused

if (isset($_POST['pause_job'])) {

    $job_id = $_POST['job_id'];
    $status = "paused";

    if ($job->job_status($job_id, $status)) {

        $job->alert_redirect("Job  Paused successfully", "/work/ui/views/manage/manage_jobs.php");

    } else {
        
        $job->alert_redirect("Failed to Paused", "/work/ui/views/manage/manage_jobs.php");

    }

}

//Write a function to save a job


if (isset($_GET['act'])&& ($_GET['act']=='save')) {

    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];
    $client_id = $_POST['client_id'];

    if ($job->save_jobs($job_id,$user_id,$client_id)) {

        $job->alert_redirect("Job  Saved successfully", "/work/ui/views/browse/browse_jobs.php");

    } else {
        
        $job->alert_redirect("Failed to Save", "/work/ui/views/browse/browse_jobs.php");

    }

}

//Write a test case for save_jobs() method in JobController.php


echo $job->saved_jobs(1);



?>
