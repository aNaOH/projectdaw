<?php

include('./views/templates/app_head.php');

?>

<div class="container my-5 d-flex flex-column gap-3">
  <h3>Trabajos hechos</h3>
  <form action="/api/works" method="post">
    
  </form>
  <?php
    if($works && count($works) > 0) {
    foreach ($works as $work) {
    ?>

        <div class="container d-flex flex-row gap-2 justify-content-between align-items-center bg-primary p-3 rounded text-white">
            <span class="fs-5 fw-bold"><?=$user['name']?> <?=$user['family_name']?></span>
            <span><?=$user['location']?></span>
            <a href="/profile/<?=$user['id']?>" class="btn btn-secondary fs-5">
                Perfil
            </a>
        </div>

    <?php
    }} else {
  ?>
    <h5>No has hecho ningún trabajo</h5>
  <?php } ?>
  <h3>Trabajos recibidos</h3>
  <?php
    if($worksForYou && count($worksForYou) > 0) {
    foreach ($worksForYou as $work) {
    ?>

        <div class="container d-flex flex-row gap-2 justify-content-between align-items-center bg-primary p-3 rounded text-white">
            <span class="fs-5 fw-bold"><?=$user['name']?> <?=$user['family_name']?></span>
            <span><?=$user['location']?></span>
            <a href="/profile/<?=$user['id']?>" class="btn btn-secondary fs-5">
                Perfil
            </a>
        </div>

    <?php
    }} else {
  ?>
    <h5>No has recibido ningún trabajo</h5>
  <?php } ?>
</div>

<?php

include('./views/templates/app_foot.php');

?>