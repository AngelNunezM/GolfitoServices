<?php

namespace App\Services\Supplier;

use App\Repositories\Supplier\CategorySupplierRepository;

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
}
