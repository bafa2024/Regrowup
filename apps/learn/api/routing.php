<?php

require_once 'Router.php';

$router = new Router();

// Define routes
$router->addRoute('/', function() {
    echo "Welcome to the homepage!";
});

$router->addRoute('/about', function() {
    echo "This is the about page.";
});

$router->addRoute('/contact', function() {
    echo "Contact us at example@example.com";
});

// Test cases
