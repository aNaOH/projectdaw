<?php

RouteController::post('/api/auth/login', 'APIAuthController', 'login');
RouteController::post('/api/auth/register', 'APIAuthController', 'register');

RouteController::post('/api/auth/location', 'APIAuthController', 'location');
RouteController::post('/api/auth/description', 'APIAuthController', 'description');

RouteController::get('/api/auth/abilities', 'APIAuthController', 'abilities');
RouteController::post('/api/auth/abilities', 'APIAuthController', 'addAbilities');