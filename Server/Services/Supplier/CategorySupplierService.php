<?php

namespace App\Services\Supplier;

use App\Repositories\Supplier\CategorySupplierRepository;
use App\Models\Supplier\CategorySupplier;
use Exception;

class CategorySupplierService
{
    private CategorySupplierRepository $categorySupplierRepository;

    public function __construct()
    {
        $this->categorySupplierRepository = new CategorySupplierRepository();
    }

    public function getCategories(): array
    {
        return $this->categorySupplierRepository->getAll();
    }

    public function createCategory(CategorySupplier $category): bool
    {
        $isCreated = $this->categorySupplierRepository->create($category);

        if(!$isCreated) {
            throw new Exception('Error al crear la categoría de proveedor.');
        }

        return $isCreated;
    }
}
