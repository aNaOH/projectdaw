<?php

class ViewController{

    public static function summon(string $name, $vars = [], $styles = [], $scripts = [])
    {
        if(count($vars) > 0){
            extract($vars);
        }
        require Consts::$app_root."\\views\\".$name.".php";
    }


}