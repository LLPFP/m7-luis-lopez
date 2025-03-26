<?php session_start();

include_once("./config/config.php");
?>


<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

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

include ("./componentes/header.php");

?>
<!--================================
=            Page Title            =
=================================-->
<section class="page-title bg-primary py-5">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">
				<!-- Title text -->
				<h3 class="text-white font-weight-bold mb-3">Sobre HotelVac</h3>
				<div class="border-top border-white w-25 mx-auto"></div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="about-img position-relative">
          <img src="images/about/about.jpg" class="img-fluid w-100 rounded-lg shadow-lg" alt="Hotel Exterior">
          <div class="about-content mt-5 px-5">
            <div class="section-title text-center mb-5">
              <h3 class="font-weight-bold text-black display-4">Bienvenidos a HotelVac</h3>
              <div class="border-bottom border-primary w-25 mx-auto mb-4"></div>
            </div>
            <p class="lead text-black px-4">HotelVac es un lujoso establecimiento ubicado en el corazón de la ciudad, diseñado para ofrecer una experiencia única de alojamiento. Nuestras instalaciones combinan el confort moderno con un servicio excepcional para garantizar una estancia inolvidable.</p>
            
            <div class="section-title text-center my-5">
              <h3 class="font-weight-bold text-black display-4">Nuestros Servicios</h3>
              <div class="border-bottom border-primary w-25 mx-auto mb-4"></div>
            </div>
            <p class="lead text-black px-4">Ofrecemos una amplia gama de servicios premium que incluyen restaurante gourmet, spa de lujo, centro de fitness 24/7, piscina climatizada y salones para eventos. Nuestras habitaciones están equipadas con la última tecnología y comodidades para garantizar el máximo confort. El compromiso con la excelencia y la atención personalizada son los pilares fundamentales de nuestra filosofía de servicio.</p>
            
            <div class="section-title text-center my-5">
              <h3 class="font-weight-bold text-black display-4">Nuestra Historia</h3>
              <div class="border-bottom border-primary w-25 mx-auto mb-4"></div>
            </div>
            <p class="lead text-black px-4">Fundado en 1995, HotelVac ha sido sinónimo de excelencia hotelera durante más de 25 años. Comenzamos con la visión de crear un espacio que combinara el lujo con la hospitalidad auténtica, y hoy somos reconocidos como uno de los hoteles más prestigiosos de la región.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


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


<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
        <div class="counter-content text-center bg-light py-4 rounded">
          <i class="fa fa-bed d-block"></i>
          <span class="counter my-2 d-block" data-count="150">0</span>
          <h5>Habitaciones</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
        <div class="counter-content text-center bg-light py-4 rounded">
          <i class="fa fa-star-o d-block"></i>
          <span class="counter my-2 d-block" data-count="5">0</span>
          <h5>Estrellas</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
        <div class="counter-content text-center bg-light py-4 rounded">
          <i class="fa fa-users d-block"></i>
          <span class="counter my-2 d-block" data-count="50000">0</span>
          <h5>Huéspedes al Año</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
        <div class="counter-content text-center bg-light py-4 rounded">
          <i class="fa fa-smile-o d-block"></i>
          <span class="counter my-2 d-block" data-count="98">0</span>
          <h5>% Satisfacción</h5>
        </div>
      </div>
    </div>
  </div>
</section>


<!--============================
=            Footer            =
=============================-->

<?php 

include ("./componentes/footer.php");

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