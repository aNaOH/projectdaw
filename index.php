<?php

require_once 'consts.php';

require_once 'models/conn.php';

require_once 'controllers/Controller.php';
require_once "controllers/RouteController.php";
require_once 'controllers/ViewController.php';

Consts::$db_conn = Connection::connectToDB('localhost', 'tradeskill', 'root', '');

if(!Consts::$db_conn){
    echo "<h1>Base de datos no conectada</h1>";
    exit;
}

//Check if script it's on subfolder
$currentScript = $_SERVER['PHP_SELF'];
$currentScript = explode('/', $currentScript);
if($currentScript[1] != 'index.php'){
    Consts::$app_base_uri = '/'.$currentScript[1];
}


//Routes
RouteController::get('/', 'HomeController');
RouteController::get('/login', 'AuthController', 'login');
RouteController::get('/register', 'AuthController', 'register');
RouteController::get('/profile', 'AuthController', 'profile');


$router = new RouteController;

$router->execute();