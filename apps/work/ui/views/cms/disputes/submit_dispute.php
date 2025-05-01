<?php
require_once 'Database.php';
require_once 'Dispute.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $contractId = $_POST['contract_id'];
    $clientID = $_POST['client_id'];
    $proID = $_POST['pro_id'];
    $ticketId = $_POST['ticket_id'];
    $description = $_POST['description'];

    // Create database connection
    $db = new Database();

    // Create dispute
    $dispute = new Dispute($db);
    $dispute->createDispute($contractId, $clientID, $proID, $ticketId, $description);

    // Redirect to index.php or display a success message
    header("Location: index.php");
    exit();
}
?>
