<?php

namespace Lib;

use App\Controllers\Controller;

class Route
{
    private static $routes =  [];

    static public function get($uri, $class)
    {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $class;
    }

    static public function post($uri, $class)
    {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $class;
    }

    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');         

        // si nos llega algo por ? lo borramos, lo podemos recuperar en $_GET en el modelo
        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        $method = $_SERVER['REQUEST_METHOD']; 

        foreach (self::$routes[$method] as $route => $class) {
            if (strpos($route, ':') != false) {
                $route = preg_replace('#:[a-zA-Z0-9]+#', '([a-zA-Z0-9]+)', $route);
            }

             if (preg_match("#^$route$#", $uri, $matches)) {         
                $params = array_slice($matches, 1);
                
                // Se instancia la clase y llamada al método definido en la ruta (HomeController.php e index() por ejemplo)
                $controller = new $class[0];
                $response = $controller->{$class[1]}(...$params);

                echo $response;
             
                return;
            }
        }
        session_start();
        $controller = new Controller();
        $response = $controller->view("noexiste");
        echo $response;
    }
}
