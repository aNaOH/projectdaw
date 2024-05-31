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

    public function location(){
        require_once('./models/User.php');
        header('Content-Type: application/json');

        try {
            $userInfo = $_SESSION['user'][0];

            $user = new User($userInfo['name'], $userInfo['family_name'], $userInfo['email'], $userInfo['password'], $userInfo['profile_pic'], $userInfo['description'], $_POST['location']);
            $user->id = $userInfo['id'];

            $user->save();

            $_SESSION['user'][0]['location'] = $_POST['location'];
            echo json_encode(["done" => true]);

            header('HTTP/1.1 200 OK');
        } catch (\Throwable $th) {
            echo json_encode(["done" => false, "msg" => $th->getMessage()]);

            header('HTTP/1.1 500 Internal Server Error');
        }
        exit;
    }

    public function description(){
        require_once('./models/User.php');

        try {
            $userInfo = $_SESSION['user'][0];

            $user = new User($userInfo['name'], $userInfo['family_name'], $userInfo['email'], $userInfo['password'], $userInfo['profile_pic'], $_POST['description'], $userInfo['location']);
            $user->id = $userInfo['id'];

            $user->save();

            $_SESSION['user'][0]['description'] = $_POST['description'];
            header('Location: /profile');
        } catch (\Throwable $th) {
            header('Content-Type: application/json');

            echo json_encode(["done" => false, "msg" => $th->getMessage()]);

            header('HTTP/1.1 500 Internal Server Error');
        }
        exit;
    }
    
}