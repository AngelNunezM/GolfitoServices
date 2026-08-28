<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Middlewares\Authentication;

class HomeController
{

    public function index()
    {
        Authentication::verify();
        return View::render('Home');
    }
}