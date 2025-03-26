<?php
include_once("./config/config.php");
session_start();

$sql = "SELECT r.*, c.nombre as nombre_cliente, h.tipo as tipo_habitacion 
FROM reservas r 
INNER JOIN clientes c ON r.id_cliente = c.id 
INNER JOIN habitaciones h ON r.id_habitacion = h.id 
ORDER BY r.fecha_inicio DESC";
$result = mysqli_query($conn, $sql);

// Obtener lista de clientes y habitaciones para los selects
$sql_clientes = "SELECT id, nombre FROM clientes";
$clientes = mysqli_query($conn, $sql_clientes);

$sql_habitaciones = "SELECT id, tipo FROM habitaciones";
$habitaciones = mysqli_query($conn, $sql_habitaciones);

// Procesar eliminación de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !isset($_POST['editar_reserva'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM reservas WHERE id = " . intval($id);
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Reserva eliminada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la reserva";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-reservas.php");
    exit();
}

// Procesar edición de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_reserva'])) {
    $id = intval($_POST['id']);
    $fecha_inicio = mysqli_real_escape_string($conn, $_POST['fecha_inicio']);
    $fecha_fin = mysqli_real_escape_string($conn, $_POST['fecha_fin']);
    $id_cliente = intval($_POST['id_cliente']);
    $id_habitacion = intval($_POST['id_habitacion']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    
    $sql = "UPDATE reservas SET 
            fecha_inicio = '$fecha_inicio', 
            fecha_fin = '$fecha_fin', 
            id_cliente = $id_cliente, 
            id_habitacion = $id_habitacion, 
            estado = '$estado' 
            WHERE id = $id";
            
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Reserva actualizada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la reserva: " . mysqli_error($conn);
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-reservas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hotel - Gestión de Reservas</title>
    <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include("./componentes/header.php"); ?>

<section class="dashboard section">
    <div class="container">
        <?php if(isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipo_mensaje']; ?>">
                <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-4">
            <h2>Gestión de Reservas</h2>
            <div>
                <a href="admin.php" class="btn btn-secondary me-2">Volver</a>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo Habitación</th>
                    <th>Fecha Entrada</th>
                    <th>Fecha Salida</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_cliente']); ?></td>
                    <td><?php echo $row['tipo_habitacion']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha_inicio'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha_fin'])); ?></td>
                    <td><?php echo ucfirst($row['estado']); ?></td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#editarModal<?php echo $row['id']; ?>">Editar</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal<?php echo $row['id']; ?>">Eliminar</button>
                    </td>
                </tr>

                <!-- Modal de edición -->
                <div class="modal fade" id="editarModal<?php echo $row['id']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Reserva</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="editar_reserva" value="1">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class="form-control" name="id_cliente" required>
                                            <?php 
                                            mysqli_data_seek($clientes, 0);
                                            while($cliente = mysqli_fetch_assoc($clientes)): 
                                            ?>
                                                <option value="<?php echo $cliente['id']; ?>" <?php echo ($cliente['id'] == $row['id_cliente']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo Habitación</label>
                                        <select class="form-control" name="id_habitacion" required>
                                            <?php 
                                            mysqli_data_seek($habitaciones, 0);
                                            while($habitacion = mysqli_fetch_assoc($habitaciones)): 
                                            ?>
                                                <option value="<?php echo $habitacion['id']; ?>" <?php echo ($habitacion['id'] == $row['id_habitacion']) ? 'selected' : ''; ?>>
                                                    <?php echo $habitacion['tipo']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Entrada</label>
                                        <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $row['fecha_inicio']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Salida</label>
                                        <input type="date" class="form-control" name="fecha_fin" value="<?php echo $row['fecha_fin']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="estado" required>
                                            <option value="pendiente" <?php echo ($row['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                            <option value="confirmada" <?php echo ($row['estado'] == 'confirmada') ? 'selected' : ''; ?>>Confirmada</option>
                                            <option value="cancelada" <?php echo ($row['estado'] == 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                                            <option value="completada" <?php echo ($row['estado'] == 'completada') ? 'selected' : ''; ?>>Completada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Modal de eliminación -->
                <div class="modal fade" id="eliminarModal<?php echo $row['id']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar Eliminación</h5>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <div class="modal-body">¿Está seguro de que desea eliminar esta reserva?</div>
                            <div class="modal-footer">
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include("./componentes/footer.php"); ?>

<!-- Scripts necesarios para Bootstrap y los modales -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>
