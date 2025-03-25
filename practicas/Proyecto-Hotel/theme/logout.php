<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se está usando una cookie de sesión, destruirla también
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: index.php");
exit();
?>
