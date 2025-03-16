<?php

require_once 'Controller.php';

class MainController extends Controller
{

    public function main()
    {
        $this->render('main');
    }
}