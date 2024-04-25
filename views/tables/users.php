<?php

include('./views/templates/app_head.php');

$users = $vars['users'];

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['name'] ?></td>
            <td><?= $user['family_name'] ?></td>
            <td><?= $user['email'] ?></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

<?php

include('./views/templates/app_foot.php');

?>