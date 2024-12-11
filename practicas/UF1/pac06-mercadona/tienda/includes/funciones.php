<?php



function generarTablaProductos($productos) {
    // Inicio de la tabla
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nombre del producto</th>';
    echo '<th>Precio</th>';
    echo '<th>Disponibilidad</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    //For each de productos
    foreach ($productos as $producto) {
        // Variables para cada campo
        $nombre = ucfirst($producto['nombre']); // Primera letra en mayúscula
        $precio = number_format($producto['precio'], 2); // Formato de precio con dos decimales
        $disponibilidad = $producto['disponibilidad'] ? "En stock" : "Agotado"; // Disponibilidad
        $claseFila = $producto['disponibilidad'] ? "" : "table-danger"; // Clase para color de fila

        // Generación de la fila de la tabla
        echo "<tr class='$claseFila'>";
        echo "<td>$nombre</td>";
        echo "<td>\$$precio</td>";
        echo "<td>$disponibilidad</td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}


function muestraInfoContacto($nombre,$telefono,$foto){
    echo '<div class="mt-4 p-3 border border-primary">';
    echo '<h3>Información de Contacto</h3>';
    echo '<p><strong>Nombre:</strong> ' . $_POST['nombre']. '</p>';
    echo '<p><strong>Teléfono:</strong> ' . $_POST['telefono']. '</p>';
    // Mostrar la foto del perfil si se proporciona una URL válida
    if (!empty($foto)) {
        echo '<p><strong>Foto del perfil:</strong></p>';
        echo '<img src="' . $_POST['foto'] . '" alt="Foto de perfil" class="img-thumbnail" style="width: 150px; height: 150px;">';
    } else {
        echo '<p><strong>Foto del perfil:</strong></p>';
        echo '<img src="' . $_POST['foto'] . '" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">';
    }
    echo '</div>';
    
}


?>