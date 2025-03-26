<?php
session_start();
require_once("./config/config.php");

// Get all available rooms
$sql = "SELECT * FROM habitaciones WHERE disponible >= 1";
$resultado = $conn->query($sql);
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

<?php include("./componentes/header.php"); ?>

<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; color: #2c3e50; font-size: 3rem;">Habitaciones Disponibles</h2>
        <div class="text-center mb-5">
          <div class="divider" style="width: 80px; height: 3px; background: #3498db; margin: 0 auto;"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php while($habitacion = $resultado->fetch_assoc()): ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow-sm hover-zoom" style="border-radius: 15px; transition: transform 0.3s ease;">
          <a href="single.php?id=<?php echo $habitacion['id']; ?>" style="text-decoration: none; color: inherit;">
            <div class="overflow-hidden" style="border-radius: 15px 15px 0 0;">
              <img class="card-img-top" src="<?php echo htmlspecialchars($habitacion['imagen']); ?>" alt="<?php echo htmlspecialchars($habitacion['tipo']); ?>" style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
            </div>
            <div class="card-body text-center">
              <h4 class="card-title" style="font-family: 'Playfair Display', serif; color: #2c3e50;"><?php echo htmlspecialchars($habitacion['tipo']); ?></h4>
              <p class="card-text" style="color: #3498db; font-size: 1.25rem; font-weight: 500;">$<?php echo number_format($habitacion['precio'], 2); ?> <span style="font-size: 0.9rem; color: #7f8c8d;">por noche</span></p>
              <div class="btn btn-primary" style="background-color: #3498db; border: none; padding: 10px 25px; border-radius: 25px; transition: all 0.3s ease;">Ver detalles</div>
            </div>
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php include("./componentes/footer.php"); ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<style>
  .hover-zoom:hover {
    transform: translateY(-5px);
  }
  .hover-zoom:hover img {
    transform: scale(1.05);
  }
  .section.bg-gray {
    background-color: #f8f9fa;
    padding: 80px 0;
  }
</style>

</body>
</html>
