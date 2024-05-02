<?php

class AuthController{

    public function login()
    {
        ViewController::summon('auth/login');
    }

    public function register()
    {
        ViewController::summon('auth/register');
    }
    
}