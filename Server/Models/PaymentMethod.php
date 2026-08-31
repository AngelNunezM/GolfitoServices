<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class PaymentMethod
{
    public ?UuidInterface $id;
    public string $name;

    public function __construct(
        ?UuidInterface $id = null,
        string $name = ''
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}