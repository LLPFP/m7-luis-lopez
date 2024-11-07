<?php
include 'pelicules.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalls Película</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
<body>
    <header class="container-fluid bg-danger bg-gradient text-dark py-3 mb-3">
        <h1 class="text-center text-white">Cartellera Cinema Ocine Magic</h1>
        <img class="bg-white rounded " src="https://www.ocinemagic.es/images/logo-ocine-mag.png#joomlaImage://local-images/logo-ocine-mag.png?width=240&height=119" alt="">
        </header>
    <main>
    <div class="container mt-5">
        <?php
            $id = $_GET['id'];

            $pelicula = $peliculas[$id -1];

            echo "<div class='d-flex align-items-center'> <h1 class='mb-4 mt-4'>{$pelicula['Nom']}</h1>";
            echo '<a href="index.php?" class="btn btn-danger ms-5 p-2 "><i class="bi bi-arrow-bar-left"></i>Tornar</a></div>';                        
            echo "<div class='row'>";
            echo "<div class='col-md-4'>";
            echo "<img src='{$pelicula['Imagen']}' alt='{$pelicula['Nom']}' class='img-fluid mb-3'>";
            echo "</div>";
            echo "<div class='col-md-8'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<p class='card-text'>{$pelicula['Sinopsi']}</p>";
            echo "<p class='card-text'><strong>Duración:</strong> {$pelicula['Durada']}</p>";
            echo "<p class='card-text'><strong>Director:</strong> {$pelicula['Director']}</p>";
            echo "<p class='card-text'><strong>Reparto:</strong> {$pelicula['Reparto']}</p>";
            echo "<p class='card-text'><strong>Calificación:</strong> {$pelicula['Calificacion']}</p>";
            echo "<p class='card-text'><strong>Género:</strong> {$pelicula['Genero']}</p>";

            echo "<p class='card-text border border-solid p-2 '><strong>Horaris:</strong><a href='' class='ms-5 btn btn-danger col-1'> {$pelicula['Horaris']}</a></p>";
        
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<a href='trailer.php?id={$pelicula['Id']}' class='btn btn-outline-dark col-4'><i class='bi bi-play-circle'></i>TRAILER</a>";
            echo "</div>";
        ?>
    </div>




    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
</body>
</html>
</html>