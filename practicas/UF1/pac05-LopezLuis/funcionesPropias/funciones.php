<?php

function generarSaludo($nombre){
    echo '<h2>Hola, ', $nombre , '</h2>';  


};

function calcularTotal($precio, $cantidad, $impuesto){
    $precioTotalSinImpuestos= $precio * $cantidad;
    $impuestosCalculo = $impuesto/100;
    $restoImpuestos = $precioTotalSinImpuestos * $impuestosCalculo;
    $precioTotalConImpuestos = $precioTotalSinImpuestos + $restoImpuestos;

    echo '<h2>El precio final es de: ',$precioTotalConImpuestos,'</h2>';
}


function generarResumen($texto, $limite){

     // Verificar si el texto es más largo que el límite
     if (strlen($texto) > $limite) {
        // Recortar el texto y agregar "..."
        $resumen = substr($texto, 0, $limite) . '...';
        echo '<h2>',$resumen,'</h2>';
    }
    // Si no es más largo, devolver el texto original
    echo '<h2>',$texto,'</h2>';
}

function convertirTemperatura($temperatura, $escala) {
    if ($escala === "C") {
        // Convertir de Fahrenheit a Celsius
        $resultado = ($temperatura - 32) * 5/9;
        echo '<h2>Fahrenheit -> Celsius :',number_format($resultado, 2),'</h2>';
    } elseif ($escala === "F") {
        // Convertir de Celsius a Fahrenheit
        $resultado = ($temperatura * 9/5) + 32;
        echo '<h2>Celsius -> Fahrenheit :',number_format($resultado, 2),'</h2>';
    } else {
        return "Escala no válida. Usa 'C' para Celsius o 'F' para Fahrenheit.";
    }
}

function calcularEdad($anioNacimiento) {
    $anioActual = date("Y"); // Obtiene el año actual
    $edad = $anioActual - $anioNacimiento; // Calcula la edad

    echo '<h2>Edad: ',$edad,'</h2>';
}

function esPar($numero) {
    if($numero % 2 === 0){
        echo '<h2>El número: ',$numero,' es par</h2>';
    } else{
        echo '<h2>El número: ',$numero,' es impar</h2>';

    }
}

function generarEnlaceDescarga($archivo) {
    $archivoSanitizado = htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8');
    return '<a href="?accion=descargar&archivo=' . $archivoSanitizado . '">Descargar</a>';
}

if (isset($_GET['accion']) && $_GET['accion'] === 'descargar' && isset($_GET['archivo'])) {
    $archivo = basename($_GET['archivo']); // Obtener solo el nombre del archivo
    $ruta = './' . $archivo; 

    // Verificar si el archivo existe
    if (file_exists($ruta)) {
        // Configurar las cabeceras para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); // Cambia según el tipo de archivo
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta));
        readfile($ruta); // Leer el archivo y enviarlo al navegador
        exit;
    } else {
        echo "El archivo no existe.";
    }
}

function calcularDescuento($precioOriginal, $descuento) {
    // Calcular el descuento
    $montoDescuento = ($precioOriginal * $descuento) / 100;
    // Calcular el precio final
    $precioFinal = $precioOriginal - $montoDescuento;
    return number_format($precioFinal,2);
}


