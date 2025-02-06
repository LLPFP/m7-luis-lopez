<?php
session_start();
require_once('usuari.class.php');

if (!isset($_SESSION['usuari'])) {
    $_SESSION['usuari'] = serialize(new Usuari($nom, $edat, $correu));
}

$carret = unserialize($_SESSION['usuari']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $edat = $_POST['edat'];
    $correu = $_POST['correu'];
    $usuari = new Usuari($nom, $edat, $correu);
    if ($usuari->validarDades()) {
        echo "Dades vàlides";
    } else {
        echo "Dades no vàlides";
    }
    $_SESSION['usuari'] = serialize($usuari);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari Usuari</title>
</head>
<body>
    <form action="" method="post">
        <label for="nom">Nom:</label>
        <input required ="text" name="nom" id="nom">
        <label  for"edat"> Edat:</label>
        <input required ="text" name="edat" id="edat">
        <label for="correu"> Correu:</label>
        <input required type="text" name="correu" id="correu">
        <input type="submit" value="Enviar">
    </form>

    <?php

    if (isset($_SESSION['usuari'])) {
        $usuari = unserialize($_SESSION['usuari']);
        echo "<p>Nom: " . $usuari->nom . "</p>";
        echo "<p>Edat: " . $usuari->edat . "</p>";
        echo "<p>Correu: " . $usuari->correu . "</p>";
    }

    ?>
</body>
</html>