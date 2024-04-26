<?php

class User
{
    public $id;
    public $name;
    public $familyName;
    public $email;
    public $password;
    public $profilePic;
    public $description;
    public $location;

    public function __construct($name, $familyName, $email, $password, $profilePic = null, $description = null, $location = null)
    {
        $this->name = $name;
        $this->familyName = $familyName;
        $this->email = $email;
        $this->password = $password;
        $this->profilePic = $profilePic;
        $this->description = $description;
        $this->location = $location;
    }

    public static function getAll()
    {
        $stmt = Consts::$db_conn->query("SELECT * FROM Users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $stmt = Consts::$db_conn->prepare("SELECT * FROM Users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEmail($email)
    {
        $stmt = Consts::$db_conn->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->id) {

            Connection::doUpdate(Consts::$db_conn, 'Users', [
                'name' => $this->name,
                'familyName' => $this->familyName,
                'email' => $this->email,
                'password' => $this->password,
                'profilePic' => $this->profilePic,
                'description' => $this->description,
                'location' => $this->location
            ], ['id', $this->id]);

        } else {
            Connection::doInsert(Consts::$db_conn, 'Users', [
                'name' => $this->name,
                'familyName' => $this->familyName,
                'email' => $this->email,
                'password' => $this->password,
                'profilePic' => $this->profilePic,
                'description' => $this->description,
                'location' => $this->location
            ]);
            // Actualizamos el ID del usuario con el último ID insertado
            $this->id = Consts::$db_conn->lastInsertId();
        }
    }

    public function delete()
    {
        if ($this->id) {

            Connection::doDelete(Consts::$db_conn, 'Users', ['id' => $this->id]);

        }
    }
}

