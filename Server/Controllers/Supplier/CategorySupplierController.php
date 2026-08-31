<?php

namespace App\Controllers\Supplier;

use App\Core\View;
use App\Core\Middlewares\Authentication;
use App\Core\Helpers\HTTP;
use App\Models\Supplier\CategorySupplier;
use App\Services\Supplier\CategorySupplierService;
use Exception;

class CategorySupplierController
{
    use HTTP;

    private CategorySupplierService $categorySupplierService;

    public function __construct()
    {
        $this->categorySupplierService = new CategorySupplierService();
    }

    public function create()
    {
        Authentication::verify();
        return View::render('administration/supplier/businessline/Create');
    }

    public function store()
    {
        Authentication::verify();
        $request = $this->request();

        try {
            $category = CategorySupplier::create(
                name: $request['name']
            );

            $this->categorySupplierService->createCategory($category);

            $this->redirect('/administracion/proveedores/crear');

        } catch (Exception $e) {
            return View::render('administration/supplier/businessline/Create', [
                'error' => $e->getMessage()
            ]);
        }
    }
}