function convertirHorasMinutos($horas) {
    return $horas * 60;
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FuncionesPropias | Parte 1</title>
</head>
<body>
    <h1>Funciones Propias</h1>

    <?php
        if (isset($_GET['nombre'])) {
            $nombre = htmlspecialchars($_GET['nombre']); // Get the name and sanitize it
            generarSaludo($nombre); // Call the function to generate the greeting
        }   


        echo '<form method="get">';
        echo '<label>¿Cual es tu nombre? </label>';
        echo '<input type="text" name="nombre" placeholder="Tu nombre">';
        echo '<button type="submit">Saludar</button></form>';



        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Calculo: </label>';
        echo '<input type="text" name="precio" placeholder="Precio €">';
        echo '<input type="text" name="cantidad" placeholder="Cantidad !">';
        echo '<input type="text" name="impuesto" placeholder="Impuesto %">';
        echo '<button type="submit">Calcular dinero</button></form>';

        if (isset($_GET['precio']) && isset($_GET['cantidad']) && isset($_GET['impuesto'])) {
            $precio = floatval($_GET['precio']); // Get and convert to float
            $cantidad = intval($_GET['cantidad']); // Get and convert to integer
            $impuesto = floatval($_GET['impuesto']); // Get and convert to float
            calcularTotal($precio, $cantidad, $impuesto); // Call the function to generate the €
        }   
          
        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Texto acortado: </label>';
        echo '<input type="text" name="texto" placeholder="Texto">';
        echo '<input type="text" name="limite" placeholder="Limite de caracteres !">';
        echo '<button type="submit">Acortar</button></form>';


        if (isset($_GET['texto']) && isset($_GET['limite'])) {
            $texto= $_GET['texto'];
            $limite= $_GET['limite'];
            generarResumen($texto, $limite);
        }

        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Temperatura: </label>';
        echo '<input type="text" name="temperatura" placeholder="Temperatura">';
        echo '<input type="text" name="escala" placeholder="Celsius o Fh?">';
        echo '<button type="submit">Temperatura</button></form>';


        if (isset($_GET['temperatura']) && isset($_GET['escala'])) {
            $temperatura = floatval($_GET['temperatura']);
            $escala = strtoupper(trim($_GET['escala']));
            convertirTemperatura($temperatura, $escala);
        }


        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Edad: </label>';
        echo '<input type="number" name="anioNacimiento" placeholder="Año de Nacimiento">';
        echo '<button type="submit">Calcular Edad</button></form>';


        if (isset($_GET['anioNacimiento'])) {
            $anioNacimiento=intval($_GET['anioNacimiento']);
            calcularEdad($anioNacimiento);
        }

        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Numero par: </label>';
        echo '<input type="number" name="numero" placeholder="Numero">';
        echo '<button type="submit">Resultado</button></form>';


        if (isset($_GET['numero'])) {
            $numero=intval($_GET['numero']);
            esPar($numero);
        }


        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Nombre del archivo: </label>';
        echo '<input type="text" name="archivo" placeholder="Nombre del archivo">';
        echo '<button type="submit">Generar enlace</button>';
        echo '</form>';

        // archivo_descarga.php
        if (isset($_GET['archivo'])) {
            $archivo = $_GET['archivo'];
            echo generarEnlaceDescarga($archivo);
        }

        echo '<br><br><br><br>';

        echo '<form method="get">';
        echo '<label>Descuento: </label>';
        echo '<input type="text" name="precioOriginal" placeholder="Precio">';
        echo '<input type="text" name="descuento" placeholder="Descuento">';
        echo '<button type="submit">Resultado:</button>';
        echo '</form>';

        // archivo_descarga.php
        if (isset($_GET['precioOriginal'])&& isset($_GET['descuento'])) {
            $precioOriginal = intval($_GET['precioOriginal']);
            $descuento = intval($_GET['descuento']);
            $precioFinal = calcularDescuento($precioOriginal, $descuento);

            echo '<h2>El precio final es: ',$precioFinal,'</h2>';
        }


        echo '<br><br><br>';


           // Conversión de horas a minutos
           echo '<form method="get">';
           echo '<label>Horas a minutos: </label>';
           echo '<input type="text" name="horas" placeholder="Horas">';
           echo '<button type="submit">Convertir</button>';
           echo '</form>';
   
           if (isset($_GET['horas'])) {
               $horas = floatval($_GET['horas']);
               $minutos = convertirHorasMinutos($horas);
               echo '<h2>', $horas, ' horas son: ', $minutos, ' minutos</h2>';
           }
    ?>

</body>
</html>