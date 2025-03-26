<?php 
session_start();

require_once("./config/config.php");

// Obtener el ID de la habitación de la URL
$id_habitacion = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM habitaciones WHERE id = " . $id_habitacion;
$resultado = $conn->query($sql);
$habitacion = $resultado->fetch_assoc();

// Si no existe la habitación, redirigir
if (!$habitacion) {
		header("Location: index.php");
		exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Hotel - <?php echo htmlspecialchars($habitacion['tipo']); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<meta name="author" content="Hotel">

	<link href="images/favicon.png" rel="shortcut icon">
	<link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
	<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="plugins/slick/slick.css" rel="stylesheet">
	<link href="plugins/slick/slick-theme.css" rel="stylesheet">
	<link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="plugins/animate/animate.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style>
		.product-title {
			font-size: 2.5rem;
			color: #2c3e50;
			margin-bottom: 1.5rem;
			font-weight: 600;
		}
		.product-meta {
			background: #f8f9fa;
			padding: 15px;
			border-radius: 8px;
			margin-bottom: 20px;
		}
		.product-slider-item img {
			border-radius: 12px;
			box-shadow: 0 4px 8px rgba(0,0,0,0.1);
			transition: transform 0.3s ease;
		}
		.product-slider-item img:hover {
			transform: scale(1.02);
		}
		.widget {
			background: #fff;
			padding: 25px;
			border-radius: 12px;
			box-shadow: 0 2px 15px rgba(0,0,0,0.1);
			margin-bottom: 30px;
		}
		.btn-primary {
			background: #3498db;
			border: none;
			padding: 12px 25px;
			border-radius: 25px;
			transition: all 0.3s ease;
		}
		.btn-primary:hover {
			background: #2980b9;
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(52,152,219,0.3);
		}
		.form-control {
			border-radius: 8px;
			padding: 12px;
			border: 2px solid #e9ecef;
		}
		.form-control:focus {
			border-color: #3498db;
			box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
		}
		.table {
			border-radius: 8px;
			overflow: hidden;
		}
		.nav-pills .nav-link.active {
			background: #3498db;
			border-radius: 25px;
		}
		.nav-pills .nav-link {
			color: #2c3e50;
			border-radius: 25px;
			padding: 12px 30px;
		}
	</style>
</head>

<body class="body-wrapper">

<?php include("./componentes/header.php"); ?>

<section class="section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="product-details animate__animated animate__fadeIn">
					<h1 class="product-title">Habitacion <?php echo htmlspecialchars($habitacion['tipo']); ?></h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-tag"></i> Tipo: <?php echo htmlspecialchars($habitacion['tipo']); ?></li>
							<li class="list-inline-item"><i class="fa fa-check"></i> Disponibilidad: 
																<span class="badge <?php echo $habitacion['disponible'] ? 'badge-success' : 'badge-danger'; ?>">
																		<?php echo $habitacion['disponible'] ? 'Disponible' : 'No disponible'; ?>
																</span>
														</li>
						</ul>
					</div>

					<div class="product-image">
						<div class="my-4">
							<img class="img-fluid w-100 rounded" src="<?php echo htmlspecialchars($habitacion['imagen']); ?>" alt="Imagen habitación">
						</div>
					</div>

					<div class="content mt-5 pt-5">
						<ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Detalles de la Habitación</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Detalles de la Habitación</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td><i class="fa fa-money"></i> Precio por noche</td>
											<td class="text-primary">$<?php echo number_format($habitacion['precio'], 2); ?></td>
										</tr>
										<tr>
											<td><i class="fa fa-bed"></i> Tipo</td>
											<td><?php echo htmlspecialchars($habitacion['tipo']); ?></td>
										</tr>
										<tr>
											<td><i class="fa fa-info-circle"></i> Estado</td>
											<td>
																								<span class="badge <?php echo $habitacion['disponible'] ? 'badge-success' : 'badge-danger'; ?>">
																										<?php echo $habitacion['disponible'] ? 'Disponible' : 'No disponible'; ?>
																								</span>
																						</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-5 pt-5">
				<div class="sidebar">
					<div class="widget price text-center animate__animated animate__fadeInRight">
						<h4>Precio por noche</h4>
						<p class="display-4">$<?php echo number_format($habitacion['precio'], 2); ?></p>
					</div>
					
					<?php if($habitacion['disponible']): ?>
					<div class="widget user text-center animate__animated animate__fadeInRight">
						<h4>Reserva ahora</h4>
						<form action="procesar-reserva.php" method="POST" id="reservaForm">
							<input type="hidden" name="id_habitacion" value="<?php echo $id_habitacion; ?>">
							<div class="form-group">
								<label><i class="fa fa-calendar"></i> Fecha de entrada</label>
								<input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" required>
							</div>
							<div class="form-group">
								<label><i class="fa fa-calendar"></i> Fecha de salida</label>
								<input type="date" class="form-control" name="fecha_salida" id="fecha_salida" required>
							</div>
							<div class="form-group" id="resumen" style="display: none;">
								<div class="alert alert-info">
									<p><strong>Total de noches:</strong> <span id="total_noches">0</span></p>
									<p><strong>Precio total:</strong> $<span id="precio_total">0.00</span></p>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Reservar ahora</button>
						</form>
					</div>
					<?php endif; ?>
				</div>
			</div>		</div>
	</div>
</section>

<?php include("./componentes/footer.php"); ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/popper.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/bootstrap-slider.js"></script>
<script src="plugins/tether/js/tether.min.js"></script>
<script src="plugins/raty/jquery.raty-fa.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<script src="js/script.js"></script>

<script>
$(document).ready(function() {
    function calcularTotalNoches() {
        var fechaEntrada = new Date($('#fecha_entrada').val());
        var fechaSalida = new Date($('#fecha_salida').val());
        
        if(fechaEntrada && fechaSalida && fechaSalida > fechaEntrada) {
            var diferencia = fechaSalida.getTime() - fechaEntrada.getTime();
            var noches = Math.ceil(diferencia / (1000 * 3600 * 24));
            var precioNoche = <?php echo $habitacion['precio']; ?>;
            var precioTotal = noches * precioNoche;
            
            $('#total_noches').text(noches);
            $('#precio_total').text(precioTotal.toFixed(2));
            $('#resumen').show();
        } else {
            $('#resumen').hide();
        }
    }

    $('#fecha_entrada, #fecha_salida').on('change', calcularTotalNoches);
});
</script>

</body>
</html>