<?php
include_once("./config/config.php");
session_start();

$sql = "SELECT * FROM habitaciones ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Procesar eliminación de habitación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !isset($_POST['editar_habitacion'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM habitaciones WHERE id = " . intval($id);
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Habitación eliminada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la habitación";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-habitaciones.php");
    exit();
}

// Procesar creación de habitación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_habitacion'])) {
    $tipo = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $disponibilidad = intval($_POST['disponibilidad']);
    $sql = "INSERT INTO habitaciones (tipo, precio, disponible) VALUES ('$tipo', $precio, $disponibilidad)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Habitación creada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al crear la habitación";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-habitaciones.php");
    exit();
}

// Procesar edición de habitación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_habitacion'])) {
    $id = intval($_POST['id']);
    $tipo = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $disponibilidad = intval($_POST['disponibilidad']);
    $sql = "UPDATE habitaciones SET tipo = '$tipo', precio = $precio, disponible = $disponibilidad WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Habitación actualizada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la habitación";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-habitaciones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Hotel - Gestión de Habitaciones</title>
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
            <h2>Gestión de Habitaciones</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#crearHabitacionModal">Añadir Habitación</button>
        </div>

        <!-- Modal de Crear Habitación -->
        <div class="modal fade" id="crearHabitacionModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Nueva Habitación</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="crear_habitacion" value="1">
                            <div class="form-group">
                                <label>Tipo de Habitación</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="number" class="form-control" name="precio" required>
                            </div>
                            <div class="form-group">
                                <label>Disponibilidad</label>
                                <input type="number" class="form-control" name="disponibilidad" required min="0">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Crear Habitación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                    <td><?php echo $row['precio']; ?>€</td>
                    <td><?php echo $row['disponible']; ?></td>
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
                                    <h5 class="modal-title">Editar Habitación</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="editar_habitacion" value="1">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($row['tipo']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number" class="form-control" name="precio" value="<?php echo $row['precio']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Disponibilidad</label>
                                        <input type="number" class="form-control" name="disponibilidad" value="<?php echo $row['disponible']; ?>" required min="0">
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
                            <div class="modal-body">¿Está seguro de que desea eliminar esta habitación?</div>
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
