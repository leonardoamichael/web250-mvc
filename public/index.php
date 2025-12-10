<?php
// public/index.php
//
// This is the FRONT CONTROLLER.
// Every request from the browser comes to this file first.
// It will:
// 1. Turn on error reporting (for development).
// 2. Load the Router and the Controller class.
// 3. Register routes (which URL -> which action).
// 4. Ask the router to dispatch the current request.

declare(strict_types=1);

// Show errors while we are learning (in production, this should be turned off)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Load the Router and the SalamanderController class
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/SalamanderController.php';
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;
use Web250\Mvc\Router;

// Load the Router and the SalamanderController class
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/SalamanderController.php';

// Create a Router instance
$router = new Router();

// Home route – when user visits /web250-mvc/public/
$router->get('/', function () {
    $controller = new SalamanderController();
    $controller->index();
});

// Salamanders list – /web250-mvc/public/salamanders
$router->get('/salamanders', function () {
    $controller = new SalamanderController();
    $controller->index();
});

// Figure out the path the user requested (ignore query string)
$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Detect the base path from where index.php actually lives.
// e.g. /web250-mvc/public/index.php -> /web250-mvc/public
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

// Strip the base path off the front of the URI if it's there
if ($basePath !== '' && strpos($uriPath, $basePath) === 0) {
    $uriPath = substr($uriPath, strlen($basePath));
}

// Normalize empty path to '/'
if ($uriPath === '' || $uriPath === false) {
    $uriPath = '/';
}

// Optional: debugging
// echo 'Requested Path: ' . $uriPath;

// Dispatch to the router
$router->dispatch($uriPath, $_SERVER['REQUEST_METHOD']);