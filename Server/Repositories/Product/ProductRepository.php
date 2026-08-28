<?php

namespace App\Repositories\Product;

use App\Config\ContextDB;
use App\Models\Product;

use PDO;
use PDOException;

class ProductRepository
{
    private PDO $context;

    public function __construct()
    {
        $this->context = (new ContextDB())->conn;
    }

    public function getAll(): array
    {
        $sql = "SELECT p.*, u.name AS unit_name, a.nombre AS area_name
                FROM products p
                INNER JOIN units u ON u.id = p.unit_id
                INNER JOIN areas a ON a.id = p.area_id
                ORDER BY p.created_at DESC";

        $stmt = $this->context->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $row): Product {
            return new Product(
                id: $row['id'],
                name: $row['name'],
                description: $row['description'] ?? '',
                stock_min: (float) ($row['stock_min'] ?? 0),
                is_active: (bool) $row['is_active'],
                unit_id: $row['unit_id'],
                area_id: $row['area_id'],
                unit_name: $row['unit_name'] ?? null,
                area_name: $row['area_name'] ?? null
            );
        }, $rows);
    }

    public function findBy(string $columnName, mixed $value): ?Product
    {
        $allowedColumns = ['id', 'name'];
        if (!in_array($columnName, $allowedColumns, true)) {
            throw new PDOException('Columna no permitida para buscar producto.');
        }

        $stmt = $this->context->prepare("SELECT p.*, u.name AS unit_name, a.nombre AS area_name
            FROM products p
            INNER JOIN units u ON u.id = p.unit_id
            INNER JOIN areas a ON a.id = p.area_id
            WHERE p.{$columnName} = :value LIMIT 1");
        $stmt->execute(['value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Product(
            id: $row['id'],
            name: $row['name'],
            description: $row['description'] ?? '',
            stock_min: (float) ($row['stock_min'] ?? 0),
            is_active: (bool) $row['is_active'],
            unit_id: $row['unit_id'],
            area_id: $row['area_id'],
            unit_name: $row['unit_name'] ?? null,
            area_name: $row['area_name'] ?? null
        );
    }

    public function add(Product $product): string
    {
        $sql = "INSERT INTO products(id, name, description, stock_min, is_active, unit_id, area_id)
                VALUES(:id, :name, :description, :stock_min, :is_active, :unit_id, :area_id)";

        $stmt = $this->context->prepare($sql);
        $stmt->execute([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'stock_min' => $product->stock_min,
            'is_active' => $product->is_active ? 1 : 0,
            'unit_id' => $product->unit_id,
            'area_id' => $product->area_id,
        ]);

        return $product->id;
    }

    public function update(Product $product): bool
    {
        $sql = "UPDATE products SET
                    name = :name,
                    description = :description,
                    stock_min = :stock_min,
                    is_active = :is_active,
                    unit_id = :unit_id,
                    area_id = :area_id,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";

        $stmt = $this->context->prepare($sql);
        $stmt->execute([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'stock_min' => $product->stock_min,
            'is_active' => $product->is_active ? 1 : 0,
            'unit_id' => $product->unit_id,
            'area_id' => $product->area_id,
        ]);

        return $stmt->rowCount() >= 0;
    }

    public function changeStatus(string $productId): bool
    {
        $stmt = $this->context->prepare("UPDATE products SET is_active = NOT is_active WHERE id = :id");
        $stmt->execute(['id' => $productId]);

        return $stmt->rowCount() === 1;
    }
}
