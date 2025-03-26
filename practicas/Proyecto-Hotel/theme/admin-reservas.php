<?php
include_once("./config/config.php");
session_start();

$sql = "SELECT r.*, c.nombre as nombre_cliente, h.id as num_habitacion 
FROM reservas r 
INNER JOIN clientes c ON r.id_cliente = c.id 
INNER JOIN habitaciones h ON r.id_habitacion = h.id 
ORDER BY r.fecha_inicio DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Hotel - Gestión de Reservas</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="body-wrapper">
<?php include("./componentes/header.php"); ?>

<section class="dashboard section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Gestión de Reservas</h2>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Lista de Reservas</h4>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaReserva">
                                    <i class="fa fa-plus"></i> Nueva Reserva
                                </button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Habitación</th>
                                        <th>Fecha Entrada</th>
                                        <th>Fecha Salida</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $estado_clase = '';
                                        switch($row['estado']) {
                                            case 'confirmada':
                                                $estado_clase = 'badge-success';
                                                break;
                                            case 'pendiente':
                                                $estado_clase = 'badge-warning';
                                                break;
                                            case 'cancelada':
                                                $estado_clase = 'badge-danger';
                                                break;
                                        }
                                        
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$row['nombre_cliente']."</td>";
                                        echo "<td>Habitación ".$row['num_habitacion']."</td>";
                                        echo "<td>".date('d/m/Y', strtotime($row['fecha_inicio']))."</td>";
                                        echo "<td>".date('d/m/Y', strtotime($row['fecha_fin']))."</td>";
                                        echo "<td><span class='badge ".$estado_clase."'>".ucfirst($row['estado'])."</span></td>";
                                        echo "<td>
                                                <button class='btn btn-sm btn-info mr-2' data-toggle='modal' data-target='#modalEditarReserva".$row['id']."' title='Editar'><i class='fa fa-edit'></i></button>
                                                <button class='btn btn-sm btn-secondary mr-2' data-toggle='modal' data-target='#modalVerReserva".$row['id']."' title='Ver'><i class='fa fa-eye'></i></button>
                                                <a href='cancelar-reserva.php?id=".$row['id']."' class='btn btn-sm btn-danger mr-2' title='Cancelar'><i class='fa fa-times'></i></a>
                                                <a href='confirmar-reserva.php?id=".$row['id']."' class='btn btn-sm btn-success' title='Confirmar'><i class='fa fa-check'></i></a>
                                            </td>";
                                        echo "</tr>";

                                        // Modal Editar Reserva
                                        echo "<div class='modal fade' id='modalEditarReserva".$row['id']."' tabindex='-1' role='dialog' aria-hidden='true'>
                                            <div class='modal-dialog modal-lg'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title'>Editar Reserva #".$row['id']."</h5>
                                                        <button type='button' class='close' data-dismiss='modal'><span>×</span></button>
                                                    </div>
                                                    <form action='actualizar-reserva.php' method='POST'>
                                                        <div class='modal-body'>
                                                            <input type='hidden' name='id' value='".$row['id']."'>
                                                            <div class='form-group'>
                                                                <label>Cliente</label>
                                                                <input type='text' class='form-control' value='".$row['nombre_cliente']."' disabled>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Fecha de Entrada</label>
                                                                <input type='date' name='fecha_inicio' class='form-control' value='".date('Y-m-d', strtotime($row['fecha_inicio']))."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label>Fecha de Salida</label>
                                                                <input type='date' name='fecha_fin' class='form-control' value='".date('Y-m-d', strtotime($row['fecha_fin']))."'>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                                            <button type='submit' class='btn btn-primary'>Guardar Cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";

                                        // Modal Ver Reserva
                                        echo "<div class='modal fade' id='modalVerReserva".$row['id']."' tabindex='-1' role='dialog' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title'>Detalles de la Reserva #".$row['id']."</h5>
                                                        <button type='button' class='close' data-dismiss='modal'><span>×</span></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p><strong>Cliente:</strong> ".$row['nombre_cliente']."</p>
                                                        <p><strong>Habitación:</strong> ".$row['num_habitacion']."</p>
                                                        <p><strong>Fecha de Entrada:</strong> ".date('d/m/Y', strtotime($row['fecha_inicio']))."</p>
                                                        <p><strong>Fecha de Salida:</strong> ".date('d/m/Y', strtotime($row['fecha_fin']))."</p>
                                                        <p><strong>Estado:</strong> <span class='badge ".$estado_clase."'>".ucfirst($row['estado'])."</span></p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Nueva Reserva -->
<div class="modal fade" id="modalNuevaReserva" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Reserva</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="guardar-reserva.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="id_cliente" class="form-control" required>
                            <option value="">Seleccione un cliente</option>
                            <?php
                            $sql_clientes = "SELECT id, nombre FROM clientes";
                            $result_clientes = mysqli_query($conn, $sql_clientes);
                            while($cliente = mysqli_fetch_assoc($result_clientes)) {
                                echo "<option value='".$cliente['id']."'>".$cliente['nombre']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Habitación</label>
                        <select name="id_habitacion" class="form-control" required>
                            <option value="">Seleccione una habitación</option>
                            <?php
                            $sql_habitaciones = "SELECT id FROM habitaciones";
                            $result_habitaciones = mysqli_query($conn, $sql_habitaciones);
                            while($habitacion = mysqli_fetch_assoc($result_habitaciones)) {
                                echo "<option value='".$habitacion['id']."'>Habitación ".$habitacion['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Entrada</label>
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Salida</label>
                        <input type="date" name="fecha_fin" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Reserva</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

</body>
</html>
