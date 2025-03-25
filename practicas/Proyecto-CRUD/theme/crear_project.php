<?php
include_once("./config/config.php");
session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $thumbnail = '';
    
    // Manejar la subida de imagen
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
        $imagen_nombre = time() . '_' . $_FILES['thumbnail']['name'];
        $imagen_temporal = $_FILES['thumbnail']['tmp_name'];
        $ruta_destino = 'uploads/projects/' . $imagen_nombre;
        
        if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
            $thumbnail = $ruta_destino; // Guardar la ruta completa
        } else {
            $_SESSION['error_message'] = "Error al subir la imagen.";
            header("Location: admin-proyectos.php");
            exit();
        }
    }
    
    // Insertar el nuevo proyecto
    $insert_query = "INSERT INTO PROJECTS (title, url, description, thumbnail) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssss", $title, $url, $description, $thumbnail);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Proyecto creado correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al crear el proyecto: " . $conn->error;
    }
    
    header("Location: admin-proyectos.php");
    exit();
}
