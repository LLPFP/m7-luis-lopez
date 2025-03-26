<?php
session_start();

// Obtener datos del usuario desde la base de datos
include_once("./config/config.php");
$id_cliente = $_SESSION['id_cliente'];

// Primero obtener los datos actuales del usuario
$consulta = "SELECT * FROM clientes WHERE id = " . intval($id_cliente);
$resultado = $conn->query($consulta);
$clientes = $resultado->fetch_assoc();

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $correo = $conn->real_escape_string($_POST['email']);
    $contrasena_actual = $_POST['current_password'];
    $contrasena_nueva = $_POST['new_password'];
    $confirmar_contrasena = $_POST['confirm_password'];
    
    // Manejar la subida de imagen
    $imagen = $clientes['imagen']; // Mantener la imagen existente por defecto
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio_destino = "uploads/clientes/";
        $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
        $extension_archivo = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        
        if(in_array($extension_archivo, $tipos_permitidos)) {
            $nombre_archivo_nuevo = time() . '_' . uniqid() . '.' . $extension_archivo;
            $archivo_destino = $directorio_destino . $nombre_archivo_nuevo;
            
            if(!file_exists($directorio_destino)) {
                mkdir($directorio_destino, 0777, true);
            }
            
            if(move_uploaded_file($_FILES["foto"]["tmp_name"], $archivo_destino)) {
                $imagen_anterior = $directorio_destino . $clientes['imagen'];
                if($clientes['imagen'] && file_exists($imagen_anterior)) {
                    unlink($imagen_anterior);
                }
                $imagen = $nombre_archivo_nuevo;
            } else {
                $_SESSION['error'] = "Error al subir la imagen";
                header("Location: user-profile.php");
                exit();
            }
        }
    }
    // Verificar si se solicita cambio de contraseña
    if (!empty($contrasena_actual) && !empty($contrasena_nueva) && !empty($confirmar_contrasena)) {
        // Verificar contraseña actual
        if (password_verify($contrasena_actual, $clientes['password'])) {
            if ($contrasena_nueva === $confirmar_contrasena) {
                $contrasena_encriptada = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
                $consulta = "UPDATE clientes SET nombre='$nombre', telefono='$telefono', email='$correo', imagen='$imagen', password='$contrasena_encriptada' WHERE id=" . intval($id_cliente);
            } else {
                $_SESSION['error'] = "Las nuevas contraseñas no coinciden";
                header("Location: user-profile.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "La contraseña actual es incorrecta";
            header("Location: user-profile.php");
            exit();
        }
    } else {
        // Actualizar sin cambio de contraseña
        $consulta = "UPDATE clientes SET nombre='$nombre', telefono='$telefono', email='$correo', imagen='$imagen' WHERE id=" . intval($id_cliente);
    }

    if ($conn->query($consulta)) {
        $_SESSION['success'] = "Perfil actualizado correctamente";
        header("Location: user-profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Error al actualizar el perfil: " . $conn->error;
        header("Location: user-profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Perfil de Usuario</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <link href="images/favicon.png" rel="shortcut icon">
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="body-wrapper">

<?php include("./componentes/header.php"); ?>

<section class="user-profile section">
	<div class="container">
		<?php if(isset($_SESSION['error'])): ?>
			<div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
		<?php endif; ?>
		<?php if(isset($_SESSION['success'])): ?>
			<div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
		<?php endif; ?>
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar">
					<div class="widget user">
						<div class="image d-flex justify-content-center">
							<?php if(!empty($clientes['imagen'])): ?>
								<img src="uploads/clientes/<?php echo htmlspecialchars($clientes['imagen']); ?>" alt="Foto de perfil">
							<?php else: ?>
								<img src="images/clientes/user-thumb.jpg" alt="Foto por defecto">
							<?php endif; ?>
						</div>
						<h5 class="text-center"><?php echo htmlspecialchars($clientes['nombre']); ?></h5>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="widget welcome-message">
					<h2>Editar perfil</h2>
					<p>Actualiza tu información personal y configura tu cuenta</p>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="widget personal-info">
							<h3 class="widget-header user">Información Personal</h3>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($clientes['nombre']); ?>" required>
								</div>
								<div class="form-group">
									<label for="telefono">Teléfono</label>
									<input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($clientes['telefono']); ?>" required>
								</div>
								<div class="form-group">
									<label for="email">Correo Electrónico</label>
									<input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($clientes['email']); ?>" required>
								</div>
								<div class="form-group">
									<label for="foto">Foto de Perfil</label>
									<input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
								</div>
								<div class="form-group">
									<label for="current_password">Contraseña Actual</label>
									<input type="password" class="form-control" id="current_password" name="current_password">
								</div>
								<div class="form-group">
									<label for="new_password">Nueva Contraseña</label>
									<input type="password" class="form-control" id="new_password" name="new_password">
								</div>
								<div class="form-group">
									<label for="confirm_password">Confirmar Nueva Contraseña</label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password">
								</div>
								<button type="submit" class="btn btn-primary">Guardar Cambios</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include("./componentes/footer.php"); ?>

</body>
</html>