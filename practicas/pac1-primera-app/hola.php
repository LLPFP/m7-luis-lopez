<?php 

?>

		<html>
			<head>
				<title>hola.php</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
			</head>
			<body>
				<header class="d-flex align-items-center bg-dark text-light p-3">
					<img src="https://www.alianzafpdual.es/wp-content/uploads/2022/01/LLefia_logo.jpg" alt="Logo" class="me-3" style="width: 80px; height: auto;">
					<h1>Módulo 7 - Práctica 1. Mi primera aplicación en PHP</h1>
				</header>
				<div class="container">
					<!-- Contenido principal aquí -->
					 
					<div class="row mt-5 justify-content-center">
						<div class="col-md-5 text-center">
							<img src="https://via.placeholder.com/150" alt="La meva foto" class="rounded-circle mb-3">
							<h2>Luis López</h2>
						</div>
						<div class="col-md-5">
							<h3>Explicació del codi de l'arxiu index.php</h3>
							<p>
								A l'arxiu index.php per defecte, hi ha diverses àrees importants:
							</p>
							
							<ul>
								<li>La primera etiqueta es para empezar a escribir código php dentro de ella.</li>
								<li>Lo segundo, es una funcion que muestra el nombre que recibe.</li>
								<li>Luego se está llamando a dicha función con el texto el cual será mostrado mediante php al inicio.</li>
								<li>Se mostrará toda la información de php, es un comando básico que muestra toda la información.</li> 
								
							</ul>
						</div>
					</div>
      
				</div>

				<footer class="d-flex align-items-center bg-dark text-light p-3 fixed-bottom">
					

					<?php
					echo '<p class="mb-0 w-100 text-center">';
					echo 'Nombre: Luis López | Fecha: ' . date("Y/m/d");
					echo '</p>';
					?>
				</footer>
			</body>
		</html>