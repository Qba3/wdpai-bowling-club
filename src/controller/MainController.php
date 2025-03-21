<?php

require_once 'Controller.php';

class MainController extends Controller
{
    public function main(): void
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->render('main');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }

    public function location(): void
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->render('location');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }

    public function admin(): void
    {
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $this->render('admin');
            return;
        }
        $this->render('login', ["message" => "You need to login as admin first"]);
    }

    public function gallery(): void
    {
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
            $this->render('gallery');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }

    public function bowling(): void
    {
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
            $this->render('bowling');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }

    public function contact(): void
    {
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
            $this->render('contact');
            return;
        }
        $this->render('login', ["message" => "You need to login first"]);
    }
}