<?php
require_once 'Router.php';

$router = new Router(); // Important: pass your base folder

// Define routes
$router->route('/', function() {
    include 'landing.php'; // Your home page
});

$router->route('/about', function() {
    echo "<h1>About Us</h1>";
});

// Handle incoming request
$router->handleRequest($_SERVER['REQUEST_URI']);
