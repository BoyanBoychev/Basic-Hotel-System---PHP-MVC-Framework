<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//echo "Starting application...<br>";  // Debug output

// Start the session
session_start();

// Include essential files
//echo "Loading init.php...<br>";  // Debug output
require_once '../app/init.php';
require_once '../app/libraries/Router.php';

//echo "Initializing Router...<br>";  // Debug output
// Instantiate the Router
$router = new Router();

// Define routes
$router->add('/', [LoginController::class, 'index']);
$router->add('/login', [LoginController::class, 'login']);
$router->add('/register', [LoginController::class, 'register']);
$router->add('/register/store', [LoginController::class, 'store']);
$router->add('/dashboard1', [RoomController::class, 'dashboard1']);
$router->add('/reserve', [RoomController::class, 'reserve']);
$router->add('/logout', [LoginController::class, 'logout']);
$router->add('/room/{id}', [RoomController::class, 'details']);
$router->add('/deleteReservation', [RoomController::class, 'deleteReservation']);

$router->add('/admin', ['AdminController', 'index']);
$router->add('/admin/createRoom', ['AdminController', 'createRoom']);
$router->add('/admin/editRoom', ['AdminController', 'editRoom']);
$router->add('/admin/viewReservations', ['AdminController', 'viewReservations']);




// Get the URL from REQUEST_URI and clean it
$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

$basePath = '/hotel-reservation/public';
$url = str_replace([$basePath, 'index.php'], '', $url);

// Remove any leading or trailing slashes
$url = trim($url, '/');

// Ensure the URL starts with a leading slash
$url = '/' . $url;

// If the URL is empty after cleaning, set it to the root ("/")
if ($url === '/') {
    $url = '/';
}

// Dispatch the cleaned URL
//echo "Dispatching the URL: $url<br>";  // Debugging message
$router->dispatch($url);

// End of script
//echo "End of index.php<br>"; //Debugging message
