<?php

require_once './models/Ability.php';

class AbilityController{

    public static function get()
    {
        $abilities = Ability::getAll();

        ViewController::summon('tables/abilities', ["abilities" => $abilities]);
    }


}