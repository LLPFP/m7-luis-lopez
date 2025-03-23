<?php 

include_once("./config/config.php");
session_start();


//paso 2. hacer la query con el ->que devolverá on objeto
$projectsObject = $conn->query("SELECT * FROM PROJECTS");

//paso 3. convertir el objeto a un array para poder hacer el foreach
$projectsArray = $projectsObject->fetch_all(MYSQLI_ASSOC);
 

?>


<!DOCTYPE html>


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
        <h1 class="display-1 text-white font-weight-bold font-primary">Portfolio</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

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