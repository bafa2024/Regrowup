<?php
// Start the session at the very top of your script
session_start();

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    // Redirect to the homepage of the default app if session is valid
    header('Location: /'); // Replace '/' with the path to your default app home if different
    exit();
} else {
    // If the user is not logged in, save the current URL they are trying to access
    $_SESSION['requested_url'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

$dApp = isset($_SESSION['default_app']) ? $_SESSION['default_app'] : null;

// Your existing routing code
$router->route('/', function() use ($dApp) {
    if ($dApp) {
        header("Location: /$dApp");
        exit();
    } else {
        require 'default.php';
    }
});
