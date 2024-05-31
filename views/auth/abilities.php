<?php include('./views/templates/app_head.php'); ?>

<div id="app">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card px-5 py-5" id="form1">
                    <div class="form-data" v-if="!submitted">
                        <div v-if="abilities.length === 0">
                            <h3>No tienes habilidades</h3>
                        </div>
                        <div v-else>
                            <div v-for="ability in abilities" :key="ability.id" class="forms-inputs mb-4">
                                <!-- Aquí puedes mostrar los detalles de cada habilidad -->
                                <p>{{ ability.name }}</p>
                            </div>
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
</div>

<?php include('./views/templates/app_foot.php'); ?>
