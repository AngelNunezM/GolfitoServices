<?php 

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Role {
    public ?UuidInterface $id = null;
    public string $name;
    public ?string $description = null;
    public ?string $created_at = null;

    public function __construct(
        string $name = '',
        ?string $description = null,
        ?UuidInterface $id = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    public static function create(string $name, ?string $description = null): Role {
        return new Role(
            id: Uuid::uuid4(),
            name: $name,
            description: $description
        );
    }
}