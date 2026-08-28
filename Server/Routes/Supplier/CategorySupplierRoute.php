<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\Supplier\CategorySupplierController;

/** @var Router $router */

$router->post('/category-suppliers', CategorySupplierController::class, 'store');