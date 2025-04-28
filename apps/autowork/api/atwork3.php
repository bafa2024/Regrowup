<?php

// Include necessary files for Autowork class
require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

// Instantiate the Autowork class
$autowork = new Autowork();

// Example cron job to fetch and store project data every 15 minutes
$apiUrl = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&limit=10"; // Example API URL
$success = $autowork->fetchAndStoreProjects($apiUrl);

// Log the result of the cron job
$logFile = '/path/to/cron_log.txt';  // Update with the actual log file path
$currentTime = date("Y-m-d H:i:s");
if ($success) {
    file_put_contents($logFile, "[$currentTime] Cron job completed successfully.\n", FILE_APPEND);
} else {
    file_put_contents($logFile, "[$currentTime] Cron job failed.\n", FILE_APPEND);
}

?>
