<?php

require_once '../../../di_config.php';

$di = DI::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['login'])) {
        $login = $data['login'];
    }

    $di->userRepository->deleteUserByLogin($login);
}
