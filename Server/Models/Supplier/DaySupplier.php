<?php

namespace App\Models\Supplier;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Exception;

class DaySupplier
{
    public string $day = '';
    public ?string $typeDay = null;
    public UuidInterface $supplierId;


    public function __construct(
        string $day,
        UuidInterface $supplierId,
        ?string $typeDay = null
    ) {
        $this->day = $day;
        $this->supplierId = $supplierId;
        $this->typeDay = $typeDay;
    }

    public static function create(string $day, UuidInterface $supplierId, string $typeDay): DaySupplier
    {
        if (empty($day)) throw new Exception('El día del proveedor no puede estar vacío.');
        if (empty($supplierId)) throw new Exception('El ID del proveedor no puede estar vacío.');
        if (empty($typeDay)) throw new Exception('El tipo de día del proveedor no puede estar vacío.');

        return new DaySupplier(     
            day: $day,
            supplierId: $supplierId,
            typeDay: $typeDay
        );
    }
}