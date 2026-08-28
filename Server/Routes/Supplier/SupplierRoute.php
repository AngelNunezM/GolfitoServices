<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\Supplier\SupplierController;

/** @var Router $router */

$router->post('/suppliers', SupplierController::class, 'store');