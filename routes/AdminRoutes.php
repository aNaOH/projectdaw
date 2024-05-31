<?php

RouteController::get('/admin', 'HomeController', 'admin');

RouteController::get('/admin/abilities', 'AbilityController', 'get');

RouteController::get('/admin/abilities/new', 'AbilityController', 'newForm');
RouteController::post('/admin/abilities/new', 'AbilityController', 'new');

RouteController::get('/admin/abilities/:id:', 'AbilityController', 'editForm');
RouteController::post('/admin/abilities/:id:', 'AbilityController', 'edit');

RouteController::post('/admin/abilities/delete/:id:', 'AbilityController', 'delete');
