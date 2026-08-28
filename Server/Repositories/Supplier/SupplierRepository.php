<?php

namespace App\Repositories\Supplier;

use App\Config\ContextDB;
use App\Models\Supplier\Supplier;
use PDO;
use PDOException;

class SupplierRepository
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
                s.id,
                s.name,
                s.business_name,
                s.address,
                s.is_active,
                s.method_payment_id,
                s.category_supplier_id
            FROM suppliers s
            ORDER BY created_at DESC
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $row): Supplier {
            return new Supplier(
                id: $row['id'],
                name: $row['name'],
                business_name: $row['business_name'],
                address: $row['address'] ?? '',
                is_active: (bool) $row['is_active'],
                method_payment_id: $row['method_payment_id'],
                category_supplier_id: $row['category_supplier_id']
            );
        }, $rows);
    }

    public function findBy(string $columnName, mixed $value): ?Supplier
    {
        $allowedColumns = ['id', 'name', 'business_name'];
        if (!in_array($columnName, $allowedColumns, true)) {
            throw new PDOException('Columna no permitida para buscar proveedor.');
        }

        $stmt = $this->context->prepare("
            SELECT
                s.id,
                s.name,
                s.business_name,
                s.address,
                s.is_active,
                s.method_payment_id,
                s.category_supplier_id
            FROM suppliers 
            WHERE {$columnName} = :value LIMIT 1
        ");
        $stmt->execute(['value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Supplier(
            id: $row['id'],
            name: $row['name'],
            business_name: $row['business_name'],
            address: $row['address'] ?? '',
            is_active: (bool) $row['is_active'],
            method_payment_id: $row['method_payment_id'],
            category_supplier_id: $row['category_supplier_id']
        );
    }

    public function add(Supplier $supplier): string
    {
        $sql = "INSERT INTO suppliers(id, name, business_name, address, delivery_day, order_day, method_payment_id, category_supplier_id)
                VALUES(:id, :name, :business_name, :address, :delivery_day, :order_day, :method_payment_id, :category_supplier_id)";

        $stmt = $this->context->prepare($sql);
        $stmt->execute([
            'id' => $supplier->id,
            'name' => $supplier->name,
            'business_name' => $supplier->business_name,
            'address' => $supplier->address,
            'method_payment_id' => $supplier->method_payment_id,
            'category_supplier_id' => $supplier->category_supplier_id,
        ]);

        return $supplier->id;
    }

    public function update(Supplier $supplier): bool
    {
        $sql = "UPDATE suppliers SET
                    name = :name,
                    business_name = :business_name,
                    address = :address,
                    method_payment_id = :method_payment_id,
                    category_supplier_id = :category_supplier_id
                WHERE id = :id";

        $stmt = $this->context->prepare($sql);
        $stmt->execute([
            'id' => $supplier->id,
            'name' => $supplier->name,
            'business_name' => $supplier->business_name,
            'address' => $supplier->address,
            'method_payment_id' => $supplier->method_payment_id,
            'category_supplier_id' => $supplier->category_supplier_id,
        ]);

        return $stmt->rowCount() >= 0;
    }

    public function changeStatus(string $supplierId): bool
    {
        $stmt = $this->context->prepare("UPDATE suppliers SET is_active = NOT is_active WHERE id = :id");
        $stmt->execute(['id' => $supplierId]);

        return $stmt->rowCount() === 1;
    }
}
