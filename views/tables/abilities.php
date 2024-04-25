<?php

include('./views/templates/app_head.php');

$abilities = $vars['abilities'];

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Habilidad</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($abilities as $ability) { ?>
        <tr>
            <th scope="row"><?= $ability['id'] ?></th>
            <td><?= $ability['name'] ?></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

<?php

include('./views/templates/app_foot.php');

?>