<?php

namespace App\Models\Supplier;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Exception;

class ContactSupplier {
    public ?UuidInterface $id = null;
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public ?bool $is_active = true;

    public function __construct(
        string $name,
        string $email,
        string $phone_number,
        ?bool $is_active = true,
        ?UuidInterface $id = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->is_active = $is_active;
        $this->id = $id;
    }

    public static function create(
        string $name,
        string $email,
        string $phone_number
    ){
        if(empty(trim($name))) throw new Exception('El nombre del contacto es necesario', 422);
        if(empty(trim($email))) throw new Exception('El email del contacto es necesario', 422);
        if(empty(trim($phone_number))) throw new Exception('El numero telefonico del contacto es necesario', 422);

        return new ContactSupplier(
            id: Uuid::uuid4(),
            name: $name,
            email: $email,
            phone_number: $phone_number
        );
    }
}