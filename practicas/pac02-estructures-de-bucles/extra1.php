<?php

function random(){
    

    
    $numeroAleatorio = rand(0,100);

    echo '<h1 class="text-center">Numero generado: ' .$numeroAleatorio. '</h1>';
    echo '<h2 class="text-center mt-3">Divisors de: ' .$numeroAleatorio. '</h2>';
    echo '<div class="container mt-5"><div class="row justify-content-center">';
    $contadorPrimo=0;

    for($i=1; $i<=$numeroAleatorio; $i++){
        if($numeroAleatorio%$i==0){
            echo '<div class="col-auto mb-2"><div class="border border-primary bg-primary text-white rounded px-3 py-2">'.$i.'</div></div>';
            $contadorPrimo++;
        }
    }
    echo '</div></div>';

    if($contadorPrimo==2){
        echo '<h2 class="text-center mt-5">El numero ' .$numeroAleatorio. ' es primo</h2>';
    }else{
        echo '<h2 class="text-center mt-5">El numero ' .$numeroAleatorio. ' no es primo</h2>';
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

<h1 class="text-center mt-5 mb-5">Extra 1</h1>


<?php

random();

?>
    
</body>
</html>