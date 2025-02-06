<?php

function tablasMultiplicar(){

//    for ($i = 1; $i <= 11; $i++) {
//            echo "<div class='container mt-4'>";
//            echo "<h2>Tabla de multiplicar del $i</h2>";
//            echo "<table class='table table-striped'>";
//            echo "<thead><tr><th>Multiplicación</th><th>Resultado</th></tr></thead>";
//            echo "<tbody>";
//            for ($j = 1; $j <= 10; $j++) {
//                $resultado = $i * $j;
//                echo "<tr><td>$i x $j</td><td>$resultado</td></tr>";
//            }
//            echo "</tbody>";
//            echo "</table>";
//            echo "</div>";
//        }


for($i = 1;$i<11;$i++){
    echo "<div class='container mt-4'>";
    echo "<h2>Tablas de multiplicar del $i</h2>";
    echo "<table class='table table-striped'";
    echo "<thead><tr><th>Multiplicacion</th> <th>Resultado final</th></tr></thead>";
    for($j = 1 ;$j<11;$j++){
        $resultado = $i*$j;
        echo "<tr><td>$i x $j =</td><td>$resultado</td></tr>";
    }
    echo "<tbody></tbody>";
    echo "</table>";
    echo "</div>";

}

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 2 - Estructura de bucles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<h1 class="text-center mt-5 mb-5">Ejercicio 2</h1>


<?php

tablasMultiplicar();

?>
    
</body>
</html>