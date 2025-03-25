<?php session_start();

include_once("./config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];
  
// Verificar que los campos no estén vacíos
if (empty($email) || empty($password)) {
$error = "Por favor, complete todos los campos";
}
// Verificar formato de email
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error = "Por favor, introduce un email válido";
} else {
  // Debug para verificar los datos recibidos
  error_log("Email recibido: " . $email);
      
  $sql = "SELECT * FROM clientes WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $resultado = $stmt->get_result();
        
  if ($resultado->num_rows > 0) {
      $cliente = $resultado->fetch_assoc();
      if (!password_verify($password, $cliente['contraseña'])) {
          // Si la contraseña no está hasheada, la hasheamos y actualizamos
          if ($password === $cliente['contraseña']) {
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
              $update_sql = "UPDATE clientes SET contraseña = ? WHERE id = ?";
              $update_stmt = $conn->prepare($update_sql);
              $update_stmt->bind_param("si", $hashed_password, $cliente['id']);
              $update_stmt->execute();
                
              $_SESSION['id_cliente'] = $cliente['id'];
              $_SESSION['email'] = $cliente['email'];
              $_SESSION['nombre'] = $cliente['nombre'];
              header("Location: index.php");
              exit();
          } else {
              $error = "Contraseña incorrecta";
              error_log("Contraseña incorrecta para el usuario: " . $email);
          }
      } else {
          $_SESSION['id_cliente'] = $cliente['id'];
          $_SESSION['email'] = $cliente['email'];
          $_SESSION['nombre'] = $cliente['nombre'];
          header("Location: index.php");
          exit();
      }
  } else {
      $error = "No existe una cuenta con este email";
      error_log("Intento de login con email no existente: " . $email);
  }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>HotelVac - Iniciar Sesión</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sistema de reservas de hotel">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<meta name="author" content="Hotel">
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

<?php include ("./componentes/header.php"); ?>

<section class="login py-5 border-top-1">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5 col-md-8 align-item-center">
<div class="border">
<h3 class="bg-gray p-4">Iniciar Sesión</h3>
<?php if(isset($error)) { ?>
  <div class="alert alert-danger m-3"><?php echo htmlspecialchars($error); ?></div>
<?php } ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <fieldset class="p-4">
    <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
    <input class="form-control mb-3" type="password" name="password" placeholder="Contraseña" required>
    <div class="loggedin-forgot">
      <input type="checkbox" id="keep-me-logged-in" name="keep-logged">
      <label for="keep-me-logged-in" class="pt-3 pb-2">Mantener sesión iniciada</label>
    </div>
    <button type="submit" name="login" class="btn btn-primary font-weight-bold mt-3">Iniciar Sesión</button>
    <a class="mt-3 d-inline-block text-primary" href="register.php">Registrarse</a>
  </fieldset>
</form>  </div>
</div>
</div>
</div>
</section>

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