<?php
include_once("./config/config.php");
session_start();

// Consulta para obtener todos los correos
$sql = "SELECT c.*, cl.nombre as nombre_cliente, cl.email as email_cliente 
FROM correos c 
LEFT JOIN clientes cl ON c.id = cl.id 
ORDER BY c.fecha_envio DESC";
$result = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Procesar eliminación de correo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !isset($_POST['editar_correo'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM correos WHERE id = " . intval($id);
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensaje'] = "Correo eliminado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el correo";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: admin-correos.php");
    exit();
}

// Obtener lista de clientes para el formulario de nuevo correo
$sql_clientes = "SELECT id, nombre, email FROM clientes ORDER BY nombre";
$result_clientes = mysqli_query($conn, $sql_clientes);

// Verificar si la consulta de clientes fue exitosa
if (!$result_clientes) {
    die("Error en la consulta de clientes: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hotel - Gestión de Correos</title>
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
            <h2>Gestión de Correos</h2>
            <div>
                <a href="admin.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Asunto</th>
                    <th>Fecha Envío</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['asunto']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['fecha_envio'])); ?></td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#verModal<?php echo $row['id']; ?>">Ver</button>
                    </td>
                </tr>

                <!-- Modal para ver el correo -->
                <div class="modal fade" id="verModal<?php echo $row['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalles del Correo</h5>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Cliente:</strong></label>
                                    <p><?php echo htmlspecialchars($row['nombre'] ?? 'N/A'); ?></p>
                                </div>
                                <div class="form-group">
                                    <label><strong>Email:</strong></label>
                                    <p><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></p>
                                </div>
                                <div class="form-group">
                                    <label><strong>Asunto:</strong></label>
                                    <p><?php echo htmlspecialchars($row['asunto']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label><strong>Mensaje:</strong></label>
                                    <div class="p-3 bg-light rounded">
                                        <?php echo nl2br(htmlspecialchars($row['mensaje'])); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>Fecha de Envío:</strong></label>
                                    <p><?php echo date('d/m/Y H:i', strtotime($row['fecha_envio'])); ?></p>
                                </div>
                                
                            </div>
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
                            <div class="modal-body">¿Está seguro de que desea eliminar este correo?</div>
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
