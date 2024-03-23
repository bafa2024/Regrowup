<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/pool/libs/Router.php';

$router = new Router($basePath);
// Instantiate the router with a base path if needed
$router = new Router();

// Example routes
$router->route('/about', function() {
    echo "This is the about page";
});

$router->route('/contact', function() {
    echo "This is the contact page";
});

// Handle the request
$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
$router->handleRequest($requestUrl);
