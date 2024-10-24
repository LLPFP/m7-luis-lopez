<?php

include 'pelicules.php';
?>


<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartellera Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="container-fluid bg-red text-dark py-4 mb-4">
        <h1 class="text-center">Cartellera Cinema Ocine Magic</h1>.
        <img src="https://www.ocinemagic.es/images/logo-ocine-mag.png#joomlaImage://local-images/logo-ocine-mag.png?width=240&height=119" alt="">
    </header>

    <main class="container">
        <div class="row g-4">

<?php
    foreach ($peliculas as $pelicula) {
            echo "<div class='col-12 col-md-6 col-lg-4'>
                <div class='card h-100'>
                    <h3 class='card-header text-truncate'>" .$pelicula['Nom']. "</h3>
                    <img src='".$pelicula['Imagen']."' class='card-img-top img-fluid' style='height: 400px; object-fit: cover;' alt='Oppenheimer'> 
                        <div class='card-body'>
                        <div class='showtimes mb-3'>
                            <p class='card-text'>" .$pelicula['Durada']. " minutos </p>
                        </div>
                        <div class='d-grid gap-2'>
                            <a href='trailer.php?id=" .$pelicula['Id']. "' class='btn btn-danger'>Veure tràiler</a>
                            <a href='detall.php?id=" .$pelicula['Id']. "' class='btn btn-danger'>Més informació</a>                        </div>
                    </div>
                </div>
            </div>";
    }
?>
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>