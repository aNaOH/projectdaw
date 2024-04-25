<?php

require_once './models/User.php';

class UserController{

    public static function get()
    {
        $users = User::getAll();

        ViewController::summon('tables/users', ["users" => $users]);
    }


}