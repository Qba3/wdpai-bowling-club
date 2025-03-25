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
Routing::get('userReservations', $di->mainController);
Routing::get('bowling', $di->mainController);
Routing::get('gallery', $di->mainController);
Routing::get('contact', $di->mainController);
Routing::get('location', $di->mainController);
Routing::get('login', $di->securityController);
Routing::get('register', $di->securityController);
Routing::get('logout', $di->securityController);
Routing::get('getSchedule', $di->reservationController);
Routing::get('reserveSlot', $di->reservationController);


Routing::run($path);