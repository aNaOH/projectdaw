<?php

class APIAuthController{

    public function login()
    {
        extract($_POST);

        $user = Connection::doSelect(Consts::$db_conn, 'users', [
            'email' => $email
        ]);

        if(count($user) == 1){
            if(password_verify($password, $user[0]['password'])){
                $_SESSION['user'] = $user;
                header('Content-Type: application/json');
                header('HTTP/1.1 200 OK');
                echo json_encode(["done" => true]);
            } else {
                header('Content-Type: application/json');
                header('HTTP/1.0 401 Unauthorized');
                echo json_encode(["done" => false, "field" => "password"]);
            }
            
        } else {
            header('Content-Type: application/json');
            header('HTTP/1.0 401 Unauthorized');
            echo json_encode(["done" => false, "field" => "email"]);
        }

        exit;
    }

    public function register()
    {
        extract($_POST);

        Connection::doInsert(Consts::$db_conn, 'users', [
            'email' => $email,
            'name' => $name,
            'family_name' => $familyName,
            'password' => crypt($password, Consts::$hashingSalt),
            'location' => $location
        ]);

        header('HTTP/1.1 200 OK');
        exit;
    }
    
}