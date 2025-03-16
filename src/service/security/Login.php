<?php


require '../../controller/SecurityController.php';
require '../../../di_config.php';

$login = $_POST["login"] ?? null;
$password = $_POST["password"] ?? null;

$di = DI::getInstance();

if ($login == null) {
    $di->securityController->login("Login must not be empty");
    return;
}

if ($password == null) {
    $di->securityController->login("Password must not be empty");
    return;
}

$di->securityController->verify($login, $password);
