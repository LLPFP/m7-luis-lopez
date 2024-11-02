<?php

// Simulamos la variable $autenticado
$autenticado = true; // Cambia a false para probar el otro mensaje

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje de Bienvenida</title>
</head>
<body>
    <?php
    if ($autenticado) {
        echo "<h2>¡Bienvenido!</h2>";
    } else {
        echo "<h2>Por favor, inicie sesión.</h2>";
    }
    ?>
</body>
</html>
