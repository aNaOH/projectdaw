<?php

class ViewController{

    public static function summon(string $name, $vars = [], $styles = [], $scripts = [])
    {
        require Consts::$app_root."\\views\\".$name.".php";
    }


}