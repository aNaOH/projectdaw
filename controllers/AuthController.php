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
    
}