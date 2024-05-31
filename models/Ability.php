<?php

class Ability
{
    public $id = null;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function getAll()
    {
        $stmt = Consts::$db_conn->query("SELECT * FROM ability");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $stmt = Consts::$db_conn->prepare("SELECT * FROM ability WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserAbilities($userId){
        $stmt = Consts::$db_conn->prepare("SELECT * FROM ability INNER JOIN has_ability ON ability.id = has_ability.ability WHERE has_ability.user = :user");
        $stmt->execute(['user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if (isset($this->id)) {

            Connection::doUpdate(Consts::$db_conn, 'ability', [
                'name' => $this->name,
            ], ['id' => $this->id]);

        } else {
            Connection::doInsert(Consts::$db_conn, 'ability', [
                'name' => $this->name,
            ]);
            // Actualizamos el ID del usuario con el último ID insertado
            $this->id = Consts::$db_conn->lastInsertId();
        }
    }

    public function delete()
    {
        if ($this->id) {

            Connection::doDelete(Consts::$db_conn, 'Ability', ['id' => $this->id]);

        }
    }
}

