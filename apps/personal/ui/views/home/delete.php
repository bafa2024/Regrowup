<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/edu/controllers/NoteController.php';
$noteController = new NoteController();
$noteController->checkSessionAndRedirect();
// Initialize NoteController


// Get the ID from the URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the ID is valid
if ($id !== null && is_numeric($id)) {
    // Perform the delete operation
    $result = $noteController->delete($id);
    
    if ($result) {
        echo "Note successfully deleted.";
    } else {
        echo "Failed to delete note.";
    }
} else {
    echo "Invalid ID.";
}

// Redirect or show a message here...
?>
