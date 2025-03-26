<?php
include_once("./config/config.php");
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al login si no está autenticado
    header("Location: login.php");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $new_id = isset($_POST['new_id']) ? intval($_POST['new_id']) : 0;
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $date = date('Y-m-d H:i:s'); // Fecha y hora actual
    
    // Validar que los datos necesarios estén presentes
    if ($new_id <= 0 || $user_id <= 0 || empty($description)) {
        $_SESSION['error_message'] = "Todos los campos son obligatorios.";
        header("Location: blog-single.php?id=" . $new_id);
        exit();
    }
    
    // Verificar que el usuario que envía el comentario es el mismo que está en sesión
    if ($user_id != $_SESSION['user_id']) {
        $_SESSION['error_message'] = "Error de autenticación.";
        header("Location: blog-single.php?id=" . $new_id);
        exit();
    }
    
    // Verificar que la noticia existe
    $checkNews = $conn->query("SELECT id FROM NEWS WHERE id = $new_id");
    if ($checkNews->num_rows == 0) {
        $_SESSION['error_message'] = "La noticia no existe.";
        header("Location: blog.php");
        exit();
    }
    
    // Preparar la consulta SQL para insertar el comentario
    $sql = "INSERT INTO COMMENTS (new_id, user_id, description, date) VALUES ('$new_id', '$user_id', '$description', '$date')";
    
    if ($conn->query($sql)) {
        $_SESSION['success_message'] = "Comentario añadido correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al añadir el comentario: " . $conn->error;
    }
    
    // Redirigir de vuelta a la página de la noticia
    header("Location: blog-single.php?id=" . $new_id);
    exit();
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar el formulario
    header("Location: blog.php");
    exit();
}
?>
