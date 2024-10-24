<?php
include 'pelicules.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detall.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
            $id = $_GET['id'];

            $pelicula = $peliculas[$id -1];

            echo "<h1 class='mb-4'>{$pelicula['Nom']}</h1>";
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

            echo "<p class='card-text bg-secondary p-2 rounded text-white'><strong>Horaris:</strong><a href='' class='ms-5 btn btn-danger col-1'> {$pelicula['Horaris']}</a></p>";
        
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<a href='{$pelicula['Trailer']}' class='btn btn-outline-dark col-4'>Ver Trailer</a>";
            echo "</div>";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</html>