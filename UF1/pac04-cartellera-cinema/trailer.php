<?php
include 'pelicules.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
<body class="bg-black">
    <header class="container-fluid bg-danger bg-gradient py-3">
        <h1 class="text-center text-white">Cartellera Cinema Ocine Magic</h1>
        <img class="bg-white rounded" src="https://www.ocinemagic.es/images/logo-ocine-mag.png#joomlaImage://local-images/logo-ocine-mag.png?width=240&height=119" alt="">
        </header>
    <main class="bg-black">
    <div class="container mt-3">
        <?php
            $id = $_GET['id'];

            $pelicula = $peliculas[$id -1];

            echo "<div class='d-flex align-items-center text-white'> <h1 class='mb-4 mt-4'>{$pelicula['Nom']}</h1>";
            echo '<a href="index.php?" class="btn btn-danger ms-5 p-2 "><i class="bi bi-arrow-bar-left"></i>Tornar</a></div>';                        
            echo "<div class='embed-responsive embed-responsive-21by9'>
                        <iframe width='1320' height='715' src='{$pelicula['Trailer']}'  title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen;>
                        </iframe>
                </div>";

        ?>
    </div>




    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
</body>
</html>
</html>