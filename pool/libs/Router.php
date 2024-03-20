<?php
class Router {
    private $routeMap;
    private $basePath;

    public function __construct($basePath = '') {
        $this->routeMap = array();
        $this->basePath = $basePath;
    }

    public function addRoute($route, $target) {
        $this->routeMap[$route] = $target;
    }

    public function routeRequest() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = str_replace($this->basePath, '', $requestUri);
        $requestUri = trim($requestUri, '/');

        foreach ($this->routeMap as $route => $target) {
            if ($route === $requestUri) {
                require $target;
                return;
            }
        }

        // If no route was found, you can choose to redirect to a 404 page
        header("HTTP/1.0 404 Not Found");
        echo "Page not found.";
    }
}