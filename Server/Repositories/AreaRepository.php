<?php

namespace App\Repositories;

use PDO;
use App\Config\ContextDB;
use App\Models\Area;
use Ramsey\Uuid\Uuid;

class AreaRepository
{
    private PDO $context;

    public function __construct() {
        $this->context = (new ContextDB())->conn;
    }

    public function getAll() : array
    {
        $consult = $this->context->prepare("
            SELECT id, name, is_active
            FROM areas;
        ");

        $consult->execute();

        $response =  $consult->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function($response) {
            return new Area(
                id: Uuid::fromString($response['id']),
                name: $response['name'],
                is_active: $response['is_active']
            );
        }, $response);
    }

    public function findById(string $id): ?Area
    {
        $consult = $this->context->prepare("
            SELECT id, name, is_active
            FROM areas
            WHERE id = :id
            LIMIT 1;
        ");

        $consult->execute(['id' => $id]);

        $response =  $consult->fetch(PDO::FETCH_ASSOC);

        if (!$response) {
            return null;
        }

        return new Area(
            id: Uuid::fromString($response['id']),
            name: $response['name'],
            is_active: $response['is_active']
        );
    }

    public function create(Area $area): Area
    {
        $consult = $this->context->prepare("
            INSERT INTO areas (id, name, is_active)
            VALUES (:id, :name, :is_active);
        ");

        $consult->execute([
            'id' => $area->id->toString(),
            'name' => $area->name,
            'is_active' => $area->is_active
        ]);

        return $area;
    }
}