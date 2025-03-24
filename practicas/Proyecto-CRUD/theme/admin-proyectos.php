<?php
session_start();
include_once("./config/config.php");

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Procesar la creación de un nuevo proyecto
if (isset($_POST['crear_proyecto'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $client = $_POST['client'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    
    // Procesar la imagen
    $target_dir = "images/projects/";
    $thumbnail = "";
    
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
        $target_file = $target_dir . $file_name;
        
        // Verificar si es una imagen real
        $check = getimagesize($_FILES['thumbnail']['tmp_name']);
        if ($check !== false) {
            // Intentar subir el archivo
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                $thumbnail = $target_file;
            }
        }
    }
    
    // Insertar el proyecto en la base de datos
    $sql = "INSERT INTO PROJECTS (title, description, client, category, date, thumbnail) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $title, $description, $client, $category, $date, $thumbnail);
    
    if ($stmt->execute()) {
        $success_message = "Proyecto creado correctamente";
    } else {
        $error_message = "Error al crear el proyecto: " . $conn->error;
    }
    $stmt->close();
}

// Procesar la actualización de un proyecto
if (isset($_POST['actualizar_proyecto'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $client = $_POST['client'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    
    // Obtener la imagen actual
    $sql_img = "SELECT thumbnail FROM PROJECTS WHERE id = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $result_img = $stmt_img->get_result();
    $current_img = $result_img->fetch_assoc()['thumbnail'];
    $stmt_img->close();
    
    // Procesar la nueva imagen si se ha subido
    $thumbnail = $current_img;
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $target_dir = "images/projects/";
        $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
        $target_file = $target_dir . $file_name;
        
        // Verificar si es una imagen real
        $check = getimagesize($_FILES['thumbnail']['tmp_name']);
        if ($check !== false) {
            // Intentar subir el archivo
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                $thumbnail = $target_file;
                
                // Eliminar la imagen anterior si existe y no es la imagen por defecto
                if (!empty($current_img) && file_exists($current_img) && $current_img != "images/project-placeholder.jpg") {
                    unlink($current_img);
                }
            }
        }
    }
    
    // Actualizar el proyecto en la base de datos
    $sql = "UPDATE PROJECTS SET title = ?, description = ?, client = ?, category = ?, date = ?, thumbnail = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $title, $description, $client, $category, $date, $thumbnail, $id);
    
    if ($stmt->execute()) {
        $success_message = "Proyecto actualizado correctamente";
    } else {
        $error_message = "Error al actualizar el proyecto: " . $conn->error;
    }
    $stmt->close();
}

// Procesar la eliminación de un proyecto
if (isset($_POST['eliminar_proyecto'])) {
    $id = $_POST['id'];
    
    // Obtener la imagen actual para eliminarla
    $sql_img = "SELECT thumbnail FROM PROJECTS WHERE id = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $result_img = $stmt_img->get_result();
    $current_img = $result_img->fetch_assoc()['thumbnail'];
    $stmt_img->close();
    
    // Eliminar el proyecto de la base de datos
    $sql = "DELETE FROM PROJECTS WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Eliminar la imagen si existe y no es la imagen por defecto
        if (!empty($current_img) && file_exists($current_img) && $current_img != "images/project-placeholder.jpg") {
            unlink($current_img);
        }
        $success_message = "Proyecto eliminado correctamente";
    } else {
        $error_message = "Error al eliminar el proyecto: " . $conn->error;
    }
    $stmt->close();
}

// Obtener todos los proyectos
$sql = "SELECT * FROM PROJECTS ORDER BY date DESC";
$result = $conn->query($sql);
$proyectos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Gestión de Proyectos - TechX</title>

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
    .project-thumbnail {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
    
    .table-responsive {
      overflow-x: auto;
    }
    
    .btn-action {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
    }
    
    .description-preview {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
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
          <div class="card-body d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Proyectos</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal">
              <i class="ti-plus mr-2"></i>Nuevo Proyecto
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <?php if(isset($success_message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $success_message; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $error_message; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php endif; ?>
    
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="bg-light">
                  <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($proyectos) > 0): ?>
                    <?php foreach($proyectos as $proyecto): ?>
                      <tr>
                        <td><?php echo $proyecto['id']; ?></td>
                        <td>
                          <?php if(!empty($proyecto['thumbnail']) && file_exists($proyecto['thumbnail'])): ?>
                            <img src="<?php echo $proyecto['thumbnail']; ?>" alt="<?php echo $proyecto['title']; ?>" class="project-thumbnail">
                          <?php else: ?>
                            <img src="images/project-placeholder.jpg" alt="Placeholder" class="project-thumbnail">
                          <?php endif; ?>
                        </td>
                        <td><?php echo $proyecto['title']; ?></td>
                        <td class="description-preview"><?php echo substr(strip_tags($proyecto['description']), 0, 50); ?>...</td>
                        <td><?php echo $proyecto['client']; ?></td>
                        <td><?php echo $proyecto['category']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($proyecto['date'])); ?></td>
                        <td>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-action" data-toggle="modal" data-target="#viewModal<?php echo $proyecto['id']; ?>">
                              <i class="ti-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-action" data-toggle="modal" data-target="#editModal<?php echo $proyecto['id']; ?>">
                              <i class="ti-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-action" data-toggle="modal" data-target="#deleteModal<?php echo $proyecto['id']; ?>">
                              <i class="ti-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      
                      <!-- Modal Ver Proyecto -->
                      <div class="modal fade" id="viewModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                              <h5 class="modal-title">Detalles del Proyecto</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="text-center mb-4">
                                <?php if(!empty($proyecto['thumbnail']) && file_exists($proyecto['thumbnail'])): ?>
                                  <img src="<?php echo $proyecto['thumbnail']; ?>" alt="<?php echo $proyecto['title']; ?>" class="img-fluid rounded" style="max-height: 300px;">
                                <?php else: ?>
                                  <img src="images/project-placeholder.jpg" alt="Placeholder" class="img-fluid rounded" style="max-height: 300px;">
                                <?php endif; ?>
                              </div>
                              <h3 class="text-center mb-4"><?php echo $proyecto['title']; ?></h3>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Cliente</h6>
                                  <p class="font-weight-bold"><?php echo $proyecto['client']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Categoría</h6>
                                  <p class="font-weight-bold"><?php echo $proyecto['category']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Fecha</h6>
                                  <p class="font-weight-bold"><?php echo date('d/m/Y', strtotime($proyecto['date'])); ?></p>
                                </div>
                              </div>
                              <h6 class="text-muted">Descripción</h6>
                              <div class="p-3 bg-light rounded">
                                <?php echo $proyecto['description']; ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal Editar Proyecto -->
                      <div class="modal fade" id="editModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                              <h5 class="modal-title">Editar Proyecto</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $proyecto['id']; ?>">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="title">Título</label>
                                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $proyecto['title']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="description">Descripción</label>
                                  <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $proyecto['description']; ?></textarea>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="client">Cliente</label>
                                      <input type="text" class="form-control" id="client" name="client" value="<?php echo $proyecto['client']; ?>" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="category">Categoría</label>
                                      <input type="text" class="form-control" id="category" name="category" value="<?php echo $proyecto['category']; ?>" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="date">Fecha</label>
                                  <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d', strtotime($proyecto['date'])); ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="thumbnail">Imagen (Dejar en blanco para mantener la actual)</label>
                                  <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                                  <?php if(!empty($proyecto['thumbnail']) && file_exists($proyecto['thumbnail'])): ?>
                                    <div class="mt-2">
                                      <small class="text-muted">Imagen actual:</small>
                                      <img src="<?php echo $proyecto['thumbnail']; ?>" alt="<?php echo $proyecto['title']; ?>" class="d-block mt-2" style="max-height: 100px;">
                                    </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="actualizar_proyecto" class="btn btn-warning">Guardar Cambios</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal Eliminar Proyecto -->
                      <div class="modal fade" id="deleteModal<?php echo $proyecto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title">Confirmar Eliminación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que deseas eliminar el proyecto <strong><?php echo $proyecto['title']; ?></strong>?</p>
                              <p class="text-danger">Esta acción no se puede deshacer.</p>
                            </div>
                            <div class="modal-footer">
                              <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $proyecto['id']; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="eliminar_proyecto" class="btn btn-danger">Eliminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center">No hay proyectos disponibles</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Crear Proyecto -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Crear Nuevo Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="client">Cliente</label>
                    <input type="text" class="form-control" id="client" name="client" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category">Categoría</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="date">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
              </div>
              <div class="form-group">
                <label for="thumbnail">Imagen</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="crear_proyecto" class="btn btn-primary">Crear Proyecto</button>
            </div>
          </form>
        </div>
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

<script>
  // Añadir editor WYSIWYG para las descripciones si se desea
  // Aquí se podría integrar un editor como TinyMCE o CKEditor
</script>

</body>
</html>
