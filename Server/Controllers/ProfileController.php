<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Middlewares\Authentication;

class ProfileController
{

    public function index()
    {
        Authentication::verify();
        return View::render('Profile');
    }
}