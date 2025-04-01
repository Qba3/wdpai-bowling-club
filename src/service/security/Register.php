<?php
require '../../controller/SecurityController.php';
require '../../../di_config.php';

$firstname = $_POST["firstname"] ?? null;
$lastname = $_POST["lastname"] ?? null;
$login = $_POST["login"] ?? null;
$email = $_POST["email"] ?? null;
$password = $_POST["password"] ?? null;
$passwordConfirm = $_POST["passwordConfirm"] ?? null;
$role = $_POST["role"] ?? null;


$di = DI::getInstance();

if ($firstname == null) {
    $di->securityController->register("Firstname must not be empty");
    return;
}

if ($lastname == null) {
    $di->securityController->register("Lastname must not be empty");
    return;
}

if ($login == null) {
    $di->securityController->register("Login must not be empty");
    return;
}

if ($email == null) {
    $di->securityController->register("Email must not be empty");
    return;
}

if ($password == null) {
    $di->securityController->register("Password must not be empty");
    return;
}

if ($passwordConfirm === $password) {
    $di->securityController->register("Password confirm is invalid");
    return;
}

$di->securityController->addUser(
    $firstname,
    $lastname,
    $login,
    $email,
    password_hash($password, PASSWORD_DEFAULT),
    $role,
);
