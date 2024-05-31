<?php

include('./views/templates/app_head.php');

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
                <?php } 
                
                if($user['id'] == $_SESSION['user'][0]['id']) {
                ?>
                    <div class="my-8">
                        <div id="app">

                            <h3>Editar perfil</h3>

                            <div class="form-data" v-if="!submitted">
                                <div class="forms-inputs mb-4">
                                    <span>Localidad</span>
                                    <location-input v-model="location"></location-input>
                                </div>
                                
                                <div class="mb-3">
                                    <button v-on:click.stop.prevent="submit" class="btn btn-primary w-100" v-bind:class="{'is-invalid' : error}">Aplicar cambios</button>
                                    <div class="invalid-feedback" v-html="errorMessage"></div>
                                </div>
                            </div>
                            <div class="mx-auto" v-else>
                                <div class="d-flex flex-column">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Cargando...</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php }?>
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