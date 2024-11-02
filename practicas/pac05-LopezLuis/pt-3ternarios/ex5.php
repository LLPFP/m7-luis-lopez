<?php

// Simulamos la variable $logueado
$logueado = true; // Cambia a false para probar el ícono de invitado

// Definimos los íconos correspondientes
$iconoUsuario = $logueado ? "usuario.png" : "invitado.png";
$textoAlternativo = $logueado ? "Usuario Logueado" : "Usuario Invitado";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ícono de Usuario</title>
</head>
<body>
    <h1><?php echo $textoAlternativo; ?></h1>
    <img src="<?php echo $iconoUsuario; ?>" alt="<?php echo $textoAlternativo; ?>" style="width:50px;height:50px;">
</body>
</html>
