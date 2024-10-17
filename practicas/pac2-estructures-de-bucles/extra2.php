<?php



function temperatura(){
    $sumaNumeros=0;
    echo '<div class="container mt-5"><div class="row justify-content-center">';
    for($i=0; $i<10; $i++){
        $numeroAleatorio = rand(-10,40);
        if($numeroAleatorio<10){
            echo '<div class="col-auto mb-2"><div class="h2 text-center border border-primary bg-primary text-white rounded p-5 " style="width: 350px; height:180px;">'.$numeroAleatorio.'ºC<p class="mt-3 h3">Fred</p></div> </div>';
        }elseif($numeroAleatorio>=20){
            echo '<div class="col-auto mb-2"><div class="h2 text-center border border-primary bg-danger text-white rounded p-5 " style="width: 350px; height:180px;">'.$numeroAleatorio.'ºC<p class="mt-3 h3">Calor</p></div> </div>';
        }elseif($numeroAleatorio>=10){
            echo '<div class="col-auto mb-2"><div class="h2 text-center border border-primary bg-warning text-black rounded p-5 " style="width: 350px; height:180px;">'.$numeroAleatorio.'ºC<p class="mt-3 h3">Temperatura suau</p></div> </div>';
        }

        $sumaNumeros+=$numeroAleatorio;
    }
    echo '</div></div>';

    echo '<h2 class="text-center mt-5">La temperatura mitja és: ' .round($sumaNumeros/10,2).'ºC</h2>';
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

<h1 class="text-center mt-5 mb-5">Clasificació de temperatures</h1>


<?php

temperatura();

?>
    
</body>
</html>