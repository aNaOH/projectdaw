<?php

class APIAuthController{

    public function login()
    {
        extract($_POST);

        $_SESSION['user'] = 0;

        header('Location: /');

    }

    public function register()
    {
        extract($_POST);

        header('Location: /login');
    }
    
}