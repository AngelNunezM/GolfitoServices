<?php

namespace App\Models;

class PaymentMethod
{
    public ?string $id;
    public string $name;

    public function __construct(
        ?string $id = null,
        string $name = ''
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}