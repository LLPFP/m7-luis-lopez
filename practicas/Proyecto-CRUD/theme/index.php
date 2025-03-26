<?php 
include_once("./config/config.php");
session_start();

//paso 2. hacer la query con el ->que devolverá on objeto
$projectsObject = $conn->query("SELECT * FROM PROJECTS");




//paso 2. hacer la query con el ->que devolverá on objeto
$noticiasObject = $conn->query("SELECT * FROM NEWS ORDER BY new_data DESC");
$noticiasArray = $noticiasObject->fetch_all(MYSQLI_ASSOC);


//paso 3. convertir el objeto a un array para poder hacer el foreach
$projectsArray = $projectsObject->fetch_all(MYSQLI_ASSOC);
 



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
  
  <!-- theme meta -->
  <meta name="theme-name" content="agen" />
  
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

<!-- banner -->
<section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
  data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">TechX</h1>
      </div>
    </div>
  </div>
</section>
<!-- /banner -->


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




<!-- project -->
<section>
  <div class="container-fluid px-0">
    <div class="row no-gutters shuffle-wrapper">
      <?php foreach($projectsArray as $project): ?>
      <div class="col-lg-4 col-md-6 shuffle-item">
        <div class="project-item">
          <img src="<?php echo $project['thumbnail']; ?>" alt="<?php echo $project['title']; ?>" class="img-fluid w-100">
          <div class="project-hover bg-secondary px-4 py-3">
            <a href="project-single.php?id=<?php echo $project['id']; ?>" class="text-white h4"><?php echo $project['title']; ?></a>
            <a href="project-single.php?id=<?php echo $project['id']; ?>"><i class="ti-link icon-xs text-white"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /project -->


<!-- precios -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Nuestra Tabla de Precios Inteligente</h2>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card bottom-shape bg-secondary pt-4 pb-5">
          <div class="card-body text-center">
            <h4 class="text-white">Básico</h4>
            <p class="text-light mb-4">Para pequeños negocios</p>
            <p class="text-white mb-4">$ <span class="display-3 font-weight-bold vertical-align-middle">29</span></p>
            <ul class="list-unstyled mb-5">
              <li class="text-white mb-3">Sitio Web Responsive</li>
              <li class="text-white mb-3">3 Páginas Personalizadas</li>
              <li class="text-white mb-3">Formulario de Contacto</li>
              <li class="text-white mb-3">Soporte por Email</li>
              <li class="text-white mb-3">SEO Básico</li>
              <li class="text-white mb-3">Actualización Mensual</li>
            </ul>
            <a href="#" class="btn btn-outline-light">Empezar Ahora</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card bottom-shape bg-secondary pt-4 pb-5">
          <div class="card-body text-center">
            <h4 class="text-white">Profesional</h4>
            <p class="text-light mb-4">Para empresas en crecimiento</p>
            <p class="text-white mb-4">$ <span class="display-3 font-weight-bold vertical-align-middle">79</span></p>
            <ul class="list-unstyled mb-5">
              <li class="text-white mb-3">Sitio Web Premium</li>
              <li class="text-white mb-3">10 Páginas Personalizadas</li>
              <li class="text-white mb-3">E-Commerce Básico</li>
              <li class="text-white mb-3">Soporte 24/5</li>
              <li class="text-white mb-3">SEO Avanzado</li>
              <li class="text-white mb-3">Actualizaciones Semanales</li>
            </ul>
            <a href="#" class="btn btn-outline-light">Seleccionar Plan</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card bottom-shape bg-secondary pt-4 pb-5">
          <div class="card-body text-center">
            <h4 class="text-white">Empresarial</h4>
            <p class="text-light mb-4">Solución completa para empresas</p>
            <p class="text-white mb-4">$ <span class="display-3 font-weight-bold vertical-align-middle">149</span></p>
            <ul class="list-unstyled mb-5">
              <li class="text-white mb-3">Sitio Web Personalizado</li>
              <li class="text-white mb-3">Páginas Ilimitadas</li>
              <li class="text-white mb-3">E-Commerce Avanzado</li>
              <li class="text-white mb-3">Soporte 24/7 Prioritario</li>
              <li class="text-white mb-3">SEO Premium + Marketing</li>
              <li class="text-white mb-3">Mantenimiento Continuo</li>
            </ul>
            <a href="#" class="btn btn-outline-light">Contactar Ventas</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /precios -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <?php 
      $count = 0;
      foreach($noticiasArray as $noticia): 
      if($count < 3):
      ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <article class="card">
        <img src="./uploads/news/<?php echo $noticia['thumbnail']; ?>" alt="<?php echo $noticia['title']; ?>" class="card-img-top mb-2">
        <div class="card-body p-0">
            <time><?php echo date('F j, Y', strtotime($noticia['new_data'])); ?></time>
            <a href="blog-single.php?id=<?php echo $noticia['id']; ?>" class="h4 card-title d-block my-3 text-dark hover-text-underline"><?php echo $noticia['title']; ?></a>
            <a href="blog-single.php?id=<?php echo $noticia['id']; ?>" class="btn btn-transparent">Leer más</a>
          </div>
        </article>
      </div>
      <?php
      $count++;
      endif;
      endforeach; 
      ?>
     </div>
  </div>
</section>
<!-- /blog -->

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
