<?php

class RouteController extends Controller {
    private static $routes = [];

    public static function defineRoute(string $route, string $controller, string $function = "") {
        if ($function != "") {
            self::$routes[$route] = [$controller, $function];
        } else {
            self::$routes[$route] = $controller;
        }
    }

    public function execute() {
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;

        foreach (self::$routes as $route => $controller) {
            if ($uri === $route) {
                if (is_array($controller)) {
                    require $controller[0] . ".php";
                    $ctrl = new $controller[0]();
                    call_user_func(array($ctrl, $controller[1]));

                }
                else{
                    require $controller . ".php";
                    $ctrl = new $controller();
                    call_user_func(array($ctrl, "execute"));

                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            // Si no se encuentra ninguna ruta, redirigir a la página de error 404
            header("HTTP/1.0 404 Not Found");
            if(!file_exists(Consts::$app_root."\\views\\errors\\404.php"))
            {
                echo "<h1>Error 404</h1><h4>NOT FOUND</h4>";
            }
            else{
                ViewController::summon("errors\\404");
            }
        }
    }
}
