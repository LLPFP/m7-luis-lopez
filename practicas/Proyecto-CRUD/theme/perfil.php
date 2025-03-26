<?php
session_start();
include_once("./config/config.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.php");
    exit();
}

// Obtener datos del usuario
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM USERS WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Procesar el formulario cuando se envía
$message = '';
$messageType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Actualizar perfil
    if (isset($_POST['update_profile'])) {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $email = trim($_POST['email']);
        $age = trim($_POST['age']);
        $job = trim($_POST['job']);
        
        // Validar campos
        if (empty($name) || empty($surname) || empty($email) || empty($age) || empty($job)) {
            $message = "Todos los campos son obligatorios";
            $messageType = "danger";
        } else {
            // Verificar si el correo ya existe (excepto el del usuario actual)
            $check_email = "SELECT id FROM USERS WHERE email = '$email' AND id != $user_id";
            $email_result = $conn->query($check_email);
            
            if ($email_result->num_rows > 0) {
                $message = "El correo electrónico ya está en uso";
                $messageType = "danger";
            } else {
                // Actualizar información del usuario
                $update_sql = "UPDATE USERS SET name = '$name', surname = '$surname', email = '$email', age = $age, job = '$job' WHERE id = $user_id";
                
                if ($conn->query($update_sql)) {
                    $message = "Perfil actualizado correctamente";
                    $messageType = "success";
                    
                    // Actualizar datos en sesión
                    $_SESSION['usuario'] = $name;
                    
                    // Recargar datos del usuario
                    $sql = "SELECT * FROM USERS WHERE id = $user_id";
                    $result = $conn->query($sql);
                    $user = $result->fetch_assoc();
                } else {
                    $message = "Error al actualizar el perfil: " . $conn->error;
                    $messageType = "danger";
                }
            }
        }
    }
    
    // Cambiar contraseña
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Verificar que la contraseña actual sea correcta
        if (!password_verify($current_password, $user['password'])) {
            $message = "La contraseña actual es incorrecta";
            $messageType = "danger";
        } elseif ($new_password !== $confirm_password) {
            $message = "Las nuevas contraseñas no coinciden";
            $messageType = "danger";
        } elseif (strlen($new_password) < 6) {
            $message = "La nueva contraseña debe tener al menos 6 caracteres";
            $messageType = "danger";
        } else {
            // Actualizar contraseña
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE USERS SET password = '$hashed_password' WHERE id = $user_id";
            
            if ($conn->query($update_sql)) {
                $message = "Contraseña actualizada correctamente";
                $messageType = "success";
            } else {
                $message = "Error al actualizar la contraseña: " . $conn->error;
                $messageType = "danger";
            }
        }
    }
    
    // Actualizar avatar
    if (isset($_POST['update_avatar'])) {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['avatar']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            
            // Verificar extensión
            if (!in_array(strtolower($filetype), $allowed)) {
                $message = "Solo se permiten imágenes en formato JPG, JPEG, PNG y GIF";
                $messageType = "danger";
            } else {
                // Crear directorio si no existe
                $upload_dir = "uploads/avatars/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generar nombre único para el archivo
                $new_filename = uniqid('avatar_') . "." . $filetype;
                $destination = $upload_dir . $new_filename;
                
                // Mover archivo
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)) {
                    // Actualizar avatar en la base de datos
                    $avatar_path = $destination;
                    $update_sql = "UPDATE USERS SET avatar = '$avatar_path' WHERE id = $user_id";
                    
                    if ($conn->query($update_sql)) {
                        $message = "Avatar actualizado correctamente";
                        $messageType = "success";
                        
                        // Recargar datos del usuario
                        $sql = "SELECT * FROM USERS WHERE id = $user_id";
                        $result = $conn->query($sql);
                        $user = $result->fetch_assoc();
                    } else {
                        $message = "Error al actualizar el avatar: " . $conn->error;
                        $messageType = "danger";
                    }
                } else {
                    $message = "Error al subir la imagen";
                    $messageType = "danger";
                }
            }
        } else {
            $message = "Por favor seleccione una imagen";
            $messageType = "danger";
        }
    }
}

?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>TechX</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- theme meta -->
  <meta name="theme-name" content="agen" />
  
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- venobox css -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <!-- card slider -->
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>

<body>

<?php
    include("./componentes/header.php");

?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Mi Perfil</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<section class="section">
  <div class="container">
    <?php if (!empty($message)): ?>
      <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php endif; ?>
    
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center">
            <img src="<?php echo !empty($user['avatar']) ? $user['avatar'] : 'images/default-avatar.png'; ?>" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h4><?php echo $user['name'] . ' ' . $user['surname']; ?></h4>
            <p class="text-muted"><?php echo $user['email']; ?></p>
            <p class="badge badge-primary"><?php echo $user['rol']; ?></p>
            
            <form action="" method="post" enctype="multipart/form-data" class="mt-4">
              <div class="form-group">
                <label for="avatar" class="btn btn-outline-primary btn-sm">Cambiar imagen</label>
                <input type="file" id="avatar" name="avatar" class="d-none">
                <small class="form-text text-muted" id="selected-file">Ningún archivo seleccionado</small>
              </div>
              <button type="submit" name="update_avatar" class="btn btn-primary btn-block">Actualizar imagen</button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h5 class="mb-0">Información personal</h5>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
              </div>
              <div class="form-group">
                <label for="surname">Apellido</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $user['surname']; ?>" required>
              </div>
              <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
              </div>
              <div class="form-group">
                <label for="age">Edad</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>" required>
              </div>
              <div class="form-group">
                <label for="job">Trabajo</label>
                <input type="text" class="form-control" id="job" name="job" value="<?php echo $user['job']; ?>" required>
              </div>
              <button type="submit" name="update_profile" class="btn btn-primary">Guardar cambios</button>
            </form>
          </div>
        </div>
        
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h5 class="mb-0">Cambiar contraseña</h5>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="current_password">Contraseña actual</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
              </div>
              <div class="form-group">
                <label for="new_password">Nueva contraseña</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>
              <div class="form-group">
                <label for="confirm_password">Confirmar nueva contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
              </div>
              <button type="submit" name="change_password" class="btn btn-primary">Cambiar contraseña</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("./componentes/footer.php"); ?>

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- venobox -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- shuffle -->
<script src="plugins/shuffle/shuffle.min.js"></script>
<!-- apear js -->
<script src="plugins/counto/apear.js"></script>
<!-- counter -->
<script src="plugins/counto/counTo.js"></script>
<!-- card slider -->
<script src="plugins/card-slider/js/card-slider-min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

<script>
  // Mostrar nombre del archivo seleccionado
  document.getElementById('avatar').addEventListener('change', function() {
    const fileName = this.files[0] ? this.files[0].name : 'Ningún archivo seleccionado';
    document.getElementById('selected-file').textContent = fileName;
  });
</script>

</body>
</html>
