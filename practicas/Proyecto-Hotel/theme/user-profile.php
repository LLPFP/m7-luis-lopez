<?php
session_start();

// Obtener datos del usuario desde la base de datos
include_once("./config/config.php");
$id_cliente = $_SESSION['id_cliente'];

// Primero obtener los datos actuales del usuario
$sql = "SELECT * FROM clientes WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $clientes = $result->fetch_assoc();
} else {
    die("Error al preparar la consulta: " . $conn->error);
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Manejar la subida de imagen
    $imagen = $clientes['imagen']; // Mantener la imagen existente por defecto
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/clientes/";
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        
        if(in_array($fileExtension, $allowed_types)) {
            $newFileName = time() . '_' . uniqid() . '.' . $fileExtension;
            $target_file = $target_dir . $newFileName;
            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                if(!empty($clientes['imagen'])) {
                    $old_file = $target_dir . $clientes['imagen'];
                    if(file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
                $imagen = $newFileName;
            }
        }
    }
    // Verificar si se solicita cambio de contraseña
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        // Verificar contraseña actual
        if (password_verify($current_password, $clientes['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE clientes SET nombre=?, telefono=?, email=?, imagen=?, password=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssi", $nombre, $telefono, $email, $imagen, $hashed_password, $id_cliente);
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
        $sql = "UPDATE clientes SET nombre=?, telefono=?, email=?, imagen=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $telefono, $email, $imagen, $id_cliente);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Perfil actualizado correctamente";
        header("Location: user-profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Error al actualizar el perfil: " . $stmt->error;
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