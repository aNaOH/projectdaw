<?php

include('./views/templates/app_head.php');

?>

<div class="container my-5 d-flex flex-column gap-3">
  <?php
    foreach ($users as $user) {
      if($user['id'] == $_SESSION['user'][0]['id']) continue;
    ?>

        <div class="container d-flex flex-row gap-2 justify-content-between align-items-center bg-primary p-3 rounded text-white">
            <span class="fs-5 fw-bold"><?=$user['name']?> <?=$user['family_name']?></span>
            <span><?=$user['location']?></span>
            <a href="/profile/<?=$user['id']?>" class="btn btn-secondary fs-5">
                Perfil
            </a>
        </div>

    <?php
    }
  ?>
</div>

<?php

include('./views/templates/app_foot.php');

?>