<?php

namespace App\Repositories\Supplier;

use App\Config\ContextDB;
use App\Models\Supplier\CategorySupplier;
use PDO;

class CategorySupplierRepository
{
    private PDO $context;

    public function __construct()
    {
        $this->context = (new ContextDB())->conn;
    }

    public function getAll(): array
    {
        $stmt = $this->context->query("
            SELECT 
                id,
                name
            FROM categories_suppliers
            ORDER BY created_at DESC
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $row): CategorySupplier {
            return new CategorySupplier(
                id: $row['id'],
                name: $row['name']
            );
        }, $rows);
    }
}
