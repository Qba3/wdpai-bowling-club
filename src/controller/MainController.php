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

    public function location()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->render('location');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }

    public function admin()
    {
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ) {
            $this->render('admin');
            return;
        }
        $this->render('login', ["message" => "You need to login as admin first"]);
    }
}