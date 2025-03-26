<?php
session_start();
include_once("./config/config.php");

// Redirect if not logged in
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

// Process cancellation if requested
if (isset($_POST['cancel_booking']) && isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);
    
    // Get room ID before updating reservation
    $get_room_sql = "SELECT id_habitacion FROM reservas WHERE id = " . $booking_id;
    $result = $conn->query($get_room_sql);
    $room = $result->fetch_assoc();
    $room_id = $room['id_habitacion'];
    
    // Update reservation status
    $update_sql = "UPDATE reservas SET estado = 'cancelada' WHERE id = " . $booking_id . " AND id_cliente = " . $_SESSION['id_cliente'];
    $conn->query($update_sql);
    
    // Increase available rooms by 1
    $update_room_sql = "UPDATE habitaciones SET disponible = disponible + 1 WHERE id = " . $room_id;
    $conn->query($update_room_sql);    
    header("Location: my-bookings.php");
    exit();
}// Get user's bookings
$id_cliente = $_SESSION['id_cliente'];
$sql = "SELECT r.id, r.fecha_inicio, r.fecha_fin, r.estado, 
        h.tipo as nombre_habitacion, h.imagen, h.precio,
        DATEDIFF(r.fecha_fin, r.fecha_inicio) as noches_totales
        FROM reservas r 
        INNER JOIN habitaciones h ON r.id_habitacion = h.id 
        WHERE r.id_cliente = $id_cliente 
        ORDER BY r.fecha_inicio DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mis Reservas - HotelVac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="body-wrapper">

<?php include("./componentes/header.php"); ?>

<section class="dashboard section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Mis Reservas</h3>
                    
                    <?php if ($result && $result->num_rows > 0) { ?>
                        <div class="table-responsive">
                            <table class="table product-dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Habitación</th>
                                        <th>Fechas</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($reserva = $result->fetch_assoc()) { 
                                        $precio_total = $reserva['precio'] * $reserva['noches_totales'];
                                    ?>
                                        <tr>
                                            <td class="product-thumb">
                                                <img width="80px" height="auto" src="<?php echo htmlspecialchars($reserva['imagen']); ?>" alt="Habitación">
                                                <h3 class="title"><?php echo htmlspecialchars($reserva['nombre_habitacion']); ?></h3>
                                            </td>
                                            <td class="product-details">
                                                <div>
                                                    <p><strong>Entrada:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha_inicio'])); ?></p>
                                                    <p><strong>Salida:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha_fin'])); ?></p>
                                                    <p><strong>Noches:</strong> <?php echo $reserva['noches_totales']; ?></p>
                                                    <p><strong>Precio por noche:</strong> €<?php echo number_format($reserva['precio'], 2); ?></p>
                                                    <p><strong>Precio total:</strong> €<?php echo number_format($precio_total, 2); ?></p>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <span class="badge <?php echo ($reserva['estado'] == 'confirmada') ? 'badge-success' : (($reserva['estado'] == 'cancelada') ? 'badge-danger' : 'badge-warning'); ?>">
                                                    <?php echo ucfirst(htmlspecialchars($reserva['estado'])); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($reserva['estado'] == 'Confirmada') { ?>
                                                    <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">
                                                        <input type="hidden" name="booking_id" value="<?php echo $reserva['id']; ?>">
                                                        <button type="submit" name="cancel_booking" class="btn btn-danger btn-sm">Cancelar Reserva</button>
                                                    </form>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-info text-center">
                            <p>Aún no tienes reservas realizadas.</p>
                            <a href="rooms.php" class="btn btn-primary mt-3">Ver Habitaciones Disponibles</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./componentes/footer.php"); ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/popper.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/bootstrap-slider.js"></script>
<script src="js/script.js"></script>

</body>
</html>
