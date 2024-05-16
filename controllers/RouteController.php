<?php

class RouteController extends Controller {
    private static $getRoutes = [];
    private static $postRoutes = [];
    private static $deleteRoutes = [];

    public static function get(string $route, string $controller, string $function = "") {
        if ($function != "") {
            self::$getRoutes[$route] = [$controller, $function];
        } else {
            self::$getRoutes[$route] = $controller;
        }
    }

    public static function post(string $route, string $controller, string $function = "") {
        if ($function != "") {
            self::$postRoutes[$route] = [$controller, $function];
        } else {
            self::$postRoutes[$route] = $controller;
        }
    }

    public function execute() {
        $uri = Consts::$app_base_uri !== null ? str_replace(Consts::$app_base_uri, '', $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'];
        $found = false;

        $routes = ($_SERVER['REQUEST_METHOD'] === "POST") ? self::$postRoutes : self::$getRoutes;

        foreach ($routes as $route => $controller) {
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

            $path = "\\views\\errors\\404.php";
            $summon = "errors\\404";
            
            if(explode('/',$uri)[1] == "admin"){
                $path = "\\views\\admin\\errors\\404.php";
                $summon = "admin\\errors\\404";
            }

            if(!file_exists(Consts::$app_root.$path))
            {
                echo "<h1>Error 404</h1><h4>NOT FOUND</h4>";
            }
            else{
                ViewController::summon($summon);
            }
        }
    }
}
