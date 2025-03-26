<?php
session_start();

// Obtener datos del usuario desde la base de datos
include_once("./config/config.php");
$id_cliente = $_SESSION['id_cliente'];

// Obtener los datos del usuario
$consulta = "SELECT * FROM clientes WHERE id = ?";
if ($sentencia = $conn->prepare($consulta)) {
    $sentencia->bind_param("i", $id_cliente);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $clientes = $resultado->fetch_assoc();
} else {
    die("Error al preparar la consulta: " . $conn->error);
}

$_SESSION['imagen']= $clientes['imagen'];
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
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="body-wrapper">

<?php include("./componentes/header.php"); ?>

<section class="user-profile section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget user">
                        <div class="image d-flex justify-content-center">
                            <?php if(!empty($clientes['imagen'])): ?>
                                <img src="uploads/clientes/<?php echo htmlspecialchars($clientes['imagen']); ?>" alt="Foto de perfil">
                            <?php else: ?>
                                <img src="images/clientes/avatar.png" alt="Foto por defecto">
                            <?php endif; ?>
                        </div>
                        <h5 class="text-center"><?php echo htmlspecialchars($clientes['nombre']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="widget welcome-message">
                    <h2>Perfil de Usuario</h2>
                    <p>Información personal de la cuenta</p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget personal-info">
                            <h3 class="widget-header user">Información Personal</h3>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Nombre:</strong></div>
                                        <div class="col-sm-9"><?php echo htmlspecialchars($clientes['nombre']); ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Teléfono:</strong></div>
                                        <div class="col-sm-9"><?php echo htmlspecialchars($clientes['telefono']); ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"><strong>Email:</strong></div>
                                        <div class="col-sm-9"><?php echo htmlspecialchars($clientes['email']); ?></div>
                                    </div>
                                </div>
                            </div>
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
