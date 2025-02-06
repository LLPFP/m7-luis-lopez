<?php
session_start();
require_once('carret.class.php');
require_once('producte.class.php');

if (!isset($_SESSION['carret'])) {
    $_SESSION['carret'] = serialize(new Carret());
}

$carret = unserialize($_SESSION['carret']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nom']) && isset($_POST['preu'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $preu = $_POST['preu'];
    if ($nom !== '' && $preu > 0) {
        $nuevoProducto = new Producte($nom, $preu);
        $carret->afegirProductes($nuevoProducto);
        $_SESSION['carret'] = serialize($carret);
    }

    var_dump($_SESSION['carret']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari afegir productes</title>
</head>
<body>
    <form action="productesTabla.php" method="POST">
        <label for="nom">Nombre:</label>
        <input require type="text" name="nom" placeholder="Nombre">
        <label for="preu">Precio:</label>
        <input require type="number" name="preu" placeholder="Precio">
        <input type="submit" value="Añadir">
    </form>
    
</body>
</html>