<?php

require 'src/Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', 'MainController');
Routing::get('login', 'MainController');
Routing::run($path);