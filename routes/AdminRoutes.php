<?php

RouteController::get('/admin', 'HomeController', 'admin');

RouteController::get('/admin/abilities', 'AbilityController', 'get');