<?php
// public/index.php
declare(strict_types=1);

use Dotenv\Dotenv;
use Web250\Mvc\Router;
use Web250\Mvc\Controllers\HomeController;

// Show errors while we are learning (in production, turn this off)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// SalamanderController is NOT namespaced yet, so we still require it manually
require_once __DIR__ . '/../src/Controllers/SalamanderController.php';

// Composer autoload for Router, HomeController, etc.
require __DIR__ . '/../vendor/autoload.php';

// --- Load .env variables ---
$dotenv = Dotenv::createImmutable(dirname(__DIR__)); // project root
$dotenv->load();
// Now DB_HOST, DB_NAME, etc. are available in $_ENV / $_SERVER

// Create a Router instance
$router = new Router();

// ----------------------------
// ROUTES
// ----------------------------

// Home route ("/")
$router->get('/', function () {
    $controller = new HomeController();
    echo $controller->index();
});

// Salamanders list
$router->get('/salamanders', function () {
    $controller = new SalamanderController();
    $controller->index();
});

$router->get('/salamanders/show', function () {
    $controller = new SalamanderController();
    $controller->show();
});

// Extra HomeController routes
$router->get('/home', function () {
    $controller = new HomeController();
    echo $controller->index();
});

$router->get('/about', function () {
    $controller = new HomeController();
    echo $controller->about();
});

$router->get('/contact', function () {
    $controller = new HomeController();
    echo $controller->contact();
});

// (Add /contact route later if assignment wants it)

// ----------------------------
// REQUEST HANDLING
// ----------------------------

// Figure out which path the user requested (ignore query string)
// Example: "/web250-mvc/public/salamanders?page=2" -> "/web250-mvc/public/salamanders"
$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 🔹 YOUR base-path stripping so it works from /web250-mvc/public
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');  // e.g. "/web250-mvc/public"

if ($basePath !== '' && strpos($uriPath, $basePath) === 0) {
    $uriPath = substr($uriPath, strlen($basePath));
}

// Normalize empty path to "/"
if ($uriPath === '' || $uriPath === false) {
    $uriPath = '/';
}

// Ask the router to handle (dispatch) this request
$router->dispatch($uriPath, $_SERVER['REQUEST_METHOD']);