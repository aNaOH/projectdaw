<?php

RouteController::get('/login', 'AuthController', 'login');
RouteController::get('/register', 'AuthController', 'register');
RouteController::get('/profile', 'AuthController', 'profile');