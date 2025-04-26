<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/AffiliateController.php';
$affiliateController = new AffiliateController();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are present
    if (isset($_POST['link']) && isset($_POST['referrerId']) && isset($_POST['referringCode'])) {
        // Retrieve the form data
        $link = $_POST['link'];
        $referrerId = $_POST['referrerId'];
        $referringCode = $_POST['referringCode'];

        // Create the affiliate link and get the inserted ID
        $insertedId = $affiliateController->createAffiliateLink($link, $referrerId, $referringCode);

        if ($insertedId) {
            // Affiliate link created successfully
            $response = array(
                'status' => 'success',
                'message' => 'Affiliate link created successfully',
                'insertedId' => $insertedId
            );
        } else {
            // Failed to create the affiliate link
            $response = array(
                'status' => 'error',
                'message' => 'Failed to create affiliate link'
            );
        }
    } else {
        // Missing required parameters
        $response = array(
            'status' => 'error',
            'message' => 'Missing required parameters'
        );
    }
} else {
    // Invalid request method
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method'
    );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
