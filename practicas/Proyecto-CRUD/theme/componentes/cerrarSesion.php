<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Limpiar todas las variables de sesión
    $_SESSION = array();
    
    // Eliminar la cookie de sesión si existe
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    // Destruir la sesión completamente
    session_destroy();
}

// Redireccionar al usuario a la página de inicio
header("Location: ../index.php");
exit;
?>
