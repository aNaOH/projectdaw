<?php

include('./views/admin/templates/adminTop.php');

if(!isset($id)){
    echo '<h1>Nueva habilidad</h1>';
} else {
    echo '<h1>Editar habilidad</h1>';
}

?>

<form action="" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <?php 

    if(isset($id)){
        echo '<input type="hidden" id="ability" name="ability" value="'.$id.'">';
    }

    ?>
    <input type="submit" value="<?php if(isset($id)) { echo 'Editar habilidad'; } else { echo 'Crear habilidad'; } ?>" class="btn btn-primary">
</form>

<?php include('./views/admin/templates/adminBottom.php') ?>