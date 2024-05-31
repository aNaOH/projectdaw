<?php

require('./models/User.php');

class SearchController extends Controller{

    public function execute()
    {
        $users = User::getAll();

        ViewController::summon('search', ["users" => $users]);
    }

    public function profile($id)
    {
        if($id == $_SESSION['user'][0]["id"]){
            header('Location: /profile');
        }

        require_once('./models/Ability.php');

        $user = User::getById($id);
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