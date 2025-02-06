<?php

session_start();
require_once('carret.class.php');
require_once('producte.class.php');

if (!isset($_SESSION['carret'])) {
    $_SESSION['carret'] = serialize(new Carret());
}

$carret = unserialize($_SESSION['carret']);

?>


<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taula Productes</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Preu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($carret->productes as $producte) {
                $producte->detallesProducte();
            }
            ?>
        </tbody>
        <tfoot>
        <tr>
            <td>Total</td>
            <td><?php $carret->calcularTotal(); ?></td>
        </tr>        
    </tfoot>
    </table>
</body>
</html>