<?php

require_once 'di_config.php';
require 'src/Routing.php';

$di = DI::getInstance();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', $di->mainController);
Routing::post('login', $di->securityController);

print_r("Path:" . $path . "<br>");
Routing::run($path);