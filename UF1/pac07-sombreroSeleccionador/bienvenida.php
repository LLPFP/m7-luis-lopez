<?php

include("./casas.php");

$casas = array_keys($casas_info);
$casa_seleccionada = $casas[array_rand($casas)];


 


?>


<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Benvingut a la teva casa de Hogwarts</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="color: <?php echo $casas_info[$casa_seleccionada]['text_color'] ?>; background-color: <?php echo $casas_info[$casa_seleccionada]['background_color']?>;">
<div class="container text-center">
<h1 class="mt-5">¡Has sido seleccionado!</h1>
<div class="mt-4 ">
<!-- AQUI VA EL MISSATGE DE BENVINGUDA PERSONALITZAT AMB EL NOM DE LA PERSONA I COGNOMS.
Recorda que els estils d'aquest missatge seran condicionats per la llista proporcionada amb la guía d'estils de cada casa. -->


<div class="container mt-5" style="background-color: <?php echo $casas_info[$casa_seleccionada]['background_color']?>;">

            <div class="row justify-content-center rounded" style="background-color: <?php echo $casas_info[$casa_seleccionada]['message_background']?>;">
            <h2>¡Bienvenido a <?php echo $casa_seleccionada , ' ' , $_POST['nombre'] , ' ' ,$_POST['apellidos']?>!</h2>

            <div class="col-md-6">  
                <p><?php echo $casas_info[$casa_seleccionada]['welcome_message']?></p>
                <img src="<?php echo $casas_info[$casa_seleccionada]['image']?>" class="img-fluid mt-4 mb-5" alt="Responsive image" style="width: 300px; height: 300px; object-fit: contain;">
            </div>
            </div>
</div>


</div>
</div>
</body>
</html>