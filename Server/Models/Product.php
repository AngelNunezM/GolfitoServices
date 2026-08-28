<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class Product
{
    public ?string $id = null;
    public string $name = '';
    public string $description = '';
    public float $stock_min = 0;
    public bool $is_active = true;
    public ?string $unit_id = null;
    public ?string $area_id = null;

    public ?string $unit_name = null;
    public ?string $area_name = null;

    public function __construct(
        string $name = '',
        string $description = '',
        float $stock_min = 0,
        bool $is_active = true,
        ?string $unit_id = null,
        ?string $area_id = null,
        ?string $id = null,
        ?string $unit_name = null,
        ?string $area_name = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->stock_min = $stock_min;
        $this->is_active = $is_active;
        $this->unit_id = $unit_id;
        $this->area_id = $area_id;
        $this->unit_name = $unit_name;
        $this->area_name = $area_name;
    }

    public static function create(
        string $name,
        string $description,
        float $stock_min,
        ?string $unit_id,
        ?string $area_id,
        bool $is_active = true
    ): Product {
        return new Product(
            id: Uuid::uuid4()->toString(),
            name: trim($name),
            description: trim($description),
            stock_min: $stock_min,
            is_active: $is_active,
            unit_id: $unit_id,
            area_id: $area_id
        );
    }
}
