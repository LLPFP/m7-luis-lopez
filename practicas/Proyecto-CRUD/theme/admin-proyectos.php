<?php
include_once("./config/config.php");

session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Procesar eliminación de proyecto si se solicita
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Obtener la imagen antes de eliminar
    $result = $conn->query("SELECT thumbnail FROM PROJECTS WHERE id = $id");
    if($result && $row = $result->fetch_assoc()) {
        if($row['thumbnail'] && file_exists('uploads/projects/' . $row['thumbnail'])) {
            unlink('uploads/projects/' . $row['thumbnail']);
        }
    }
    
    // Eliminar el proyecto
    $delete_project = $conn->query("DELETE FROM PROJECTS WHERE id = $id");
    
    if ($delete_project) {
        $_SESSION['success_message'] = "Proyecto eliminado correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al eliminar el proyecto: " . $conn->error;
    }
    
    header("Location: admin-proyectos.php");
    exit();
}

// Procesar actualización de proyecto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    
    // Modificar esta parte del código donde se sube la imagen
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
        $imagen_nombre = time() . '_' . $_FILES['thumbnail']['name'];
        $imagen_temporal = $_FILES['thumbnail']['tmp_name'];
        $ruta_destino = 'uploads/projects/' . $imagen_nombre;
        
        // Obtener la imagen anterior
        $result = $conn->query("SELECT thumbnail FROM PROJECTS WHERE id = $id");
        if($result && $row = $result->fetch_assoc()) {
            if($row['thumbnail'] && file_exists($row['thumbnail'])) {
                unlink($row['thumbnail']);
            }
        }
        
        if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
            // Guardar la ruta completa en la base de datos
            $update_query = "UPDATE PROJECTS SET title = ?, url = ?, description = ?, thumbnail = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssssi", $title, $url, $description, $ruta_destino, $id);
        } else {
            $_SESSION['error_message'] = "Error al subir la imagen.";
            header("Location: admin-proyectos.php");
            exit();
        }
    } else {
        $update_query = "UPDATE PROJECTS SET title = ?, url = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sssi", $title, $url, $description, $id);
    }    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Proyecto actualizado correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al actualizar el proyecto: " . $conn->error;
    }
    
    header("Location: admin-proyectos.php");
    exit();
}

// Obtener todos los proyectos
$proyectosObject = $conn->query("SELECT * FROM PROJECTS ORDER BY id DESC");
$proyectosArray = $proyectosObject->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>TechX - Gestión de Proyectos</title>

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
    
    .project-title {
      max-width: 300px;
      overflow: visible;
    }
    
    .project-content {
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

    .project-thumbnail {
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
        <h1 class="display-1 text-white font-weight-bold font-primary">Gestión de Proyectos</h1>
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
              <h2 class="mb-0">Proyectos Publicados</h2>
              <button class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal"><i class="ti-plus mr-2"></i>Crear Nuevo Proyecto</button>
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
            
            <?php if (count($proyectosArray) > 0): ?>
              <div class="table-responsive admin-table">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Thumbnail</th>
                      <th>Título</th>
                      <th>URL</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($proyectosArray as $proyecto): ?>
                      <tr>
                        <td><?php echo $proyecto['id']; ?></td>
                        <td>
                          <?php if($proyecto['thumbnail']): ?>
                            <img src="<?php echo $proyecto['thumbnail']; ?>" alt="Thumbnail" class="project-thumbnail">
                          <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                          <?php endif; ?>
                        </td>
                        <td class="project-title"><?php echo $proyecto['title']; ?></td>
                        <td><a href="<?php echo $proyecto['url']; ?>" target="_blank"><?php echo substr($proyecto['url'], 0, 30) . (strlen($proyecto['url']) > 30 ? '...' : ''); ?></a></td>
                        <td class="project-content"><?php echo substr($proyecto['description'], 0, 100) . '...'; ?></td>
                        <td class="action-buttons">
                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal<?php echo $proyecto['id']; ?>">
                            <i class="ti-eye"></i> Ver
                          </button>
                          <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?php echo $proyecto['id']; ?>">
                            <i class="ti-pencil"></i> Editar
                          </button>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $proyecto['id']; ?>">
                            <i class="ti-trash"></i> Eliminar
                          </button>
                        </td>
                      </tr>

                      <!-- Modal para ver el proyecto -->
                      <div class="modal fade" id="viewModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><?php echo $proyecto['title']; ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php if($proyecto['thumbnail']): ?>
                                <img src="<?php echo $proyecto['thumbnail']; ?>" alt="Thumbnail" class="project-thumbnail">
                                <?php endif; ?>
                              <p><strong>URL:</strong> <a href="<?php echo $proyecto['url']; ?>" target="_blank"><?php echo $proyecto['url']; ?></a></p>
                              <div class="content">
                                <h6>Descripción:</h6>
                                <?php echo $proyecto['description']; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal para editar el proyecto -->
                      <div class="modal fade" id="editModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Editar Proyecto</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="admin-proyectos.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $proyecto['id']; ?>">
                                <?php if($proyecto['thumbnail']): ?>
                                  <div class="form-group">
                                    <img src="<?php echo $proyecto['thumbnail']; ?>" alt="Thumbnail" class="project-thumbnail">
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                  <label>Nuevo Thumbnail</label>
                                  <input type="file" class="form-control-file" name="thumbnail" accept="image/*">
                                </div>
                                <div class="form-group">
                                  <label>Título</label>
                                  <input type="text" class="form-control" name="title" value="<?php echo $proyecto['title']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label>URL</label>
                                  <input type="url" class="form-control" name="url" value="<?php echo $proyecto['url']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label>Descripción</label>
                                  <textarea class="form-control" name="description" rows="10" required><?php echo $proyecto['description']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal de confirmación para eliminar -->
                      <div class="modal fade" id="deleteModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Confirmar eliminación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que deseas eliminar el proyecto "<strong><?php echo $proyecto['title']; ?></strong>"?</p>
                              <p class="text-danger">Esta acción no se puede deshacer.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="admin-proyectos.php?delete=<?php echo $proyecto['id']; ?>" class="btn btn-danger">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-info">
                No hay proyectos publicados. ¡Crea tu primer proyecto!
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal para crear nuevo proyecto -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Crear Nuevo Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="crear_project.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label>Thumbnail</label>
                <input type="file" class="form-control-file" name="thumbnail" accept="image/*" required>
              </div>
              <div class="form-group">
                <label>Título</label>
                <input type="text" class="form-control" name="title" required>
              </div>
              <div class="form-group">
                <label>URL</label>
                <input type="url" class="form-control" name="url" required>
              </div>
              <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" name="description" rows="10" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Crear Proyecto</button>
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
