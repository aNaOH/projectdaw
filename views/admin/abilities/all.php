<?php include('./views/admin/templates/adminTop.php') ?>

<a href="abilities/new" class="btn btn-primary">Nueva habilidad</a>

<table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($vars['abilities'] as $ability) { ?>
            <tr>
                <td><?= $ability['id'] ?></td>
                <td><?= $ability['name'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
</table>

<?php include('./views/admin/templates/adminBottom.php') ?>