<?php

namespace App\controller;

use Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $this->render('notFound');
    }
}