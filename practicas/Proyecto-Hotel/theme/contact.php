<?php
session_start();
include_once("./config/config.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING));
      $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
      $asunto = trim(filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_STRING));
      $mensaje = trim(filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING));

      if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
          $error = "Todos los campos son obligatorios.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = "Correo electrónico no válido.";
      } else {
          try {
              if (!$conn) {
                  throw new Exception("Error de conexión: " . mysqli_connect_error());
              }

              $sql = "INSERT INTO correos (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)";
              $stmt = $conn->prepare($sql);

              if (!$stmt) {
                  throw new Exception("Error en la preparación de la consulta: " . $conn->error);
              }

              $stmt->bind_param("ssss", $nombre, $email, $asunto, $mensaje);

              if ($stmt->execute()) {
                  $success = "Mensaje enviado correctamente.";
              } else {
                  throw new Exception("Error al enviar el mensaje: " . $stmt->error);
              }

              $stmt->close();
              $conn->close();
          } catch (Exception $e) {
              $error = $e->getMessage();
          }
      }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hotel Miranda | Contacto</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Hotel Miranda - Contacto">
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
<body>

<?php include("./componentes/header.php"); ?>

<section class="page-title bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <h1 class="display-4 text-primary mb-3">Contáctanos</h1>
          <div class="divider mx-auto mb-4"></div>
          <p class="lead text-muted mt-3">Estamos aquí para ayudarte. Envíanos tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
        </div>
      </div>
    </div>
</section>

<section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="contact-info">
            <h3>Información de Contacto</h3>
            <div class="contact-details mt-4">
              <div class="contact-item mb-4">
                <i class="fa fa-map-marker"></i>
                <h6>Ubicación</h6>
                <p>08915 Calle Saugusto, Barcelona, España</p>
              </div>
              <div class="contact-item mb-4">
                <i class="fa fa-phone"></i>
                <h6>Teléfono</h6>
                <p>+34 932 24 55 34</p>
              </div>
              <div class="contact-item">
                <i class="fa fa-envelope"></i>
                <h6>Email</h6>
                <p>info@hotelvac.com</p>
              </div>
            </div>
          </div>
        </div>
      
        <div class="col-md-6">
          <?php if (!empty($error)) { ?>
              <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
          <?php } elseif (!empty($success)) { ?>
              <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
          <?php } ?>

          <form action="contact.php" method="POST" class="contact-form">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="asunto">Asunto</label>
              <input type="text" class="form-control" id="asunto" name="asunto" required>
            </div>

            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
          </form>
        </div>
      </div>
    </div>
</section>

<?php include("./componentes/footer.php"); ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
