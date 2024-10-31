<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola soy index</h1>

    <?php

    //foreach($_GET['asignatura'] as $asignatura){
       // echo $asignatura;
   // }
    
    echo "<br><br><br><br><br><br>";


    foreach($_POST['frutas'] as $frutas){
        echo $frutas;
    }
    ?>
</body>
</html>