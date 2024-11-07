<?php

function random(){
    

    
    $numeroAleatorio = rand(0,100);
    echo '<table class="table table-striped table-bordered">';
    echo '<thead class="table-dark"><tr><th>Par</th><th>Impar</th></tr></thead>';
    echo '<tbody><tr>';
        if($numeroAleatorio%2==0){


            echo '<td class="table-primary text-center" style="width: 50%;">'.$numeroAleatorio.'</td>';
            echo '<td class="table-secondary text-center" style="width: 50%;">-</td>';
        }else{


            echo '<td class="table-secondary text-center" style="width: 50%;">-</td>';
            echo '<td class="table-primary text-center" style="width: 50%;">'.$numeroAleatorio.'</td>';
        }
        echo '</tr></tbody>';
        echo '</table>';
       
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

<h1 class="text-center mt-5 mb-5">Ejercicio 3</h1>


<?php

random();

?>
    
</body>
</html>