<?php

RouteController::get('/login', 'AuthController', 'login');
RouteController::get('/register', 'AuthController', 'register');
RouteController::get('/profile', 'AuthController', 'profile');
RouteController::get('/logout', 'AuthController', 'logout');
RouteController::get('/works', 'AuthController', 'works');