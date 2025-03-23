<?php


?>

<header class="navigation fixed-top">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Egen" width="150"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"      aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">Quienes somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="portfolio.php">Portfolio</a>
        </li>
        <li class="nav-item">
          <span class="nav-link text-muted px-2">|</span>
        </li>
        <?php 
        if(!isset($_SESSION['usuario'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inicioSesion.php">Iniciar Sesion</a>
        </li>
        <?php else: 
         $sql = "SELECT name AS usuario, avatar, rol FROM USERS WHERE id = " . $_SESSION['user_id'];
         $resultado = mysqli_query($conn, $sql);
         $usuario = mysqli_fetch_assoc($resultado);
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $usuario['avatar']; ?>" alt="Avatar" class="rounded-circle" width="32" height="32">
            <?php echo $usuario['usuario']; ?></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <span class="dropdown-item-text">Rol: <?php echo $usuario['rol']; ?></span>
            <div class="dropdown-divider"></div>
            <?php if($usuario['rol'] === 'Admin'): ?>
            <a class="dropdown-item" href="admin/dashboard.php">Admin Panel</a>
            <div class="dropdown-divider"></div>
            <?php endif; ?>
            <a class="dropdown-item" href="perfil.php">Mi Perfil</a>
            <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a>
                      </div>
                      <!-- Logout Modal -->
                      <div class="modal fade" id="logoutModal" tabindex="1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="logoutModalLabel">Confirmar cierre de sesión</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ¿Está seguro que desea cerrar la sesión?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="componentes/cerrarSesion.php?logout=true" class="btn btn-primary">Cerrar Sesión</a>
                            </div>
                          </div>
                        </div>
                      </div>        
                    </li>        <?php endif; ?>      
      </ul>    </div>  </nav></header>
