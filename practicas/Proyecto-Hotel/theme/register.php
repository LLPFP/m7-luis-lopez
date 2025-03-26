<?php session_start();

include_once("./config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    
    // Validaciones
    if (empty($email) || empty($password) || empty($confirm_password) || empty($nombre) || empty($telefono)) {
        $error = "Por favor, complete todos los campos";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, introduce un email válido";
    }
    elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden";
    }
    else {
        // Verificar si el email ya existe
        $stmt = $conn->prepare("SELECT id FROM clientes WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $resultado = $stmt->fetch();
        
        if ($resultado) {
            $error = "Este email ya está registrado";
        } else {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar nuevo cliente
            $stmt = $conn->prepare("INSERT INTO clientes (nombre, email, contraseña, telefono) VALUES (:nombre, :email, :password, :telefono)");
            
            if ($stmt->execute([
                'nombre' => $nombre,
                'email' => $email,
                'password' => $hashed_password,
                'telefono' => $telefono
            ])) {
                $_SESSION['success'] = "Registro completado con éxito";
                header("Location: login.php");
                exit();
            } else {
                $error = "Error al registrar el usuario";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

  <!-- ** Basic Page Needs ** -->
  <meta charset="utf-8">
  <title>Classimax | Classified Marketplace Template</title>

  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Agency HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="classimax" />

  <!-- favicon -->
  <link href="images/favicon.png" rel="shortcut icon">

  <!-- 
  Essential stylesheets
  =====================================-->
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  
  <link href="css/style.css" rel="stylesheet">

</head>
<body class="body-wrapper">
    <?php include ("./componentes/header.php"); ?>

    <section class="login py-5 border-top-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 align-item-center">
                    <div class="border">
                        <h3 class="bg-gray p-4">Registro</h3>
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger m-3"><?php echo htmlspecialchars($error); ?></div>
                        <?php } ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <fieldset class="p-4">
                                <input class="form-control mb-3" type="text" name="nombre" placeholder="Nombre" required>
                                <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
                                <input class="form-control mb-3" type="tel" name="telefono" placeholder="Teléfono" required>
                                <input class="form-control mb-3" type="password" name="password" placeholder="Contraseña" required>
                                <input class="form-control mb-3" type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                                <button type="submit" class="btn btn-primary font-weight-bold mt-3">Registrarse</button>
                                <a class="mt-3 d-inline-block text-primary" href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--============================
=            Footer            =
=============================-->

<!-- 
Essential Scripts
=====================================-->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/popper.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/bootstrap-slider.js"></script>
<script src="plugins/tether/js/tether.min.js"></script>
<script src="plugins/raty/jquery.raty-fa.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
<script src="plugins/google-map/map.js" defer></script>

<script src="js/script.js"></script>

</body>

</html>