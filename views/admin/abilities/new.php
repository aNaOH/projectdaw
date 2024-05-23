<?php include('./views/admin/templates/adminTop.php') ?>

<h1>Nueva habilidad</h1>

<form action="" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <input type="submit" value="Crear habilidad" class="btn btn-primary">
</form>

<?php include('./views/admin/templates/adminBottom.php') ?>