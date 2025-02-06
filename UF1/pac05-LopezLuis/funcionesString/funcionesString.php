<?php

function convertirMayusculas($texto){
    $textoConvertido =strtoupper($texto);
    echo '<h2>',$textoConvertido,'</h2>';
}

function contarPalabras($texto) {
    return str_word_count($texto);
}

function obtenerSubcadena($texto, $inicio, $longitud) {
    return substr($texto, $inicio, $longitud);
}

function reemplazarPalabras($texto, $buscar, $reemplazar) {
    return str_replace($buscar, $reemplazar, $texto);
}

function invertirTexto($texto) {
    return strrev($texto);
}

function compararStrings($cadena1, $cadena2) {
    return strcmp($cadena1, $cadena2) === 0; // Devuelve true si son iguales
}

function eliminarEspacios($texto) {
    return trim($texto); // Elimina espacios en blanco al principio y al final
}

function contarOcurrencias($texto, $palabra) {
    return substr_count($texto, $palabra); // Cuenta las ocurrencias de la palabra en el texto
}

function dividirPalabras($texto) {
    return explode(' ', $texto); // Divide el texto en palabras usando el espacio como delimitador
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
        echo '<form method="get">';
        echo '<label>Texto a mayusculas: </label>';
        echo '<input type="text" name="texto" placeholder="Texto a convertir">';
        echo '<button type="submit">Convertir</button>';
        echo '</form>';

        if(isset($_GET['texto'])){
            convertirMayusculas($_GET['texto']);
        }
        echo '<br><br><br><br>';

        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea>';
        echo '<button type="submit">Contar Palabras</button>';
        echo '</form>';

        if (isset($_POST['texto'])) {
            $cantidadPalabras = contarPalabras($_POST['texto']);
            echo '<h2>Cantidad de palabras: ', $cantidadPalabras, '</h2>';
        }

        echo '<br><br><br><br>';


        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<label>Posición de inicio: </label>';
        echo '<input type="number" name="inicio" placeholder="Ej: 2"><br>';
        echo '<label>Longitud de la subcadena: </label>';
        echo '<input type="number" name="longitud" placeholder="Ej: 5"><br>';
        echo '<button type="submit">Obtener Subcadena</button>';
        echo '</form>';

        if (isset($_POST['texto'], $_POST['inicio'], $_POST['longitud'])) {
            $texto = $_POST['texto'];
            $inicio = (int)$_POST['inicio']-1;
            $longitud = (int)$_POST['longitud'];
            $subcadena = obtenerSubcadena($texto, $inicio, $longitud);
            echo '<h2>Subcadena: ', $subcadena, '</h2>';
        }
        echo '<br><br><br>';


        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<label>Palabra a buscar: </label>';
        echo '<input type="text" name="buscar" placeholder="Palabra a buscar"><br>';
        echo '<label>Palabra para reemplazar: </label>';
        echo '<input type="text" name="reemplazar" placeholder="Palabra nueva"><br>';
        echo '<button type="submit">Reemplazar</button>';
        echo '</form>';

        if (isset($_POST['texto'], $_POST['buscar'], $_POST['reemplazar'])) {
            $texto = $_POST['texto'];
            $buscar = $_POST['buscar'];
            $reemplazar = $_POST['reemplazar'];
            $textoModificado = reemplazarPalabras($texto, $buscar, $reemplazar);
            echo '<h2>Texto Modificado: ', nl2br($textoModificado), '</h2>';
        }


        echo '<br><br><br>';

        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<button type="submit">Invertir</button>';
        echo '</form>';

        if (isset($_POST['texto'])) {
            $texto = $_POST['texto'];
            $textoInvertido = invertirTexto($texto);
            echo '<h2>Texto Invertido: ', $textoInvertido, '</h2>';
        }


        echo '<br><br><br>';


        echo '<form method="post">';
        echo '<label>Cadena 1: </label>';
        echo '<input type="text" name="cadena1" placeholder="Ingrese la primera cadena"><br>';
        echo '<label>Cadena 2: </label>';
        echo '<input type="text" name="cadena2" placeholder="Ingrese la segunda cadena"><br>';
        echo '<button type="submit">Comparar</button>';
        echo '</form>';

        if (isset($_POST['cadena1'], $_POST['cadena2'])) {
            $cadena1 = $_POST['cadena1'];
            $cadena2 = $_POST['cadena2'];
            $resultado = compararStrings($cadena1, $cadena2);
            echo '<h2>Las cadenas son ', $resultado ? 'iguales' : 'diferentes', '</h2>';
        }

        echo '<br><br><br>';


        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<button type="submit">Eliminar Espacios</button>';
        echo '</form>';

        if (isset($_POST['texto'])) {
            $texto = $_POST['texto'];
            $textoSinEspacios = eliminarEspacios($texto);
            echo '<h2>Texto sin espacios: ', htmlspecialchars($textoSinEspacios), '</h2>';
        }

        echo '<br><br><br>';

        
        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<label>Palabra a contar: </label>';
        echo '<input type="text" name="palabra" placeholder="Ingrese la palabra"><br>';
        echo '<button type="submit">Contar Ocurrencias</button>';
        echo '</form>';

        if (isset($_POST['texto'], $_POST['palabra'])) {
            $texto = $_POST['texto'];
            $palabra = $_POST['palabra'];
            $ocurrencias = contarOcurrencias($texto, $palabra);
            echo '<h2>La palabra "', htmlspecialchars($palabra), '" aparece ', $ocurrencias, ' veces.</h2>';
        }

        echo '<br><br><br>';


        echo '<form method="post">';
        echo '<label>Ingresa tu texto: </label>';
        echo '<textarea name="texto" placeholder="Escribe aquí..."></textarea><br>';
        echo '<button type="submit">Dividir en Palabras</button>';
        echo '</form>';

        if (isset($_POST['texto'])) {
            $texto = $_POST['texto'];
            $palabras = dividirPalabras($texto);
            echo '<h2>Palabras:</h2>';
            echo '<ul>';
            foreach ($palabras as $palabra) {
                echo '<li>', htmlspecialchars($palabra), '</li>';
            }
            echo '</ul>';
        }


?>
</body>
</html>