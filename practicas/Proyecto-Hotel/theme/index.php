<?php session_start();

include_once("./config/config.php");

// Consulta SQL para obtener las habitaciones
$sql = "SELECT * FROM habitaciones";
$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="en">
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


<?php 
	include("./componentes/header.php")
?>

<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Bienvenido a HotelVac</h1>
					<p>Disfruta de una experiencia única de hospedaje <br> con las mejores instalaciones y servicio de primera clase</p>
				</div>
				<!-- Advance Search -->
				
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===========================================
=            Popular deals section            =
============================================-->
	<section class="popular-deals section bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center mb-5">
						<h2 class="display-4 fw-bold">Nuestras Habitaciones</h2>
						<p class="lead text-muted">Descubre nuestras cómodas y elegantes habitaciones</p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- offer 01 -->
				<div class="col-lg-12">
					<div class="trending-ads-slide">
				
						<?php
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
						?>
						<div class="col-sm-12 col-lg-4">
							<div class="product-item bg-white rounded shadow-sm hover-shadow transition">
								<div class="card border-0">
									<div class="thumb-content position-relative">
										<div class="price badge bg-primary position-absolute top-0 end-0 m-3 py-2 px-3">
											$<?php echo number_format($row['precio'], 2); ?>
										</div>
										<a href="single.php?id=<?php echo $row['id']; ?>">
											<img class="card-img-top img-fluid rounded-top" src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['tipo']; ?>">
										</a>
									</div>
									<div class="card-body p-4">
										<h4 class="card-title h5 mb-3">
											<a href="single.php?id=<?php echo $row['id']; ?>" class="text-dark text-decoration-none"><?php echo $row['tipo']; ?></a>
										</h4>
										<ul class="list-inline product-meta mb-3">
											<li class="list-inline-item">
												<a href="#" class="text-muted"><i class="fa fa-bed me-2"></i>Habitación</a>
											</li>
											<li class="list-inline-item">
												<a href="#" class="<?php echo ($row['disponible'] >= 1) ? 'text-success' : 'text-danger'; ?>">
													<i class="fa fa-check-circle me-2"></i>
													<?php echo ($row['disponible'] >= 1) ? 'Disponible' : 'No disponible'; ?>
												</a>
											</li>
										</ul>
										
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						}
						?>
					
					</div>
				</div>
			</div>
		</div>
	</section>

<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>Servicios del Hotel</h2>
					<p>Descubre todos los servicios y comodidades que ofrecemos para tu estancia</p>
				</div>
				<div class="row">
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-bed icon-bg-1"></i>
								<h4>Habitaciones</h4>
							</div>
							<ul class="category-list">
								<li><a href="category.php">Individual <span>15</span></a></li>
								<li><a href="category.php">Doble <span>25</span></a></li>
								<li><a href="category.php">Suite <span>10</span></a></li>
								<li><a href="category.php">Familiar <span>8</span></a></li>
							</ul>
						</div>
					</div>
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-cutlery icon-bg-2"></i>
								<h4>Restaurantes</h4>
							</div>
							<ul class="category-list">
								<li><a href="category.php">Buffet <span>3</span></a></li>
								<li><a href="category.php">A la carta <span>2</span></a></li>
								<li><a href="category.php">Bar <span>1</span></a></li>
								<li><a href="category.php">Cafetería <span>1</span></a></li>
							</ul>
						</div>
					</div>
					<!-- Category list -->
					
					
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-car icon-bg-5"></i>
								<h4>Transporte</h4>
							</div>
							<ul class="category-list">
								<li><a href="category.php">Aeropuerto <span>2</span></a></li>
								<li><a href="category.php">Parking <span>1</span></a></li>
								<li><a href="category.php">Alquiler coches <span>1</span></a></li>
								<li><a href="category.php">Taxi <span>1</span></a></li>
							</ul>
						</div>
					</div>
					<!-- Category list -->
					
					
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-wifi icon-bg-8"></i>
								<h4>Conectividad</h4>
							</div>
							<ul class="category-list">
								<li><a href="category.php">WiFi <span>Gratis</span></a></li>
								<li><a href="category.php">Business Center <span>1</span></a></li>
								<li><a href="category.php">TV Cable <span>150</span></a></li>
								<li><a href="category.php">Teléfono <span>24h</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	<!-- Container End -->


<!--====================================
=            Call to Action            =
=====================================-->

<section class="call-to-action overly bg-3 section-sm">
	<!-- Container Start -->
	<div class="container">
		<div class="row justify-content-md-center text-center">
			<div class="col-md-8">
				<div class="content-holder">
					<h2>Empieza hoy a disfrutar de una experiencia única en nuestro hotel</h2>
					<ul class="list-inline mt-30">
						<li class="list-inline-item"><a class="btn btn-main" href="rooms.php">Reservar ahora</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
<!--============================
=            Footer            =
=============================-->

<?php
	include('./componentes/footer.php');
?>

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
