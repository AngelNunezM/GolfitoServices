<?php

namespace App\Models;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use App\Models\Role;

class User {
    public ?UuidInterface $id = null;
    public string $name = '';
    public string $username = '';
    public string $password = '';
    public string $phone = '';
    public bool $isActive = true;
    public ?UuidInterface $role_id = null;

    public ?Role $role = null;

    public function __construct(
        string $name = '',
        string $username = '',
        string $password = '',
        string $phone = '',
        bool $isActive = true,
        ?UuidInterface $id = null,
        ?UuidInterface $role_id = null,
        ?Role $role = null
    ) {
       $this->id = $id;
       $this->name = $name;
       $this->username = $username;
       $this->password = $password;
       $this->phone = $phone;
       $this->isActive = $isActive;
       $this->role_id = $role_id;
       $this->role = $role;
    }

    public static function create(string $name, string $username, string $password, string $phone, UuidInterface $role_id): User{
        return new User(
            id: Uuid::uuid4(),
            name: $name,
            username: $username,
            password: password_hash($password, PASSWORD_BCRYPT),
            phone: $phone,
            role_id: $role_id
        );
    }
}
