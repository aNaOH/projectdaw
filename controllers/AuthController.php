<?php

class AuthController{

    public function login()
    {
        ViewController::summon('auth/login', scripts: ['/assets/js/login.js']);
    }

    public function register()
    {
        ViewController::summon('auth/register');
    }
    
}