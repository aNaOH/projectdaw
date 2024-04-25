<?php

class ViewController{

    public static function summon(string $name, $vars = [])
    {
        require Consts::$app_root."\\views\\".$name.".php";
    }


}