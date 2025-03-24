<?php
include_once("./config/config.php");

session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Procesar eliminación de comentarios si se solicita
if (isset($_POST['delete_comment']) && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $delete_sql = "DELETE FROM COMMENTS WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $comment_id);
    
    if ($stmt->execute()) {
        $message = "Comentario eliminado correctamente";
        $messageType = "success";
    } else {
        $message = "Error al eliminar el comentario: " . $conn->error;
        $messageType = "danger";
    }
}

// Obtener todos los comentarios
$sql = "SELECT c.*, u.name, u.surname, u.avatar, n.title as news_title 
        FROM COMMENTS c 
        LEFT JOIN USERS u ON c.user_id = u.id 
        LEFT JOIN NEWS n ON c.new_id = n.id 
        ORDER BY c.date DESC";
try {
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
} catch (Exception $e) {
    die("Error al obtener comentarios: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>TechX - Gestión de Comentarios</title>

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
    .comment-card {
      margin-bottom: 20px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }
    
    .comment-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .comment-header {
      display: flex;
      align-items: center;
      padding: 15px;
      background-color: #f8f9fa;
    }
    
    .comment-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }
    
    .comment-content {
      padding: 20px;
    }
    
    .comment-footer {
      padding: 15px;
      background-color: #f8f9fa;
      display: flex;
      justify-content: flex-end;
    }
    
    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
    }
    
    .status-pending {
      background-color: #ffc107;
      color: #212529;
    }
    
    .status-approved {
      background-color: #28a745;
      color: white;
    }
    
    .status-rejected {
      background-color: #dc3545;
      color: white;
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
        <h1 class="display-1 text-white font-weight-bold font-primary">Gestión de Comentarios</h1>
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
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="mb-0">Comentarios</h2>
              <a href="admin.php" class="btn btn-primary">Volver al Panel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
      <?php echo $message; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php endif; ?>
    
    <div class="row">
      <div class="col-12">
        <?php 
        if ($result && $result->num_rows > 0): 
          while($comment = $result->fetch_assoc()): 
            // Verificar que los datos necesarios existen
            $name = isset($comment['name']) ? htmlspecialchars($comment['name']) : 'Usuario Anónimo';
            $surname = isset($comment['surname']) ? htmlspecialchars($comment['surname']) : '';
            $content = isset($comment['description']) ? htmlspecialchars($comment['description']) : '';
            $status = isset($comment['status']) ? $comment['status'] : 'pending';
            $created_at = isset($comment['date']) ? $comment['date'] : date('Y-m-d H:i:s');
        ?>
            <div class="card comment-card">
              <div class="comment-header">
                <img src="<?php echo !empty($comment['avatar']) ? htmlspecialchars($comment['avatar']) : 'images/user-placeholder.jpg'; ?>" 
                     alt="Avatar" class="comment-avatar">
                <div>
                  <h5 class="mb-0"><?php echo $name . ' ' . $surname; ?></h5>
                  <small class="text-muted">
                    <?php echo date('d/m/Y H:i', strtotime($created_at)); ?>
                    <?php if (!empty($comment['news_title'])): ?>
                      - En noticia: <?php echo htmlspecialchars($comment['news_title']); ?>
                    <?php endif; ?>
                  </small>
                </div>
                <div class="ml-auto">
                  <span class="status-badge status-<?php echo $status; ?>">
                    <?php 
                      if ($status == 'pending') echo 'Pendiente';
                      elseif ($status == 'approved') echo 'Aprobado';
                      else echo 'Rechazado';
                    ?>
                  </span>
                </div>
              </div>
              <div class="comment-content">
                <p><?php echo nl2br($content); ?></p>
              </div>
              <div class="comment-footer">
                <form method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este comentario?');">
                  <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                  <button type="submit" name="delete_comment" class="btn btn-sm btn-danger">
                    <i class="ti-trash"></i> Eliminar
                  </button>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="alert alert-info">
            No hay comentarios para mostrar.
          </div>
        <?php endif; ?>
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
