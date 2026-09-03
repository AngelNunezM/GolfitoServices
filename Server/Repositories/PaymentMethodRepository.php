<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Config\ContextDB;
use App\Models\PaymentMethod;
use PDO;

class PaymentMethodRepository
{
    private PDO $context;

    public function __construct()
    {
        $this->context = (new ContextDB())->conn;
    }

    public function getAll(): array
    {
        $consult = $this->context->prepare("
            SELECT 
                id, 
                name
            FROM pay_methods");
        $consult->execute();
        $result = $consult->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(function ($item) {
            return new PaymentMethod(
                id: Uuid::fromString($item['id']),
                name: $item['name']
            );
        }, $result);
    }
}