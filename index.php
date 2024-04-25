<?php

require_once 'consts.php';

require_once 'controllers/Controller.php';
require_once "controllers/RouteController.php";
require_once 'controllers/ViewController.php';

//Check if script it's on subfolder
$currentScript = $_SERVER['PHP_SELF'];
$currentScript = explode('/', $currentScript);
if($currentScript[1] != 'index.php'){
    Consts::$app_base_uri = '/'.$currentScript[1];
}

RouteController::get('/', 'HomeController');

$router = new RouteController;

$router->execute();