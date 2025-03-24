<?php
session_start();
include_once("./config/config.php");

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: inicioSesion.php");
    exit();
}

// Procesar la creación de un nuevo usuario
if (isset($_POST['crear_usuario'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];
    $job = $_POST['job'];
    $rol = $_POST['rol'];
    
    $sql_insert = "INSERT INTO USERS (name, surname, email, password, age, job, rol, date_register) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssssss", $name, $surname, $email, $password, $age, $job, $rol);
    
    if ($stmt_insert->execute()) {
        $mensaje = "Usuario creado correctamente";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error al crear el usuario: " . $conn->error;
        $tipo_mensaje = "danger";
    }
    $stmt_insert->close();
}

// Procesar eliminación de usuario
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete = "DELETE FROM USERS WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    
    if ($stmt_delete->execute()) {
        $mensaje = "Usuario eliminado correctamente";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error al eliminar el usuario: " . $conn->error;
        $tipo_mensaje = "danger";
    }
    $stmt_delete->close();
}

// Procesar cambios de usuario
if (isset($_POST['actualizar_usuario'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $rol = $_POST['rol'];
    $job = $_POST['job'];
    
    // Preparar la consulta base
    $sql_update = "UPDATE USERS SET name = ?, surname = ?, rol = ?, job = ?";
    $tipos = "ssss";
    $params = [$name, $surname, $rol, $job];

    // Manejar la subida de imagen si existe
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        // Crear el directorio si no existe
        if (!file_exists('uploads/avatars')) {
            mkdir('uploads/avatars', 0777, true);
        }
        
        $imagen_nombre = time() . '_' . $_FILES['avatar']['name'];
        $imagen_temporal = $_FILES['avatar']['tmp_name'];
        $ruta_destino = 'uploads/avatars/' . $imagen_nombre;
        
        if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
            $sql_update .= ", avatar = ?";
            $tipos .= "s";
            $params[] = $ruta_destino;
        }
    }

    // Completar la consulta
    $sql_update .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $user_id;
    
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param($tipos, ...$params);
    
    if ($stmt_update->execute()) {
        $mensaje = "Usuario actualizado correctamente";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error al actualizar el usuario: " . $conn->error;
        $tipo_mensaje = "danger";
    }
    $stmt_update->close();
}

// Obtener todos los usuarios
$sql = "SELECT id, name, surname, email, avatar, age, job, date_register, rol FROM USERS ORDER BY date_register DESC";
$result = $conn->query($sql);
$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>TechX - Gestión de Usuarios </title>

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

