<?php

require_once "Controller.php";
require_once __DIR__ . '/../model/User.php';

class SecurityController extends Controller
{
    public function verify()
    {
        $user = new User("jbober@gmail.com", "admin", "Jakub", "Bober", "admin");
        $this->render('main');
    }

    public function login(string $message = null): void
    {
        $this->render('login', ["message" => $message]);
    }
}