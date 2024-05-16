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
                "https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css"
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
                "/assets/admin/js/pages/abilities.js"
            ]
        );
    }

    public static function new()
    {
        $ability = new Ability($_POST['name']);

        $ability->save();

        self::get();
    }


}