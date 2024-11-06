<header class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid d-flex justify-content-between">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
    <img src='tienda/data/assets/logoMercadona.jpg' alt="logoMercadona" style="width: 100px; height: 100px;">
    </a>

    <div>
    <!-- mensajes + avatar foto perfil -->

        <div class="d-flex align-items-center">
            <h2 class="me-3 mb-0 px-4">Bienvenido <?php echo $_POST['nombre']?> !</h2>
            <img src='<?php echo $_POST['foto']?>' alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
        </div>


    <!-- Navegación -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>
    </button>



    </div>
    </div>
</header>