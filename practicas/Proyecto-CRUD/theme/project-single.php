<?php 
include_once("./config/config.php");
session_start();

// Verificar si se proporcionó un ID de proyecto
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  // Redirigir a la página de portfolio si no se proporciona un ID válido
  header("Location: portfolio.php");
  exit();
}

$id = $_GET['id'];

// Obtener los detalles del proyecto específico
$projectQuery = $conn->query("SELECT * FROM PROJECTS WHERE id = $id");

// Verificar si el proyecto existe
if ($projectQuery->num_rows === 0) {
  // Redirigir a la página de portfolio si el proyecto no existe
  header("Location: portfolio.php");
  exit();
}

$project = $projectQuery->fetch_assoc();

// Obtener otros proyectos para mostrar como relacionados
$relatedProjectsQuery = $conn->query("SELECT * FROM PROJECTS WHERE id != $id ORDER BY RAND() LIMIT 3");
$relatedProjects = $relatedProjectsQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>TechX - <?php echo $project['title']; ?></title>

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
        <h1 class="display-1 text-white font-weight-bold font-primary"><?php echo $project['title']; ?></h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- project details -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="project-content">
          <img src="<?php echo $project['thumbnail']; ?>" alt="<?php echo $project['title']; ?>" class="img-fluid w-100 mb-5">
          <h2 class="mb-4"><?php echo $project['title']; ?></h2>
          <div class="content mb-5">
            <?php echo $project['description']; ?>
          </div>
          <div class="text-center">
            <a href="portfolio.php" class="btn btn-primary">Volver al Portfolio</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /project details -->

<!-- related projects -->
<section class="section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="section-title">Proyectos Relacionados</h2>
      </div>
      
      <?php foreach($relatedProjects as $relatedProject): ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow rounded-lg">
          <img src="<?php echo $relatedProject['thumbnail']; ?>" alt="<?php echo $relatedProject['title']; ?>" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title"><a href="project-single.php?id=<?php echo $relatedProject['id']; ?>" class="text-dark"><?php echo $relatedProject['title']; ?></a></h4>
            <p class="card-text text-muted"><?php echo substr(strip_tags($relatedProject['description']), 0, 100); ?>...</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /related projects -->

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
