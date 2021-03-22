<?php

namespace BeeGame;

class Route
{
    public static $routes = [];

    public static function set($route, $class, $method)
    {
        self::$routes[] = $route;

        if ($_GET['url'] !== $route) return;
        
        $instance = new $class;
        $instance->$method();
    }
}
