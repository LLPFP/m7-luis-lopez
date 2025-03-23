<?php 
include_once("./config/config.php");


//paso 2. hacer la query con el ->que devolverá on objeto
$testomonialsObject = $conn->query("SELECT * FROM TESTIMONIALS");
$testimonialsArray = $testomonialsObject->fetch_all(MYSQLI_ASSOC);

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
<section class="page-title bg-cover" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Quienes somos</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- about -->
<section class="section-lg position-relative bg-cover" data-background="images/backgrounds/about-bg.jpg">
  <img src="images/backgrounds/about-bg-overlay.png" alt="overlay" class="overlay-image img-fluid">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6 col-md-8 col-sm-7 col-8">
        <h2 class="text-white mb-4">Quiénes Somos</h2>
        <p class="text-light mb-4">TechX es una empresa líder en tecnología enfocada en desarrollar soluciones innovadoras para empresas y particulares. Nuestro equipo está formado por expertos en software, hardware e inteligencia artificial, comprometidos en ofrecer productos y servicios de vanguardia. Creemos en la transformación digital como motor de crecimiento y en la tecnología como herramienta para mejorar la vida de las personas.</p>
        <a href="about.php" class="btn btn-primary">Leer más</a>
      </div>
      <div class="col-md-2 col-sm-4 col-4 text-right align-self-end">
        <a class="venobox" data-autoplay="true" data-vbtype="video"
          href="https://www.youtube.com/watch?v=jrkvirglgaQ"><i
            class="text-center icon-sm icon-box rounded-circle text-white bg-gradient-primary d-block ti-control-play"></i></a>
      </div>
    </div>
  </div>
</section>
<!-- /about -->


<!-- progressbar -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0">
        <img src="images/about/about-us.png" alt="about" class="img-fluid">
      </div>
      <div class="col-md-6 col-lg-5">
        <div class="progress-block">
          <h6 class="text-uppercase">Experiencia en HTML5</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="85">
              <span class="skill-number text-dark font-weight-bold"><span class="count">85</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Experiencia en jQuery</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="95">
              <span class="skill-number text-dark font-weight-bold"><span class="count">95</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Experiencia en PHP</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="79">
              <span class="skill-number text-dark font-weight-bold"><span class="count">79</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Experiencia en Interfaz de Usuario</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="90">
              <span class="skill-number text-dark font-weight-bold"><span class="count">90</span>%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /progressbar -->
<!-- video -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="overlay-secondary video-player">
          <img src="images/about/video-thumb.jpg" alt="video-thumb" class="img-fluid w-100">
          <a class="play-icon">
            <i class="text-center icon-sm icon-box-sm rounded-circle text-white bg-gradient-primary d-block ti-control-play content-center"
              data-video="https://www.youtube.com/embed/jrkvirglgaQ?autoplay=1">
              <div class="ripple"></div>
            </i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /video -->

<section class="section pb-0 mt-5">
</section>
<!-- testimonial-slider -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="text-white mb-5">Opinión de nuestros clientes</h2>
      </div>
    </div>
    <div class="row bg-contain" data-background="images/banner/brush.png">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div id="slider" class="ui-card-slider bg-contain">
          <?php foreach($testimonialsArray as $testimonial): ?>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="<?php echo $testimonial['photo']; ?>" alt="<?php echo $testimonial['name']; ?>" class="img-fluid rounded-circle mb-4" style="width: 100px; height: 100px; object-fit: cover;">
                <h4 class="text-secondary"><?php echo $testimonial['name'] . ' ' . $testimonial['surname'];  ?></h4>
                <p>"<?php echo $testimonial['description']; ?>"</p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /testimonial-slider -->


<!-- call to action -->
<section class="section">
  <div class="container section-sm overlay-secondary-half bg-cover" data-background="images/backgrounds/cta-bg.jpg">
  <div class="row">
    <div class="col-lg-8 offset-lg-1">
      <h2 class="text-gradient-primary">Let's Start With Us!</h2>
      <p class="h4 font-weight-bold text-white mb-4">Lorem ipsum dolor sit amet, magna habemus ius ad</p>
      <a href="contact.php" class="btn btn-lg btn-primary">Let’s talk</a>
    </div>
  </div>
</div>
</section>
<!-- /call to action -->

<!-- footer -->

<?php 
  include("./componentes/footer.php")
?>
<!-- /footer -->

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