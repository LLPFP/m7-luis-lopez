<?php	
include_once("./config/config.php");

session_start();

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
  include("./componentes/header.php")
?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Servicios</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->


<!-- service -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2 class="section-title">Nuestros servicios</h2>
        <p class="lead">En TechX ofrecemos desarrollo de software, ciberseguridad, inteligencia artificial, computación en la nube, consultoría tecnológica, IoT y desarrollo de hardware para impulsar la transformación digital.</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card hover-bg-secondary shadow py-4 active">
          <div class="card-body text-center">
            <div class="position-relative">
              <i
                class="icon-lg icon-box bg-gradient-primary rounded-circle ti-server mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-server"></i>
            </div>
            <h4 class="mb-4">Desarrollo de Software</h4>
            <p>Creamos soluciones de software, aplicaciones web y móviles utilizando las últimas tecnologías</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i
                class="icon-lg icon-box bg-gradient-primary rounded-circle ti-shield mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-shield"></i>
            </div>
            <h4 class="mb-4">Ciberseguridad</h4>
            <p>Protegemos su infraestructura digital con soluciones avanzadas de seguridad y prevención de amenazas</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card hover-bg-secondary shadow py-4">
          <div class="card-body text-center">
            <div class="position-relative">
              <i
                class="icon-lg icon-box bg-gradient-primary rounded-circle ti-cloud mb-5 d-inline-block text-white"></i>
              <i class="icon-lg icon-watermark text-white ti-cloud"></i>
            </div>
            <h4 class="mb-4">Cloud Computing</h4>
            <p>Implementamos y gestionamos infraestructuras cloud para optimizar sus operaciones empresariales</p>
          </div>
        </div>
      </div>
    </div>
  </div></section>
<!-- /service -->

<!-- feature -->
<section class="section bg-secondary position-relative">
  <div class="bg-image overlay-secondary">
    <img src="images/feature.jpg" alt="bg-image">
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="row align-items-center">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="images/feature.jpg" alt="feature-image" class="img-fluid">
          </div>
          <div class="col-lg-7 offset-lg-1">
            <div class="row">
              <div class="col-12">
                <h2 class="text-white">Sabemos Qué Soluciones Ofrecer
                </h2>
                <div class="section-border ml-0"></div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-vector mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Experiencia de Usuario (UX) de Alta Calidad</h4>
                    <p class="text-light">El diseño centrado en el usuario es fundamental para nosotros. En TechX, nos aseguramos de que cada aplicación, plataforma o software sea fácil de usar, intuitivo y estéticamente atractivo.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-layout mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Diseño Responsivo y Adaptable</h4>
                    <p class="text-light">En un mundo donde el acceso a la tecnología se realiza desde múltiples dispositivos, es crucial que nuestras soluciones sean 100% responsivas.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-headphone-alt mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Soluciones Digitales para el Futuro</h4>
                    <p class="text-light">TechX está comprometido con el desarrollo de soluciones digitales innovadoras. Desde la creación de aplicaciones móviles hasta la implementación de sistemas basados en la nube, buscamos transformar la manera en que las empresas operan mediante el uso de tecnologías emergentes.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-ruler-pencil mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Tecnologías Avanzadas y Frameworks Modernos</h4>
                    <p class="text-light">Utilizamos las últimas tecnologías y frameworks como Bootstrap 4, React, Node.js, y más, para desarrollar soluciones robustas y escalables. Estas herramientas nos permiten ofrecer productos rápidos, eficientes y visualmente atractivos, adaptándonos rápidamente a las necesidades de nuestros clientes y manteniéndonos a la vanguardia del sector tecnológico.</p>
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
<!-- /feature -->


<?php 
  include("./componentes/footer.php")
?>

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

</body>
</html>