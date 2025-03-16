<?php

require_once "Controller.php";
require_once __DIR__ . '/../model/User.php';

class SecurityController extends Controller
{
    public function login()
    {
        $user = new User("jbober@gmail.com", "admin", "Jakub", "Bober", "admin");
        var_dump($_POST);
        die();
    }
}