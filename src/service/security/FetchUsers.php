<?php

require_once '../../../di_config.php';

$di = DI::getInstance();
header('Content-Type: application/json');
echo json_encode($di->userRepository->getAll());