<?php include("./componentes/header.php"); ?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Gestión de Usuarios</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<section class="section">
  <div class="w-75 mx-auto"> 
    <!-- Cabecera con botones de acción -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="bg-light rounded p-4 d-flex justify-content-between align-items-center">
          <h2 class="mb-0">Usuarios Registrados</h2>
          <div>
            <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#createUserModal">
              <i class="ti-plus"></i> Nuevo Usuario
            </button>
            <a href="admin.php" class="btn btn-secondary">
              <i class="ti-arrow-left"></i> Volver al Panel
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Crear Usuario -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Crear Nuevo Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="surname">Apellidos</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="age">Edad</label>
                <input type="number" class="form-control" id="age" name="age" required>
              </div>
              <div class="form-group">
                <label for="job">Trabajo</label>
                <input type="text" class="form-control" id="job" name="job" required>
              </div>
              <div class="form-group">
                <label for="rol">Rol</label>
                <select class="form-control" id="rol" name="rol" required>
                  <option value="User">Usuario</option>
                  <option value="Editor">Editor</option>
                  <option value="Admin">Administrador</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="crear_usuario" class="btn btn-primary">Crear Usuario</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <!-- Mensajes de alerta -->
    <?php if (isset($mensaje)): ?>
    <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show" role="alert">
      <?php echo $mensaje; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php endif; ?>
    
    <!-- Tabla de usuarios -->
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover w-100">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>Avatar</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Trabajo</th>
                    <th>Fecha Registro</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($usuarios)): ?>
                    <tr>
                      <td colspan="8" class="text-center">No hay usuarios registrados</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                      <tr>
                        <td>
                          <?php if (!empty($usuario['avatar']) && file_exists($usuario['avatar'])): ?>
                            <img src="<?php echo $usuario['avatar']; ?>" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                          <?php else: ?>
                            <img src="images/user-placeholder.jpg" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                          <?php endif; ?>
                        </td>
                        <td><?php echo $usuario['name'] . ' ' . $usuario['surname']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['age']; ?></td>
                        <td><?php echo $usuario['job']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($usuario['date_register'])); ?></td>
                        <td>
                          <span class="badge <?php echo $usuario['rol'] == 'Admin' ? 'badge-danger' : ($usuario['rol'] == 'Editor' ? 'badge-info' : 'badge-success'); ?> rounded-pill px-3">
                            <?php echo $usuario['rol']; ?>
                          </span>
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info mr-1" data-toggle="modal" data-target="#viewModal<?php echo $usuario['id']; ?>">
                              <i class="ti-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#roleModal<?php echo $usuario['id']; ?>">
                              <i class="ti-settings"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $usuario['id']; ?>">
                              <i class="ti-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      
                      <!-- Modal Ver Usuario -->
                      <div class="modal fade" id="viewModal<?php echo $usuario['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                              <h5 class="modal-title">Detalles del Usuario</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="text-center mb-4">
                                <?php if (!empty($usuario['avatar']) && file_exists($usuario['avatar'])): ?>
                                  <img src="<?php echo $usuario['avatar']; ?>" alt="Avatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                <?php else: ?>
                                  <img src="images/user-placeholder.jpg" alt="Avatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                <?php endif; ?>
                              </div>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Nombre Completo</h6>
                                  <p class="font-weight-bold"><?php echo $usuario['name'] . ' ' . $usuario['surname']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Email</h6>
                                  <p class="font-weight-bold"><?php echo $usuario['email']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Edad</h6>
                                  <p class="font-weight-bold"><?php echo $usuario['age']; ?> años</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Trabajo</h6>
                                  <p class="font-weight-bold"><?php echo $usuario['job']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Fecha de Registro</h6>
                                  <p class="font-weight-bold"><?php echo date('d/m/Y', strtotime($usuario['date_register'])); ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <h6 class="text-muted">Rol</h6>
                                  <span class="badge <?php echo $usuario['rol'] == 'Admin' ? 'badge-danger' : ($usuario['rol'] == 'Editor' ? 'badge-info' : 'badge-success'); ?> rounded-pill px-3">
                                    <?php echo $usuario['rol']; ?>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal Editar -->
                      <div class="modal fade" id="roleModal<?php echo $usuario['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning">
                              <h5 class="modal-title">Cambiar Rol de Usuario</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <input type="hidden" name="user_id" value="<?php echo $usuario['id']; ?>">
                                <div class="form-group">
                                  <label for="name">Nombre:</label>
                                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $usuario['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="surname">Apellidos:</label>
                                  <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $usuario['surname']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="job">Trabajo:</label>
                                  <input type="text" class="form-control" id="job" name="job" value="<?php echo $usuario['job']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="avatar">Avatar:</label>
                                  <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
                                  <?php if (!empty($usuario['avatar']) && file_exists($usuario['avatar'])): ?>
                                    <img src="<?php echo $usuario['avatar']; ?>" alt="Avatar actual" class="mt-2" style="width: 100px; height: 100px; object-fit: cover;">
                                  <?php endif; ?>
                                </div>                               
                                <div class="form-group">
                                  <label for="rol">Rol:</label>
                                  <select class="form-control" id="rol" name="rol" required>
                                    <option value="User" <?php echo ($usuario['rol'] == 'User') ? 'selected' : ''; ?>>Usuario</option>
                                    <option value="Editor" <?php echo ($usuario['rol'] == 'Editor') ? 'selected' : ''; ?>>Editor</option>
                                    <option value="Admin" <?php echo ($usuario['rol'] == 'Admin') ? 'selected' : ''; ?>>Administrador</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill px-4 py-2 shadow-sm" data-dismiss="modal">
                                  <i class="fas fa-times mr-2"></i>Cancelar
                                </button>
                                <button type="submit" name="actualizar_usuario" class="btn btn-warning rounded-pill px-4 py-2 shadow-sm">
                                  <i class="fas fa-save mr-2"></i>Guardar
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>                      
                      <!-- Modal Eliminar Usuario -->
                      <div class="modal fade" id="deleteModal<?php echo $usuario['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title">Confirmar Eliminación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que deseas eliminar al usuario <strong><?php echo $usuario['name'] . ' ' . $usuario['surname']; ?></strong>?</p>
                              <p class="text-danger">Esta acción no se puede deshacer y eliminará todos los datos asociados a este usuario.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="?delete=<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar Usuario</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
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
  // Activar tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  
  // Filtrar tabla
  $(document).ready(function() {
    $("#searchInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</body>
</html>
