<?php

namespace App\Controllers\Warehouse;

use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Models\Product;
use App\Services\Product\ProductService;
use Exception;

class WarehouseController
{
    private ProductService $warehouseService;

    public function __construct()
    {
        $this->warehouseService = new ProductService();
    }

    public function index()
    {
        Authentication::verify();

        try {
            $products = $this->warehouseService->getProducts();
            return View::render('administration/warehouse/Index', ['products' => $products]);
        } catch (Exception $e) {
            return View::render('administration/warehouse/Index', ['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        Authentication::verify();
        return View::render('administration/warehouse/Create');
    }

    public function store()
    {
        Authentication::verify();

        try {
            $request = $_POST;

            $product = Product::create(
                name: $request['name'] ?? '',
                description: $request['description'] ?? '',
                stock_min: (float) ($request['stock_min'] ?? 0),
                unit_id: $request['unit_id'] ?? null,
                area_id: $request['area_id'] ?? null,
                is_active: isset($request['is_active']) ? (bool) $request['is_active'] : true
            );

            if (empty($product->name)) {
                throw new Exception('El nombre del producto es obligatorio.', 422);
            }

            $this->warehouseService->createProduct($product);
            header('Location: /administracion/almacen');
            exit;
        } catch (Exception $e) {
            return View::render('administration/warehouse/Create', ['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        Authentication::verify();

        try {
            $product = $this->warehouseService->getProductById($id);
            return View::render('administration/warehouse/Edit', ['product' => $product]);
        } catch (Exception $e) {
            return View::render('administration/warehouse/Index', ['error' => $e->getMessage()]);
        }
    }

    public function update(string $id)
    {
        Authentication::verify();

        try {
            $request = $_POST;

            $product = new Product(
                id: $id,
                name: $request['name'] ?? '',
                description: $request['description'] ?? '',
                stock_min: (float) ($request['stock_min'] ?? 0),
                is_active: isset($request['is_active']) ? (bool) $request['is_active'] : true,
                unit_id: $request['unit_id'] ?? null,
                area_id: $request['area_id'] ?? null
            );

            $this->warehouseService->updateProduct($product);
            header('Location: /administracion/almacen');
            exit;
        } catch (Exception $e) {
            return View::render('administration/warehouse/Edit', ['error' => $e->getMessage(), 'product' => new Product()]);
        }
    }

    public function destroy(string $id)
    {
        Authentication::verify();

        try {
            $this->warehouseService->changeStatus($id);
            header('Location: /administracion/almacen');
            exit;
        } catch (Exception $e) {
            return View::render('administration/warehouse/Index', ['error' => $e->getMessage()]);
        }
    }
}