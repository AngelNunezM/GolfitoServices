<?php

namespace App\Services;

use App\Repositories\PaymentMethodRepository;

class PaymentMethodService
{
    private PaymentMethodRepository $paymentMethodRepository;

    public function __construct()
    {
        $this->paymentMethodRepository = new PaymentMethodRepository();
    }

    public function getPaymentMethods(): array
    {
        return $this->paymentMethodRepository->getAll();
    }
}