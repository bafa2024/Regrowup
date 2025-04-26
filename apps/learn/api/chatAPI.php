<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/ChatController.php';

// Instantiate the ChatController
$chatController = new ChatController();

// Check the action parameter and perform the corresponding action
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'fetchMessages':
            // Fetch chat messages
            $chatMessages = $chatController->fetchChatMessages();
            echo json_encode($chatMessages);
            break;

        case 'sendMessage':
            // Check if required parameters are provided
            if (isset($_POST['sender']) && isset($_POST['destination']) && isset($_POST['message'])) {
                $sender = $_POST['sender'];
                $destination = $_POST['destination'];
                $message = $_POST['message'];

                // Send chat message
                $result = $chatController->saveChatMessage($sender, $destination, $message);

                // Return the result as JSON
                echo json_encode(['success' => $result]);
            }
            break;
    }
}
?>
