<?php

require_once 'di_config.php';
require 'src/Routing.php';

$di = DI::getInstance();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

if ($path === '') {
    $path = 'login';
}

Routing::get('main', $di->mainController);
Routing::get('admin', $di->mainController);
Routing::get('location', $di->mainController);
Routing::get('login', $di->securityController);
Routing::get('register', $di->securityController);
Routing::get('logout', $di->securityController);



Routing::run($path);