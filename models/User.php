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
                'family_name' => $this->familyName,
                'email' => $this->email,
                'password' => $this->password,
                'profile_pic' => $this->profilePic,
                'description' => $this->description,
                'location' => $this->location
            ], ['id' => $this->id]);

        } else {
            Connection::doInsert(Consts::$db_conn, 'Users', [
                'name' => $this->name,
                'family_name' => $this->familyName,
                'email' => $this->email,
                'password' => $this->password,
                'profile_pic' => $this->profilePic,
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

    public function getWorks() {
        
        $stmt = Consts::$db_conn->prepare("SELECT * FROM works WHERE worker = :id");
        $stmt->execute(['id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWorkedForYou() {

        $stmt = Consts::$db_conn->prepare("SELECT * FROM works WHERE client = :id");
        $stmt->execute(['id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAbilities() {
        
        $stmt = Consts::$db_conn->prepare("SELECT * FROM has_ability WHERE user = :id");
        $stmt->execute(['id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasAbility($id) {
        
        $stmt = Consts::$db_conn->prepare("SELECT * FROM has_ability WHERE user = :id AND ability = :ability");
        $stmt->execute(['id' => $this->id, 'ability' => $id]);
        return isset($stmt->fetch(PDO::FETCH_ASSOC)['id']);
    }

    public function addAbility($id, $years = 0){
        if(!$this->hasAbility($id)){
            return (Connection::doInsert(Consts::$db_conn, 'has_ability', ['user' => $this->id, 'ability' => $id, 'years' => $years]) > 0);
        }
        else{
            return false;
        }
    }

    public function editAbility($id, $years){
        if($this->hasAbility($id)){
            return (Connection::doUpdate(Consts::$db_conn, 'has_ability', ['user' => $this->id, 'years' => $years], ['ability' => $id]) > 0);
        }
        else{
            return false;
        }
    }

    public function removeAbility($id){
        if(!$this->hasAbility($id)){
            return (Connection::doDelete(Consts::$db_conn, 'has_ability', ['user' => $this->id, 'ability' => $id]) > 0);
        }
        else{
            return false;
        }
    }
}

