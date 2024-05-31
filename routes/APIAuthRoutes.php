<?php

RouteController::post('/api/auth/login', 'APIAuthController', 'login');
RouteController::post('/api/auth/register', 'APIAuthController', 'register');
RouteController::post('/api/auth/edit', 'APIAuthController', 'edit');