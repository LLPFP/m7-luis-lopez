<?php
session_start();
include_once("./config/config.php");

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Obtener estadísticas básicas para mostrar en el dashboard
// Contar usuarios
$sql_users = "SELECT COUNT(*) as total FROM USERS";
$result_users = $conn->query($sql_users);
$total_users = $result_users->fetch_assoc()['total'];

// Contar noticias
$sql_news = "SELECT COUNT(*) as total FROM NEWS";
$result_news = $conn->query($sql_news);
$total_news = $result_news->fetch_assoc()['total'];

// Contar proyectos
$sql_projects = "SELECT COUNT(*) as total FROM PROJECTS";
$result_projects = $conn->query($sql_projects);
$total_projects = $result_projects->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Panel de Administración - TechX</title>

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

  <style>
    .admin-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      height: 100%;
    }
    
    .admin-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .admin-card .card-body {
      padding: 2rem;
    }
    
    .admin-card .icon-box {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      font-size: 2rem;
      color: white;
    }
    
    .admin-card h3 {
      font-weight: 600;
      margin-bottom: 1rem;
    }
    
    .admin-card p {
      color: #6c757d;
      margin-bottom: 1.5rem;
    }
    
    .stats-card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body>

<?php include("./componentes/header.php"); ?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Panel de Administración</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<section class="section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h2 class="mb-4">Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
            <p class="lead">Desde este panel podrás gestionar todos los aspectos de tu sitio web.</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Estadísticas -->
    <div class="row mb-5">
      <div class="col-md-4 mb-4">
        <div class="card stats-card text-center">
          <div class="card-body">
            <h1 class="display-4 text-primary"><?php echo $total_users; ?></h1>
            <p class="text-muted mb-0">Usuarios registrados</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card stats-card text-center">
          <div class="card-body">
            <h1 class="display-4 text-success"><?php echo $total_news; ?></h1>
            <p class="text-muted mb-0">Noticias publicadas</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card stats-card text-center">
          <div class="card-body">
            <h1 class="display-4 text-info"><?php echo $total_projects; ?></h1>
            <p class="text-muted mb-0">Proyectos en portafolio</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Tarjetas de administración -->
    <div class="row">
      <!-- Gestión de Usuarios -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-usuarios.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-primary mx-auto">
                <i class="ti-user"></i>
              </div>
              <h3>Gestión de Usuarios</h3>
              <p>Administra los usuarios registrados, edita sus perfiles o cambia sus roles.</p>
              <span class="btn btn-outline-primary">Administrar Usuarios</span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Gestión de Noticias -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-noticias.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-success mx-auto">
                <i class="ti-write"></i>
              </div>
              <h3>Gestión de Noticias</h3>
              <p>Crea, edita o elimina noticias del blog. Gestiona los comentarios de los usuarios.</p>
              <span class="btn btn-outline-success">Administrar Noticias</span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Gestión de Proyectos -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-proyectos.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-info mx-auto">
                <i class="ti-briefcase"></i>
              </div>
              <h3>Gestión de Proyectos</h3>
              <p>Administra los proyectos del portafolio, añade nuevos trabajos o actualiza los existentes.</p>
              <span class="btn btn-outline-info">Administrar Proyectos</span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Gestión de Comentarios -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-comentarios.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-warning mx-auto">
                <i class="ti-comment-alt"></i>
              </div>
              <h3>Gestión de Comentarios</h3>
              <p>Modera los comentarios de los usuarios en noticias y proyectos.</p>
              <span class="btn btn-outline-warning">Administrar Comentarios</span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Configuración del Sitio -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-configuracion.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-secondary mx-auto">
                <i class="ti-settings"></i>
              </div>
              <h3>Configuración del Sitio</h3>
              <p>Personaliza la apariencia y configuración general del sitio web.</p>
              <span class="btn btn-outline-secondary">Configurar Sitio</span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Estadísticas y Análisis -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="admin-estadisticas.php" class="text-decoration-none">
          <div class="card admin-card h-100">
            <div class="card-body text-center">
              <div class="icon-box bg-danger mx-auto">
                <i class="ti-bar-chart"></i>
              </div>
              <h3>Estadísticas y Análisis</h3>
              <p>Visualiza estadísticas de visitas, interacciones y comportamiento de usuarios.</p>
              <span class="btn btn-outline-danger">Ver Estadísticas</span>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include("./componentes/footer.php"); ?>

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
