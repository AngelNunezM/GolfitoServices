<?php

namespace App\Controllers\Supplier;

use App\Core\View;
use App\Core\Middlewares\Authentication;

class CategorySupplierController
{
    public function create()
    {
        Authentication::verify();
        return View::render('administration/supplier/businessline/Create');
    }

    public function store()
    {

    }
}