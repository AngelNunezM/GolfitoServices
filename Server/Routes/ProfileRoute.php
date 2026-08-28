<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\ProfileController;

/** @var Router $router */

$router->get('/perfil', ProfileController::class, 'index');

