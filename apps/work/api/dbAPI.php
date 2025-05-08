<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/DbController.php';

$db = new Db();

// Insert Note
if($_GET['key']=="createdb") {

    $db->createAffiliateLinksTable();
    $db->payment_methods();
    $db->membership_plans_table();
    $db->earnings_table();
    $db->user_subscriptions_table();
    $db->logs_table();
    $db->chat_table();
    $db->storage_table();
    $db->jobs_table();
    $db->gigs_table();
    $db->contract_table();
    $db->local_service_table();
    $db->resumes_table();
    $db->courses_table();
    $db->manage_jobs_table();
    $db->notification_table();
    $db->financial_profile();
    $db->contracts_application_table();
    $db->chatroom_table();
    $db->chat_table();
    $db->reviews_table();
    $db->project_milestones_table();
    $db->deposit_table();
    $db->balance_table();
    $db->charges_table();
    //  $db->createWorkTrackerTable();
    $db->createDisputesTable();
    $db->createFilesTable();
    $db->job_applications_table();
    $db->saved_jobs_table();
    $db->createGigPurchaseTable();
    $db->external_projects();
    $db->external_projects_bidden();
    $db->auto_bid();
    $db->createFinancialDataTable();
    $db->create_cities_table();
    $db->external_elite_projects();
    
    $db->website_traffic($table = "website_traffic");

}



?>
