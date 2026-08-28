<?php

namespace App\Services\Supplier;

use App\Models\Supplier\Supplier;
use App\Repositories\Supplier\SupplierRepository;
use Exception;

class SupplierService
{
    private SupplierRepository $supplierRepository;

    public function __construct()
    {
        $this->supplierRepository = new SupplierRepository();
    }

    public function getSuppliers(): array
    {
        return $this->supplierRepository->getAll();
    }

    public function getSupplierById(string $id): Supplier
    {
        $supplier = $this->supplierRepository->findBy('id', $id);

        if (!$supplier) {
            throw new Exception('Proveedor no encontrado.', 404);
        }

        return $supplier;
    }

    public function createSupplier(Supplier $supplier): Supplier
    {
        $exists = $this->supplierRepository->findBy('name', $supplier->name);

        if ($exists) {
            throw new Exception('Ya existe un proveedor con ese nombre.', 409);
        }

        $createdId = $this->supplierRepository->add($supplier);

        if (!$createdId) {
            throw new Exception('Hubo un error al guardar el proveedor.', 500);
        }

        return $this->getSupplierById($createdId);
    }

    public function updateSupplier(Supplier $supplier): Supplier
    {
        $updated = $this->supplierRepository->update($supplier);

        if (!$updated) {
            throw new Exception('Hubo un error al actualizar el proveedor.', 500);
        }

        return $this->getSupplierById($supplier->id);
    }

    public function changeStatus(string $supplierId): Supplier
    {
        $changed = $this->supplierRepository->changeStatus($supplierId);

        if (!$changed) {
            throw new Exception('No se pudo cambiar el estado del proveedor.', 500);
        }

        return $this->getSupplierById($supplierId);
    }
}
