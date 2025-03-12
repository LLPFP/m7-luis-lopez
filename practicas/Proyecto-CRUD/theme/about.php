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
  <title>Agen | Bootstrap Agency Template</title>

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
        <h1 class="display-1 text-white font-weight-bold font-primary">About Agen</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- progressbar -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0">
        <img src="images/about/about-us.png" alt="about" class="img-fluid">
      </div>
      <div class="col-md-6 col-lg-5">
        <div class="progress-block">
          <h6 class="text-uppercase">HTML5 Expertise</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="85">
              <span class="skill-number text-dark font-weight-bold"><span class="count">85</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">jQuery Expertise</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="95">
              <span class="skill-number text-dark font-weight-bold"><span class="count">95</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">PHP Expertise</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="79">
              <span class="skill-number text-dark font-weight-bold"><span class="count">79</span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">User Interface Expertise</h6>
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

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Our Team</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row no-gutters">
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-1.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Sara Adams</a></h4>
            <i>Designer</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-2.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Tom Bills</a></h4>
            <i>Developer</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-3.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center position-relative zindex-1">
            <h4><a class="text-dark" href="team-single.php">Anna Walle</a></h4>
            <i>Manager</i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card hover-shadow">
          <img src="images/team/member-4.jpg" alt="team-member" class="card-img-top">
          <div class="card-body text-center">
            <h4>Devid Json</h4>
            <i>CEO</i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /team -->

<!-- testimonial-slider -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="text-white mb-5">Our Client Testimonails</h2>
      </div>
    </div>
    <div class="row bg-contain" data-background="images/banner/brush.png">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div id="slider" class="ui-card-slider bg-contain">
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="images/testimonial/user-1.jpg" alt="user-1" class="img-fluid rounded-circle mb-4">
                <h4 class="text-secondary">Mellissa Christine</h4>
                <p>“Great work I got a lot more than what I ordered, they are very legítimas and catchy. I went for one
                  of them for my brand but is always better to have more options.”</p>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="images/testimonial/user-1.jpg" alt="user-1" class="img-fluid rounded-circle mb-4">
                <h4 class="text-secondary">Mellissa Christine</h4>
                <p>“Great work I got a lot more than what I ordered, they are very legítimas and catchy. I went for one
                  of them for my brand but is always better to have more options.”</p>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="images/testimonial/user-1.jpg" alt="user-1" class="img-fluid rounded-circle mb-4">
                <h4 class="text-secondary">Mellissa Christine</h4>
                <p>“Great work I got a lot more than what I ordered, they are very legítimas and catchy. I went for one
                  of them for my brand but is always better to have more options.”</p>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="images/testimonial/user-1.jpg" alt="user-1" class="img-fluid rounded-circle mb-4">
                <h4 class="text-secondary">Mellissa Christine</h4>
                <p>“Great work I got a lot more than what I ordered, they are very legítimas and catchy. I went for one
                  of them for my brand but is always better to have more options.”</p>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">
                <img src="images/testimonial/user-1.jpg" alt="user-1" class="img-fluid rounded-circle mb-4">
                <h4 class="text-secondary">Mellissa Christine</h4>
                <p>“Great work I got a lot more than what I ordered, they are very legítimas and catchy. I went for one
                  of them for my brand but is always better to have more options.”</p>
              </div>
            </div>
          </div>
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