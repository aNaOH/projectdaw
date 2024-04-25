<?php

class Ability {
    public $id;
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public static function getAll() {
        $stmt = Consts::$db_conn->query("SELECT * FROM Ability");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $stmt = Consts::$db_conn->prepare("SELECT * FROM Ability WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {
        if ($this->id) {

            Connection::doUpdate(Consts::$db_conn, 'Ability', [
                'name' => $this->name,
            ], ['id', $this->id]);

        } else {
            Connection::doInsert(Consts::$db_conn, 'Ability', [
                'name' => $this->name,
            ]);
            // Actualizamos el ID del usuario con el último ID insertado
            $this->id = Consts::$db_conn->lastInsertId();
        }
    }
}

