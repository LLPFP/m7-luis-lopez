<?php
include_once("./config/config.php");
session_start();  

$sql = "SELECT * FROM clientes ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Procesar eliminación de cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !isset($_POST['editar_cliente'])) {
    $id = $_POST['id'];
    
    // Primero obtenemos la información de la imagen del cliente
    $sql = "SELECT imagen FROM clientes WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cliente = mysqli_fetch_assoc($result);
    
    // Si existe una imagen, la eliminamos del servidor
    if (!empty($cliente['imagen'])) {
        $ruta_imagen = 'uploads/clientes/' . $cliente['imagen'];
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }
    
    // Eliminamos el registro de la base de datos
    $sql = "DELETE FROM clientes WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensaje'] = "Cliente eliminado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
        header("Location: admin-clientes.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el cliente";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: admin-clientes.php");
        exit();
    }
    
    mysqli_stmt_close($stmt);

}

// Procesar creación de cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_cliente'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];
    $imagen = '';

    // Procesar la imagen si se subió una
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen_nombre = time() . '_' . $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $ruta_destino = 'uploads/clientes/' . $imagen_nombre;

        if(move_uploaded_file($imagen_temp, $ruta_destino)) {
            $imagen = $imagen_nombre;
        }
    }

    $sql = "INSERT INTO clientes (nombre, email, telefono, rol, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $email, $telefono, $rol, $imagen);

    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['mensaje'] = "Cliente creado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al crear el cliente";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    header("Location: admin-clientes.php");
    exit();
}

// Procesar edición de cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_cliente'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    // Si se subió una nueva imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // Primero eliminamos la imagen anterior si existe
        $sql = "SELECT imagen FROM clientes WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $cliente = mysqli_fetch_assoc($result);

        if (!empty($cliente['imagen'])) {
            $ruta_imagen = 'uploads/clientes/' . $cliente['imagen'];
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }

        // Subimos la nueva imagen
        $imagen_nombre = time() . '_' . $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $ruta_destino = 'uploads/clientes/' . $imagen_nombre;

        if(move_uploaded_file($imagen_temp, $ruta_destino)) {
            $sql = "UPDATE clientes SET nombre = ?, email = ?, telefono = ?, rol = ?, imagen = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $email, $telefono, $rol, $imagen_nombre, $id);
        }
    } else {
        $sql = "UPDATE clientes SET nombre = ?, email = ?, telefono = ?, rol = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $email, $telefono, $rol, $id);
    }

    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['mensaje'] = "Cliente actualizado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el cliente";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    header("Location: admin-clientes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Hotel - Gestión de Clientes</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="body-wrapper">
<?php include("./componentes/header.php"); ?>

<section class="dashboard section">
    <div class="container">
        <?php
        if(isset($_SESSION['mensaje'])) {
            echo '<div class="alert alert-'.$_SESSION['tipo_mensaje'].'" role="alert">'.$_SESSION['mensaje'].'</div>';
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']);
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2>Gestión de Clientes</h2>
                    <a href="admin.php" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Lista de Clientes</h4>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearClienteModal">
                                <i class="fa fa-plus"></i> Nuevo Cliente
                            </button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Rol</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM clientes ORDER BY id DESC";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>";
                                        if(!empty($row['imagen'])) {
                                            echo "<img src='uploads/clientes/".htmlspecialchars($row['imagen'])."' class='rounded-circle' width='50' height='50'>";
                                        } else {
                                            echo "<img src='images/clientes/avatar.png' class='rounded-circle' width='50' height='50'>";
                                        }
                                        echo "</td>";
                                        echo "<td>".htmlspecialchars($row['nombre'])."</td>";
                                        echo "<td>".$row['email']."</td>";
                                        echo "<td>".$row['telefono']."</td>";
                                        echo "<td>".$row['rol']."</td>";
                                        echo "<td>".date('d/m/Y', strtotime($row['fecha_registro']))."</td>";
                                        echo "<td>
                                                <button type='button' class='btn btn-sm btn-info mr-2' data-toggle='modal' data-target='#editarModal".$row['id']."'><i class='fa fa-edit'></i></button>
                                                <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#eliminarModal".$row['id']."'><i class='fa fa-trash'></i></button>
                                            </td>";
                                        echo "</tr>";
                                        
                                        // Modal de Edición
                                        echo "<div class='modal fade' id='editarModal".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='editarModalLabel".$row['id']."' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='editarModalLabel".$row['id']."'>Editar Cliente</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>×</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form action='' method='POST' enctype='multipart/form-data'>
                                                            <input type='hidden' name='editar_cliente' value='1'>
                                                            <input type='hidden' name='id' value='".$row['id']."'>
                                                            <div class='form-group'>
                                                                <label>Nombre</label>
                                                                <input type='text' class='form-control' name='nombre' value='".htmlspecialchars($row['nombre'])."' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Email</label>
                                                                <input type='email' class='form-control' name='email' value='".htmlspecialchars($row['email'])."' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Teléfono</label>
                                                                <input type='tel' class='form-control' name='telefono' value='".htmlspecialchars($row['telefono'])."' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Rol</label>
                                                                <select class='form-control' name='rol' required>
                                                                    <option value='Usuario' ".($row['rol'] == 'usuario' ? 'selected' : '').">Usuario</option>
                                                                    <option value='Admin' ".($row['rol'] == 'admin' ? 'selected' : '').">Administrador</option>
                                                                </select>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Nueva imagen de perfil</label>
                                                                <input type='file' class='form-control-file' name='imagen' accept='image/*'>
                                                                <small class='form-text text-muted'>Imagen actual: ".($row['imagen'] ? htmlspecialchars($row['imagen']) : 'Sin imagen')."</small>
                                                            </div>
                                                            <div class='modal-footer px-0 pb-0'>
                                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                                                <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";                                        
                                        // Modal de Eliminación
                                        echo "<div class='modal fade' id='eliminarModal".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='eliminarModalLabel".$row['id']."' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='eliminarModalLabel".$row['id']."'>Confirmar Eliminación</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>×</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        ¿Está seguro de que desea eliminar este cliente?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                        <form action='' method='POST'>
                                                            <input type='hidden' name='id' value='".$row['id']."'>
                                                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para Crear Cliente -->
<div class="modal fade" id="crearClienteModal" tabindex="-1" role="dialog" aria-labelledby="crearClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearClienteModalLabel">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="crear_cliente" value="1">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen de perfil</label>
                        <input type="file" class="form-control-file" name="imagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("./componentes/footer.php"); ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/popper.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/bootstrap-slider.js"></script>
<script src="plugins/tether/js/tether.min.js"></script>
<script src="plugins/raty/jquery.raty-fa.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
