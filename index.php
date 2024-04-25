<?php

require_once 'consts.php';

require_once 'controllers/Controller.php';
require_once "controllers/RouteController.php";
require_once 'controllers/ViewController.php';

RouteController::get('/', 'HomeController');
RouteController::get('/dashboard', 'HomeController', 'dashboard');

$router = new RouteController;

$router->execute();