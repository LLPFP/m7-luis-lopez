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
							<li class="nav-item active">
								<a class="nav-link" href="index.php">Home</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="about-us.php">Sobre Nosotros</a>
							</li>
							
						</ul>
						<?php if(!isset($_SESSION['user_id'])) { ?>
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
						<?php } else { ?>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item dropdown dropdown-slide @@profile">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#!">Mi Perfil<span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="user-profile.php">Ver Perfil</a></li>
									<li><a class="dropdown-item" href="edit-profile.php">Editar Perfil</a></li>
									<li><a class="dropdown-item" href="my-bookings.php">Mis Reservas</a></li>
								</ul>
							</li>
						</ul>
						<?php } ?>					</div>
				</nav>
			</div>
		</div>
	</div>
</header>