<?php

namespace App\Models;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

class Area
{
    public ?UuidInterface $id;
    public string $name;
    public bool $is_active;

    public function __construct(
        ?UuidInterface $id = null,
        string $name = '',
        bool $is_active = true
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->is_active = $is_active;
    }

    public static function create(string $name): Area
    {
        return new Area(
            id: Uuid::uuid4(),
            name: $name,
            is_active: true
        );
    }
}