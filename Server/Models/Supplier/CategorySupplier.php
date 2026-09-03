<?php

namespace App\Models\Supplier;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Exception;

class CategorySupplier
{
    public ?UuidInterface $id = null;
    public string $name = '';

    public function __construct(
        ?UuidInterface $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(string $name)
    {
        if (empty($name)) throw new Exception('El nombre de la categoría de proveedor no puede estar vacío.');

        return new CategorySupplier(
            id: Uuid::uuid4(),
            name: $name
        );
    }
}