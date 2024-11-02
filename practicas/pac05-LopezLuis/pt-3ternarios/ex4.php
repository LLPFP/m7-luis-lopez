<?php

// Simulamos la variable $idioma
$idioma = "en"; // Cambia a "en" para probar el saludo en inglés

// Usamos un operador ternario para definir el saludo
$saludo = ($idioma === "es") ? "Hola" : (($idioma === "en") ? "Hello" : "¡Idioma no soportado!");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Idioma</title>
</head>
<body>
    <h1><?php echo $saludo; ?></h1>
</body>
</html>
