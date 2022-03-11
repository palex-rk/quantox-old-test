<?php

namespace Src;

class Router 
{
    public function __construct()
    {
        $controller = !empty($_GET['c']) ? 'App\Controller\\' . $_GET['c'] : 'App\Controller\\UsersController';
        $method = !empty($_GET['m']) ? $_GET['m'] : 'index';
        $arg1 = isset($_GET['arg1']) ? $_GET['arg1'] : null;
        $arg2 = isset($_GET['arg2']) ? $_GET['arg2'] : null;
        $arg3 = isset($_GET['arg3']) ? $_GET['arg3'] : null;
        
        // var_dump($controller, $method, class_exists($controller), is_callable([$controller, $method]));die('here');
        if (class_exists($controller) && is_callable([$controller, $method])) {
            // die('is callable');
            call_user_func_array([$controller, $method], compact('arg1', 'arg2', 'arg3'));
        } else {
            // die('default');
            header('Location: /index.php?c=UsersController&m=index');
        }
    }
}