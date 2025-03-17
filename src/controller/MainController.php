<?php

require_once 'Controller.php';

class MainController extends Controller
{

    public function main()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->render('main');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }
}