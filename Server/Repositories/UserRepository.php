<?php

namespace App\Repositories;

use App\Config\ContextDB;
use App\Models\User;
use App\Models\Role;
use Ramsey\Uuid\Uuid;
use PDO;

class UserRepository {
    
    private PDO $context;

    public function __construct() {
        $this->context = (new ContextDB())->conn;
    }

    public function getAll()
    {
        $consult = $this->context->prepare("
            SELECT u.id, u.name, u.username, u.phone_number, u.password, u.is_active, r.id as 'id_role', r.name as 'name_role'
            FROM users u
            INNER JOIN roles r
            ON r.id = u.role_id;
        ");

        $consult->execute();

        $responses = $consult->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(function($response) {
            return new User(
                id: Uuid::fromString($response['id']),
                name: $response['name'],
                username: $response['username'],
                phone: $response['phone_number'],
                password: $response['password'],
                isActive: $response['is_active'],
                role_id: $response['id_role'],
                role: new Role(
                    id: $response['id_role'],
                    name: $response['name_role']
                )
            );
        }, $responses);
    }

    public function findBy(string $columnName, $value) 
    {
        $consult = $this->context->prepare("
            SELECT u.id, u.name, u.username, u.phone_number, u.password_hash, u.is_active, r.id as 'id_role', r.name as 'name_role'
            FROM users u
            INNER JOIN roles r
            ON r.id = u.role_id
            WHERE u.$columnName = :value
            LIMIT 1;
        ");

        $consult->execute(['value' => $value]);

        $response = $consult->fetch(PDO::FETCH_ASSOC);
        
        if (!$response) {
            return null; // No se encontró
        }
        
        $user = new User(
            id: Uuid::fromString($response['id']),
            name: $response['name'],
            username: $response['username'],
            phone: $response['phone_number'],
            password: $response['password_hash'],
            isActive: $response['is_active'],
            role_id: Uuid::fromString($response['id_role']),
            role: new Role(
                id: Uuid::fromString($response['id_role']),
                name: $response['name_role']
            )
        );
        return $user;
    }

    public function add(User $user): string
    {
        $consult = $this->context->prepare("INSERT INTO users(id, name, username, phone_number, password_hash, role_id) VALUES(:id, :name, :username, :phone_number, :password, :role_id)");
        $consult->execute([
            "id" => $user->id,
            "name" => $user->name,
            "username" => $user->username,
            "phone_number" => $user->phone,
            "password" => $user->password,
            "role_id" => $user->role_id
        ]);

        return $this->context->lastInsertId();
    }

    public function update(User $user)
    {
        $consult = $this->context->prepare("
            UPDATE users 
            SET name = :name, 
                username = :username, 
                phone_number = :phone_number, " . 
                ($user->password ? "password = :password, " : "") . 
                "role_id = :role_id 
            WHERE id = :id"
        );
        
        $params = [
            "id"       => $user->id,
            "name"     => $user->name,
            "username" => $user->username,
            "phone_number" => $user->phone,
            "role_id"  => $user->role_id
        ];

        if ($user->password) {
            $params["password"] = $user->password;
        }

        $consult->execute($params);

        return $this->context->lastInsertId();
    }

    public function changeStatus(Uuid $userId): bool
    {
        $consult = $this->context->prepare("UPDATE users  SET is_active = NOT is_active  WHERE users.id = :UserId");
        $consult->execute([
            "UserId" => $userId
        ]);

        return $consult->rowCount() === 1;
    }
}