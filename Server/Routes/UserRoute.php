<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\UserController;

/** @var Router $router */

$router->post('/usuarios', UserController::class, 'create');
