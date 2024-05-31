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

        $user = $_SESSION['user'][0];
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

    public function works(){
        require_once('./models/User.php');

        $userInfo = $_SESSION['user'][0];

        $user = new User(
            $userInfo['name'],
            $userInfo['family_name'],
            $userInfo['email'],
            $userInfo['password'],
            $userInfo['profile_pic'],
            $userInfo['description'],
            $userInfo['location']
        );

        $works = $user->getWorks();
        $worksForYou = $user->getWorkedForYou();


        ViewController::summon(
            'auth/works',
            vars: [
                "works" => $works,
                "worksForYou" => $worksForYou
            ]
        );
    }

    public function logout(){
        session_destroy();
        header('Location: /');
    }
}