<?php

use App\controller\NotFoundController;

require_once 'src/controller/MainController.php';
require_once 'src/controller/SecurityController.php';
require_once 'src/controller/NotFoundController.php';

class Routing
{
    public static $routes;

    public static function get($url, $controller): void
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller): void
    {
        self::$routes[$url] = $controller;
    }


    public static function run($url): void
    {
        $action = explode("/", $url)[0];

        if (!array_key_exists($action, self::$routes)) {
            (new NotFoundController)->index();
            return;
        }

        $controller = self::$routes[$action];
        $controller->$action();
    }

}