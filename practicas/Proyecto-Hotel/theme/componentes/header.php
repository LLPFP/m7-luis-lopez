<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="index.php">
						<img src="images/logo.png" alt="" width="150" height="150" style="border-radius: 50%; object-fit: cover;">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item">
								<a class="nav-link" href="index.php">Home</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="about-us.php">Sobre HotelVac</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="rooms.php">Habitaciones</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="contact.php">Contacto</a>
							</li>
							<?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Admin'): ?>
							<li class="nav-item">
								<a class="nav-link" href="admin.php">Panel Admin</a>
							</li>
							<?php endif; ?>
						</ul>
						<?php 
						if(!isset($_SESSION['id_cliente']) || empty($_SESSION['id_cliente'])) { 
						?>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button btn btn-primary text-white px-4 rounded-pill" href="login.php">
									<i class="fa fa-sign-in mr-2"></i>Login
								</a>
							</li>
							<li class="nav-item ml-2">
								<a class="nav-link login-button btn btn-outline-primary px-4 rounded-pill" href="register.php">
									<i class="fa fa-user-plus mr-2"></i>Registro
								</a>
							</li>
						</ul>
						<?php } else { 
							// Asegurarse de que todas las variables de sesión necesarias existen
							$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
							$imagen = isset($_SESSION['imagen']) && !empty($_SESSION['imagen']) ? $_SESSION['imagen'] : 'avatar.png';
							$ruta_imagen = $imagen === 'avatar.png' ? 'images/clientes/' . $imagen : 'uploads/clientes/' . $imagen;
						?>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#!">
									<img src="<?php echo $ruta_imagen; ?>" 
										alt="Avatar" class="rounded-circle mr-2" style="width: 30px; height: 30px; object-fit: cover;">
									<span><?php echo htmlspecialchars($nombre); ?></span>
								</a>
								<!-- Dropdown list -->
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="user-profile.php"><i class="fa fa-user mr-2"></i>Ver Perfil</a></li>
									<li><a class="dropdown-item" href="edit-profile.php"><i class="fa fa-edit mr-2"></i>Editar Perfil</a></li>
									<li><a class="dropdown-item" href="my-bookings.php"><i class="fa fa-calendar mr-2"></i>Mis Reservas</a></li>
									<li><div class="dropdown-divider"></div></li>
									<li><a class="dropdown-item text-danger" href="logout.php"><i class="fa fa-sign-out mr-2"></i>Cerrar Sesión</a></li>
								</ul>
							</li>
						</ul>
						<?php } ?>					</div>
				</nav>
			</div>
		</div>
	</div>
</header>