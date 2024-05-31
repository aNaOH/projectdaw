<?php

require_once './models/Ability.php';

class AbilityController
{

    public static function get()
    {
        $abilities = Ability::getAll();

        ViewController::summon(
            'admin/abilities/all',
            [
                "abilities" => $abilities
            ],
            [
                "https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css",
                "https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css",
                "https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css",
                "/assets/admin/css/pages/table.css"
            ],
            [
                "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js",
                "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js",
                "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js",
                "https://cdn.datatables.net/2.0.7/js/dataTables.min.js",
                "https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js",
                "https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js",
                "https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js",
                "https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js",
                "https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js",
                "https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js",
                "https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js",
                "https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js",
                "/assets/admin/js/pages/table.js"
            ]
        );
    }

    public static function newForm(){
        ViewController::summon("admin/abilities/form");
    }

    public static function new()
    {
        $ability = new Ability($_POST['name']);

        $ability->save();

        header('Location: /admin/abilities');
    }

    public static function editForm($id){
        ViewController::summon("admin/abilities/form", ['id' => $id]);
    }

    public static function edit()
    {
        $id = $_POST['ability'];

        $abilityRow = Connection::doSelect(Consts::$db_conn, 'ability', ["id" => $id]);

        $ability = new Ability($_POST['name']);
        $ability->id = $id;

        $ability->save();

        header('Location: /admin/abilities');
    }

    public static function delete()
    {
        $id = $_POST['ability'];

        $abilityRow = Ability::getById($id);

        var_dump($abilityRow);

        $ability = new Ability($abilityRow['name']);
        $ability->id = $id;

        $ability->delete();

        header('Location: /admin/abilities');
    }
}