<?php

namespace App\Controllers\Supplier;

use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Models\Supplier\Supplier;
use App\Services\Supplier\SupplierService;
use App\Services\Supplier\CategorySupplierService;
use App\Services\PaymentMethodService;
use App\Core\Helpers\HTTP;
use Exception;
use Ramsey\Uuid\Uuid;

class SupplierController
{
    use HTTP;

    private SupplierService $supplierService;

    public function __construct()
    {
        $this->supplierService = new SupplierService();
    }

    public function index()
    {
        Authentication::verify();

        try {
            $suppliers = $this->supplierService->getSuppliers();
            return View::render('administration/supplier/Index', ['suppliers' => $suppliers]);
            
        } catch (Exception $e) {
            return View::render('administration/supplier/Index', ['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        Authentication::verify();

        $params = [
            'categories' => (new CategorySupplierService())->getCategories(),
            'payment_methods' => (new PaymentMethodService())->getPaymentMethods()
        ];

        return View::render('administration/supplier/Create', $params);
    }

    public function store()
    {
        Authentication::verify();
        $request = $this->request();

        try {

            $supplier = Supplier::create(
                name: $request['name'] ?? '',
                business_name: $request['business_name'] ?? '',
                address: $request['address'] ?? '',
                method_payment_id: $request['method_payment_id'] ?? null,
                category_supplier_id: $request['category_supplier_id'] ?? null,
            );

            $this->supplierService->createSupplier($supplier);
            $this->redirect('/administracion/proveedores');

        } catch (Exception $e) {
            return View::render('administration/supplier/Create', ['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        Authentication::verify();

        try {
            $supplier = $this->supplierService->getSupplierById($id);
            return View::render('administration/supplier/Edit', ['supplier' => $supplier]);

        } catch (Exception $e) {
            return View::render('administration/supplier/Index', ['error' => $e->getMessage()]);
        }
    }

    public function update(string $id)
    {
        Authentication::verify();
        $request = $this->request();

        try {

            $supplier = new Supplier(
                id: Uuid::fromString($id),
                name: $request['name'] ?? '',
                business_name: $request['business_name'] ?? '',
                address: $request['address'] ?? '',
                is_active: true,
                method_payment_id: $request['method_payment_id'] ?? null,
                category_supplier_id: $request['category_supplier_id'] ?? null
            );

            $this->supplierService->updateSupplier($supplier);
            $this->redirect('/administracion/proveedores');

        } catch (Exception $e) {
            return View::render('administration/supplier/Edit', ['error' => $e->getMessage(), 'supplier' => new Supplier()]);
        }
    }

    public function destroy(string $id)
    {
        Authentication::verify();

        try {
            $this->supplierService->changeStatus($id);
            $this->redirect('/administracion/proveedores');

        } catch (Exception $e) {
            return View::render('administration/supplier/Index', ['error' => $e->getMessage()]);
        }
    }
}