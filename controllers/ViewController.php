<?php

class ViewController{

    public static function summon(string $name)
    {
        require Consts::$app_root."\\views\\".$name.".php";
    }


}