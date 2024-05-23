<?php

class AuthController{

    public function login()
    {
        ViewController::summon('auth/login', scripts: ['/assets/js/login.js']);
    }

    public function register()
    {
        ViewController::summon('auth/register', styles: ['/assets/css/locationInput.css'], scripts: ['/assets/js/components/LocationInput.js','/assets/js/register.js']);
    }
    
    public function profile(){

        require_once('./models/Ability.php');

        $user = !isset($vars['userId']) ? $_SESSION['user'][0] : null;
        $abilities = Ability::getUserAbilities($user['id']);

        ViewController::summon(
            'auth/profile',
            styles: ['/assets/css/locationInput.css'],
            scripts: ['/assets/js/components/LocationInput.js','/assets/js/profile.js'],
            vars: [
                "user" => $user,
                "abilities" => $abilities
            ]
        );
    }
}