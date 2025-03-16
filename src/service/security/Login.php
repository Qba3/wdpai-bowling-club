<?php

require '../../controller/SecurityController.php';

$login = $_POST["login"] ?? null;
$password = $_POST["password"] ?? null;

$object = new SecurityController();

if ($login == null) {
    $object->login("Login must not be empty");
    return;
}

if ($password == null) {
    $object->login("Password must not be empty");
    return;
}

$object->verify();
