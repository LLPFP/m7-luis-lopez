<?php
include_once("./config/config.php");
session_start();


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Hotel - Habitaciones Disponibles</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body class="body-wrapper">
<?php include("./componentes/header.php");
?>
<section class="dashboard section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Panel de Administración</h2>
            </div>
        </div>
        
        <div class="row">
            <!-- Card Clientes -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class="fa fa-users fa-3x text-primary mb-3"></i>
                        <h4 class="card-title">Clientes</h4>
                        <p class="card-text">Gestionar usuarios y perfiles</p>
                        <a href="admin-clientes.php" class="btn btn-primary rounded-pill">
                            <i class="fa fa-arrow-right"></i> Acceder
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Habitaciones -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class="fa fa-bed fa-3x text-success mb-3"></i>
                        <h4 class="card-title">Habitaciones</h4>
                        <p class="card-text">Administrar habitaciones</p>
                        <a href="admin-habitaciones.php" class="btn btn-success rounded-pill">
                            <i class="fa fa-arrow-right"></i> Acceder
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Reservas -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class="fa fa-calendar fa-3x text-warning mb-3"></i>
                        <h4 class="card-title">Reservas</h4>
                        <p class="card-text">Gestionar reservaciones</p>
                        <a href="admin-reservas.php" class="btn btn-warning rounded-pill">
                            <i class="fa fa-arrow-right"></i> Acceder
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Correos -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class="fa fa-envelope fa-3x text-info mb-3"></i>
                        <h4 class="card-title">Correos</h4>
                        <p class="card-text">Gestionar mensajes</p>
                        <a href="admin-correos.php" class="btn btn-info rounded-pill">
                            <i class="fa fa-arrow-right"></i> Acceder
                        </a>
                    </div>
                </div>
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