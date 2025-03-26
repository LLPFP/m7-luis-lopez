<?php
include_once("./config/config.php");

session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Procesar eliminación de noticia si se solicita
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Obtener la imagen antes de eliminar
    $result = $conn->query("SELECT thumbnail FROM NEWS WHERE id = $id");
    if($result && $row = $result->fetch_assoc()) {
        if($row['thumbnail'] && file_exists('uploads/news/' . $row['thumbnail'])) {
            unlink('uploads/news/' . $row['thumbnail']);
        }
    }
    
    // Primero eliminar los comentarios asociados a la noticia
    $delete_comments = $conn->query("DELETE FROM COMMENTS WHERE new_id = $id");
    
    // Luego eliminar la noticia
    $delete_news = $conn->query("DELETE FROM NEWS WHERE id = $id");
    
    if ($delete_news) {
        $_SESSION['success_message'] = "Noticia eliminada correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al eliminar la noticia: " . $conn->error;
    }
    
    header("Location: admin-noticias.php");
    exit();
}

// Procesar actualización de noticia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Manejar la subida de imagen si existe
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
        $imagen_nombre = time() . '_' . $_FILES['thumbnail']['name'];
        $imagen_temporal = $_FILES['thumbnail']['tmp_name'];
        $ruta_destino = 'uploads/news/' . $imagen_nombre;
        
        // Obtener la imagen anterior
        $result = $conn->query("SELECT thumbnail FROM NEWS WHERE id = $id");
        if($result && $row = $result->fetch_assoc()) {
            if($row['thumbnail'] && file_exists('uploads/news/' . $row['thumbnail'])) {
                unlink('uploads/news/' . $row['thumbnail']);
            }
        }
        
        if (move_uploaded_file($imagen_temporal, $ruta_destino)) {



            $update_query = "UPDATE NEWS SET title = '$title', description = '$description', thumbnail = '$imagen_nombre' WHERE id = $id";
            $stmt = $conn->query($update_query);
        } else {
            $_SESSION['error_message'] = "Error al subir la imagen.";
            header("Location: admin-noticias.php");
            exit();
        }
    } else {



        $update_query = "UPDATE NEWS SET title = '$title', description = '$description' WHERE id = $id";
        $stmt = $conn->query($update_query);
    }    

    if ($stmt) {
        $_SESSION['success_message'] = "Noticia actualizada correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al actualizar la noticia: " . $conn->error;
    }
    
    header("Location: admin-noticias.php");
    exit();
}

