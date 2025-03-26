<?php
session_start();
require_once("./config/config.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_cliente'];
    $id_habitacion = $_POST['id_habitacion'];
    $fecha_inicio = $_POST['fecha_entrada'];
    $fecha_fin = $_POST['fecha_salida'];
    $estado = 'pendiente';
    
    // Insertar reserva
    $sql = "INSERT INTO reservas (id_cliente, id_habitacion, fecha_inicio, fecha_fin, estado) VALUES ('$id_usuario', '$id_habitacion', '$fecha_inicio', '$fecha_fin', '$estado')";
    
    if ($conn->query($sql)) {
        // Actualizar disponibilidad de la habitación
        $sql_update = "UPDATE habitaciones SET disponible = 0 WHERE id = '$id_habitacion'";
        if ($conn->query($sql_update)) {
            header("Location: my-bookings.php");
            exit();
        }
    } else {
        header("Location: single.php?id=" . $id_habitacion . "&error=1");
    }
    
    $conn->close();
}
