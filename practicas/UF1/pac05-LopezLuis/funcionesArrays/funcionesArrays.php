<?php

function sumarArray($numeros) {
    return array_sum($numeros); // Suma todos los valores del array
}

function ordenarArrayAlfabetico($nombres) {
    sort($nombres); // Ordena el array alfabéticamente
    return $nombres;
}

function filtrarMayores($numeros, $valor) {
    return array_filter($numeros, function($numero) use ($valor) {
        return $numero > $valor; // Retorna true si el número es mayor que el valor
    });
}

function buscarEnArray($array, $valor) {
    return in_array($valor, $array); // Devuelve true si el valor se encuentra en el array
}

function contarElementos($array) {
    return count($array); // Devuelve la cantidad de elementos en el array
}

function obtenerMaximo($numeros) {
    return max($numeros); // Devuelve el valor máximo del array
}


function obtenerMinimo($numeros) {
    return min($numeros); // Devuelve el valor mínimo del array
}

function eliminarDuplicados($array) {
    return array_unique($array); // Devuelve un nuevo array sin elementos duplicados
}

function combinarArrays($array1, $array2) {
    return array_merge($array1, $array2); // Combina los dos arrays
}

function dividirArray($array, $tamanio) {
    return array_chunk($array, $tamanio); // Divide el array en fragmentos del tamaño indicado
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>funcionesString</title>
</head>
<body>
    <?php
       echo '<form method="post">';
       echo '<label>Ingresa números separados por comas: </label>';
       echo '<input type="text" name="numeros" placeholder="Ej: 1,2,3,4"><br>';
       echo '<button type="submit">Sumar</button>';
       echo '</form>';

       if (isset($_POST['numeros'])) {
           // Convierte la cadena de texto a un array
           $numeros = array_map('trim', explode(',', $_POST['numeros']));
           // Convierte los valores a números
           $numeros = array_map('floatval', $numeros);
           $sumaTotal = sumarArray($numeros);
           echo '<h2>Suma total: ', $sumaTotal, '</h2>';
       }



        echo '<br><br><br><br>';

        echo '<form method="post">';
        echo '<label>Ingresa nombres separados por comas: </label>';
        echo '<input type="text" name="nombres" placeholder="Ej: Ana, Juan, Pedro"><br>';
        echo '<button type="submit">Ordenar</button>';
        echo '</form>';

        if (isset($_POST['nombres'])) {
            // Convierte la cadena de texto a un array
            $nombres = array_map('trim', explode(',', $_POST['nombres']));
            $nombresOrdenados = ordenarArrayAlfabetico($nombres);
            echo '<h2>Nombres ordenados:</h2>';
            echo '<ul>';
            foreach ($nombresOrdenados as $nombre) {
                echo '<li>', htmlspecialchars($nombre), '</li>';
            }
            echo '</ul>';
        }

            echo '<br><br><br><br>';

            echo '<h2>Filtrar Elementos Mayores a un Valor</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa números separados por comas: </label>';
            echo '<input type="text" name="numeros" placeholder="Ej: 1,2,3,4,5"><br>';
            echo '<label>Valor límite: </label>';
            echo '<input type="number" name="valor" placeholder="Ingrese el valor"><br>';
            echo '<button type="submit" name="filtrar">Filtrar</button>';
            echo '</form>';
        
            if (isset($_POST['filtrar'])) {
                // Convierte la cadena de texto a un array de números
                $numeros = array_map('floatval', array_map('trim', explode(',', $_POST['numeros'])));
                $valor = floatval($_POST['valor']);
                $numerosFiltrados = filtrarMayores($numeros, $valor);
                echo '<h3>Números mayores a ' . htmlspecialchars($valor) . ':</h3>';
                echo '<ul>';
                foreach ($numerosFiltrados as $numero) {
                    echo '<li>' . htmlspecialchars($numero) . '</li>';
                }
                echo '</ul>';
            }

            echo '<br><br><br><br>';

            echo '<h2>Buscar un Valor en un Array</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa números separados por comas: </label>';
            echo '<input type="text" name="numerosBuscar" placeholder="Ej: 1,2,3,4,5"><br>';
            echo '<label>Valor a buscar: </label>';
            echo '<input type="number" name="valorBuscar" placeholder="Ingrese el valor"><br>';
            echo '<button type="submit" name="buscar">Buscar</button>';
            echo '</form>';
        
            if (isset($_POST['buscar'])) {
                // Convierte la cadena de texto a un array de números
                $numerosBuscar = array_map('floatval', array_map('trim', explode(',', $_POST['numerosBuscar'])));
                $valorBuscar = floatval($_POST['valorBuscar']);
                $encontrado = buscarEnArray($numerosBuscar, $valorBuscar);
                echo '<h3>El valor ' . htmlspecialchars($valorBuscar) . ' se ' . ($encontrado ? 'encuentra' : 'no se encuentra') . ' en el array.</h3>';
            }

            echo '<br><br><br><br>';


            echo '<h2>Contar Elementos de un Array</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa elementos separados por comas: </label>';
            echo '<input type="text" name="elementos" placeholder="Ej: a,b,c,d,e"><br>';
            echo '<button type="submit" name="contar">Contar Elementos</button>';
            echo '</form>';

            if (isset($_POST['contar'])) {
                // Convierte la cadena de texto a un array
                $elementos = array_map('trim', explode(',', $_POST['elementos']));
                $cantidad = contarElementos($elementos);
                echo '<h3>Cantidad de elementos: ' . htmlspecialchars($cantidad) . '</h3>';
            }


            echo '<br><br><br><br>';

            echo '<h2>Obtener Valor Máximo de un Array</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa números separados por comas: </label>';
            echo '<input type="text" name="numeros" placeholder="Ej: 10,20,30,40"><br>';
            echo '<button type="submit" name="maximo">Obtener Máximo</button>';
            echo '</form>';

            if (isset($_POST['maximo'])) {
                // Convierte la cadena de texto a un array de números
                $numeros = array_map('floatval', array_map('trim', explode(',', $_POST['numeros'])));
                $maximo = obtenerMaximo($numeros);
                echo '<h3>Valor máximo: ' . htmlspecialchars($maximo) . '</h3>';
            }


            echo '<br><br><br><br>';

            echo '<h2>Obtener Valor Mínimo de un Array</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa números separados por comas: </label>';
            echo '<input type="text" name="numerosMin" placeholder="Ej: 10,20,30,40"><br>';
            echo '<button type="submit" name="minimo">Obtener Mínimo</button>';
            echo '</form>';
        
            if (isset($_POST['minimo'])) {
                // Convierte la cadena de texto a un array de números
                $numerosMin = array_map('floatval', array_map('trim', explode(',', $_POST['numerosMin'])));
                $minimo = obtenerMinimo($numerosMin);
                echo '<h3>Valor mínimo: ' . htmlspecialchars($minimo) . '</h3>';
            }
            
            echo '<br><br><br><br>';

            
            echo '<h2>Eliminar Duplicados de un Array</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa elementos separados por comas: </label>';
            echo '<input type="text" name="elementosDuplicados" placeholder="Ej: a,b,c,a,d,e,c"><br>';
            echo '<button type="submit" name="eliminar">Eliminar Duplicados</button>';
            echo '</form>';
        
            if (isset($_POST['eliminar'])) {
                // Convierte la cadena de texto a un array
                $elementosDuplicados = array_map('trim', explode(',', $_POST['elementosDuplicados']));
                $sinDuplicados = eliminarDuplicados($elementosDuplicados);
                echo '<h3>Array sin duplicados:</h3>';
                echo '<ul>';
                foreach ($sinDuplicados as $elemento) {
                    echo '<li>' . htmlspecialchars($elemento) . '</li>';
                }
                echo '</ul>';
            }


            echo '<br><br><br><br>';

            echo '<h2>Combinar Dos Arrays</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa el primer array (separados por comas): </label>';
            echo '<input type="text" name="array1" placeholder="Ej: a,b,c"><br>';
            echo '<label>Ingresa el segundo array (separados por comas): </label>';
            echo '<input type="text" name="array2" placeholder="Ej: d,e,f"><br>';
            echo '<button type="submit" name="combinar">Combinar</button>';
            echo '</form>';

            if (isset($_POST['combinar'])) {
                // Convierte las cadenas de texto a arrays
                $array1 = array_map('trim', explode(',', $_POST['array1']));
                $array2 = array_map('trim', explode(',', $_POST['array2']));
                $arrayCombinado = combinarArrays($array1, $array2);
                echo '<h3>Array combinado:</h3>';
                echo '<ul>';
                foreach ($arrayCombinado as $elemento) {
                    echo '<li>' . htmlspecialchars($elemento) . '</li>';
                }
                echo '</ul>';
            }


            echo '<br><br><br><br>';


            echo '<h2>Dividir un Array en Fragmentos</h2>';
            echo '<form method="post">';
            echo '<label>Ingresa el array (separados por comas): </label>';
            echo '<input type="text" name="arrayFragmento" placeholder="Ej: 1,2,3,4,5"><br>';
            echo '<label>Tamaño del fragmento: </label>';
            echo '<input type="number" name="tamanio" placeholder="Ingrese el tamaño"><br>';
            echo '<button type="submit" name="dividir">Dividir</button>';
            echo '</form>';
        
            if (isset($_POST['dividir'])) {
                // Convierte la cadena de texto a un array de números
                $arrayFragmento = array_map('floatval', array_map('trim', explode(',', $_POST['arrayFragmento'])));
                $tamanio = intval($_POST['tamanio']);
                $fragmentos = dividirArray($arrayFragmento, $tamanio);
                echo '<h3>Array dividido en fragmentos:</h3>';
                foreach ($fragmentos as $index => $fragmento) {
                    echo '<h4>Fragmento ' . ($index + 1) . ':</h4>';
                    echo '<ul>';
                    foreach ($fragmento as $elemento) {
                        echo '<li>' . htmlspecialchars($elemento) . '</li>';
                    }
                    echo '</ul>';
                }
            }
?>
</body>
</html>