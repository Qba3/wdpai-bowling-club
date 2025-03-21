<?php

namespace App\controller;

use Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        session_start();
        $this->render('notFound');
    }
}