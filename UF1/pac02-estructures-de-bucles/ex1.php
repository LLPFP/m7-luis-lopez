<?php 

function bucle(){
    for ($i = 50; $i <= 500; $i+=2) {
        echo "<div class='p-2 m-2 d-inline-flex border border-primary rounded text-center' style='width: 50px;'>" . $i . "</div>";
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

<h1 class="text-center mt-5 mb-5">Ejercicio 1</h1>


<?php

bucle();

?>
    
</body>
</html>