<?php

namespace App\Models\Supplier;

use Ramsey\Uuid\Uuid;

class Supplier
{
    public ?string $id = null;
    public string $name = '';
    public string $business_name = '';
    public string $address = '';
    public bool $is_active = true;
    public ?string $method_payment_id = null;
    public ?string $category_supplier_id = null;

    public function __construct(
        string $name = '',
        string $business_name = '',
        string $address = '',
        bool $is_active = true,
        ?string $method_payment_id = null,
        ?string $category_supplier_id = null,
        ?string $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->business_name = $business_name;
        $this->address = $address;
        $this->is_active = $is_active;
        $this->method_payment_id = $method_payment_id;
        $this->category_supplier_id = $category_supplier_id;
    }

    public static function create(
        string $name,
        string $business_name,
        string $address,
        ?string $method_payment_id,
        ?string $category_supplier_id
    ): Supplier {
        return new Supplier(
            id: Uuid::uuid4()->toString(),
            name: trim($name),
            business_name: trim($business_name),
            address: trim($address),
            method_payment_id: $method_payment_id,
            category_supplier_id: $category_supplier_id
        );
    }
}
