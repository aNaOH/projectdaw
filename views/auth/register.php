<?php

include('./views/templates/app_head.php');

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
                    <div class="forms-inputs mb-4"> <span>Correo electrónico</span> <input autocomplete="off" type="text" v-model="email" v-bind:class="{'form-control':true, 'is-invalid' : !validName(name) && nameBlured}" v-on:blur="emailBlured = true">
                        <div class="invalid-feedback">Introduce un correo electrónico válido</div>
                    </div>
                    <div class="forms-inputs mb-4"> <span>Nombre</span> <input autocomplete="off" type="text" v-model="name" v-bind:class="{'form-control':true, 'is-invalid' : !validName(email) && nameBlured}" v-on:blur="nameBlured = true">
                        <div class="invalid-feedback">Introduce el nombre</div>
                    </div>
                    <div class="forms-inputs mb-4"> <span>Apellidos</span> <input autocomplete="off" type="text" v-model="familyName" v-bind:class="{'form-control':true, 'is-invalid' : !validFamilyName(email) && familyNameBlured}" v-on:blur="familyNameBlured = true">
                        <div class="invalid-feedback">Introduce los apellidos</div>
                    </div>
                    <div class="forms-inputs mb-4"> <span>Contraseña</span> <input autocomplete="off" type="password" v-model="password" v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(password) && passwordBlured}" v-on:blur="passwordBlured = true">
                        <div class="invalid-feedback">La contraseña debe tener 8 carácteres</div>
                    </div>
                    <div class="forms-inputs mb-4"> <span>Repite la contraseña</span> <input autocomplete="off" type="password" v-model="passwordConfirm" v-bind:class="{'form-control':true, 'is-invalid' : !validPasswordConfirm(password, passwordConfirm) && passwordConfirmBlured}" v-on:blur="passwordConfirmBlured = true">
                        <div class="invalid-feedback">Las contraseñas deben coincidir</div>
                    </div>
                    <div class="forms-inputs mb-4">
                        <span>Localidad</span>
                        <location-input v-model="location"></location-input>
                    </div>
                    <div class="mb-3">
                        <button v-on:click.stop.prevent="submit" class="btn btn-primary w-100" v-bind:class="{'is-invalid' : error}">Registrarse</button>
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
    </div>
</div>

<?php

include('./views/templates/app_foot.php');

?>