<?php

namespace BeeGame\Controllers;

class Controller
{
    protected function redirect($redirectTo)
    {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header('Location: http://' . $host . $uri . '/' . $redirectTo);
        exit;
    }

    protected function createView($template, $params = array())
    {
        extract($params);
        require_once(__DIR__ . '/../views/' . $template . '.php');
    }
}
