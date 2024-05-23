<?php

include('./views/templates/app_head.php');

extract($vars);

?>

<div class="p-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <img src="https://github.com/mdo.png" alt="mdo" width="128" height="128" class="rounded-circle">
                <h5 class="mt-1">
                    <?= $user['name'] ?> <?= $user['family_name'] ?>
                </h5>
                <h6>
                    <b>Ubicación:</b> <?= $user['location'] ?>
                </h6>
                <h6><b>Habilidades</b></h6>
                <?php if (count($abilities) == 0) { ?>
                    <p>Este usuario no tiene habilidades</p>
                <?php } else { ?>
                    <ul>
                        <li>Programación - 5 años de experiencia</li>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <p><?= $user['description'] ?></p>
            </div>
        </div>
    </div>
</div>

<?php

include('./views/templates/app_foot.php');

?>