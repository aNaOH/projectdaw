<?php include('./views/admin/templates/adminTop.php') ?>

<a href="abilities/new" class="btn btn-primary">Nueva habilidad</a>

<table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($vars['abilities'] as $ability) { ?>
            <tr>
                <td><?= $ability['id'] ?></td>
                <td><?= $ability['name'] ?></td>
                <td>
                    <div class="container d-flex flex-row gap-2">
                        <a href="/admin/abilities/<?=$ability['id']?>" class="btn btn-warning">Editar</a>
                        <form action="/admin/abilities/delete/<?=$ability['id']?>" method="post">
                            <input type="hidden" id="ability" name="ability" value="<?=$ability['id']?>">
                            <input type="submit" class="btn btn-danger" value="Borrar">
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
</table>

<?php include('./views/admin/templates/adminBottom.php') ?>