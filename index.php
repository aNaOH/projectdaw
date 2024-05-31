<?php

require_once 'consts.php';

require_once 'models/conn.php';

require_once 'controllers/Controller.php';
require_once "controllers/RouteController.php";
require_once 'controllers/ViewController.php';

Consts::$db_conn = Connection::connectToDB('localhost', 'tradeskill', 'root', '');

if (!Consts::$db_conn) {
    echo "<h1>Base de datos no conectada</h1>";
    exit;
}

session_start();

//Check if script it's on subfolder
$currentScript = $_SERVER['PHP_SELF'];
$currentScript = explode('/', $currentScript);
if ($currentScript[1] != 'index.php') {
    Consts::$app_base_uri = '/' . $currentScript[1];
}


//Routes
RouteController::get('/', 'HomeController');
RouteController::get('/search', 'SearchController');
RouteController::get('/profile/:id:', 'SearchController', 'profile');

include('./routes/AuthRoutes.php');
include('./routes/APIAuthRoutes.php');
include('./routes/AdminRoutes.php');


$router = new RouteController;

$router->execute();