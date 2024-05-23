<?php

RouteController::get('/admin', 'HomeController', 'admin');

RouteController::get('/admin/abilities', 'AbilityController', 'get');
RouteController::get('/admin/abilities/new', 'AbilityController', 'newForm');

RouteController::post('/admin/abilities/new', 'AbilityController', 'new');
