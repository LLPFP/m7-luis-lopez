<?php

// Simulamos la variable $stock
$stock = 0; // Cambia a 0 para probar el mensaje de agotado

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilidad del Producto</title>
    <style>
        .disponible {
            color: green;
        }
        .agotado {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    if ($stock > 0) {
        echo "<p class='disponible'>Producto disponible</p>";
    } else {
        echo "<p class='agotado'>Producto agotado</p>";
    }
    ?>
</body>
</html>
