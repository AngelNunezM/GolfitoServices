<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\AdministrationController;
use App\Controllers\Supplier\SupplierController;
use App\Controllers\Warehouse\WarehouseController;
use App\Controllers\Supplier\CategorySupplierController;

/** @var Router $router */

//---------------------------------------------------------------------
// Rutas de administración (Modulos de administración del sistema)
//---------------------------------------------------------------------
$router->get('/administracion', AdministrationController::class, 'index');

// Proveedores
$router->get('/administracion/proveedores', SupplierController::class, 'index');
$router->get('/administracion/proveedores/crear', SupplierController::class, 'create');
$router->get('/administracion/proveedores/{id}/editar', SupplierController::class, 'edit');

// Categorias de proveedores
$router->get('/administracion/proveedores/categorias/crear', CategorySupplierController::class, 'create');

// Almacén
$router->get('/administracion/almacen', WarehouseController::class, 'index');
$router->get('/administracion/almacen/crear', WarehouseController::class, 'create');
$router->get('/administracion/almacen/{id}/editar', WarehouseController::class, 'edit');