// Obtener todas las noticias
$noticiasObject = $conn->query("SELECT * FROM NEWS ORDER BY new_data DESC");
$noticiasArray = $noticiasObject->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>TechX - Gestión de Noticias</title>

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
    .admin-table {
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      border-radius: 10px;
      overflow: hidden;
    }
    
    .admin-table th {
      background-color: #f8f9fa;
    }
    
    .action-buttons .btn {
      margin-right: 5px;
    }
    
    .news-title {
      max-width: 300px;
      overflow: visible;
    }
    
    .news-content {
      max-width: 400px;
      overflow: visible;
    }

    .modal-lg {
      max-width: 80%;
    }

    .modal-body {
      max-height: 80vh;
      overflow-y: auto;
    }

    .news-thumbnail {
      max-width: 200px;
      height: auto;
      margin-bottom: 15px;
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
        <h1 class="display-1 text-white font-weight-bold font-primary">Gestión de Noticias</h1>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="mb-0">Noticias Publicadas</h2>
              <button class="btn btn-primary" data-toggle="modal" data-target="#createNewsModal"><i class="ti-plus mr-2"></i>Crear Nueva Noticia</button>
            </div>
            
            <?php if (isset($_SESSION['success_message'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                  echo $_SESSION['success_message']; 
                  unset($_SESSION['success_message']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error_message'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                  echo $_SESSION['error_message']; 
                  unset($_SESSION['error_message']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            <?php endif; ?>
            
            <?php if (count($noticiasArray) > 0): ?>
              <div class="table-responsive admin-table">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Thumbnail</th>
                      <th>Título</th>
                      <th>Contenido</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($noticiasArray as $noticia): ?>
                      <tr>
                        <td><?php echo $noticia['id']; ?></td>
                        <td>
                          <?php if($noticia['thumbnail']): ?>
                            <img src="uploads/news/<?php echo $noticia['thumbnail']; ?>" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                          <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                          <?php endif; ?>
                        </td>
                        <td class="news-title"><?php echo $noticia['title']; ?></td>
                        <td class="news-content"><?php echo substr($noticia['description'], 0, 100) . '...'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($noticia['new_data'])); ?></td>
                        <td class="action-buttons">
                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal<?php echo $noticia['id']; ?>">
                            <i class="ti-eye"></i> Ver
                          </button>
                          <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?php echo $noticia['id']; ?>">
                            <i class="ti-pencil"></i> Editar
                          </button>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $noticia['id']; ?>">
                            <i class="ti-trash"></i> Eliminar
                          </button>
                        </td>
                      </tr>

                      <!-- Modal para ver la noticia -->
                      <div class="modal fade" id="viewModal<?php echo $noticia['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><?php echo $noticia['title']; ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php if($noticia['thumbnail']): ?>
                                <img src="uploads/news/<?php echo $noticia['thumbnail']; ?>" alt="Thumbnail" class="news-thumbnail">
                              <?php endif; ?>
                              <p class="text-muted"><?php echo date('d/m/Y', strtotime($noticia['new_data'])); ?></p>
                              <div class="content">
                                <?php echo $noticia['description']; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal para editar la noticia -->
                      <div class="modal fade" id="editModal<?php echo $noticia['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Editar Noticia</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="admin-noticias.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">
                                <?php if($noticia['thumbnail']): ?>
                                  <div class="form-group">
                                    <label>Thumbnail actual</label>
                                    <img src="uploads/news/<?php echo $noticia['thumbnail']; ?>" alt="Thumbnail" class="news-thumbnail d-block">
                                  </div>
                                <?php endif; ?>
                                <div class="form-group">
                                  <label>Nuevo Thumbnail</label>
                                  <input type="file" class="form-control-file" name="thumbnail" accept="image/*">
                                </div>
                                <div class="form-group">
                                  <label>Título</label>
                                  <input type="text" class="form-control" name="title" value="<?php echo $noticia['title']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label>Contenido</label>
                                  <textarea class="form-control" name="description" rows="10" required><?php echo $noticia['description']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal de confirmación para eliminar -->
                      <div class="modal fade" id="deleteModal<?php echo $noticia['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Confirmar eliminación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que deseas eliminar la noticia "<strong><?php echo $noticia['title']; ?></strong>"?</p>
                              <p class="text-danger">Esta acción también eliminará todos los comentarios asociados a esta noticia y no se puede deshacer.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="admin-noticias.php?delete=<?php echo $noticia['id']; ?>" class="btn btn-danger">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </div>




                    <?php endforeach; ?>   </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-info">
                No hay noticias publicadas. ¡Crea tu primera noticia!
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal para crear nueva noticia -->
    <div class="modal fade" id="createNewsModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Crear Nueva Noticia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="create_news.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label>Thumbnail</label>
                <input type="file" class="form-control-file" name="thumbnail" accept="image/*" required>
              </div>
              <div class="form-group">
                <label>Título</label>
                <input type="text" class="form-control" name="title" required>
              </div>
              <div class="form-group">
                <label>Contenido</label>
                <textarea class="form-control" name="description" rows="10" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Crear Noticia</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-center">
      <a href="admin.php" class="btn btn-secondary"><i class="ti-arrow-left mr-2"></i>Volver al Panel de Administración</a>
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

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>
