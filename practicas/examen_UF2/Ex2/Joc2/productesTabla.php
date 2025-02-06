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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <table class='container mt-5 border border-dark'>
        <thead class="border border-dark">
            <tr>
                <th class="border border-dark">Nom</th>
                <th class="border border-dark">Preu</th>
            </tr>
        </thead>
        <tbody class="border border-dark">
            <?php
            foreach ($carret->productes as $producte) {
                $producte->detallesProducte();
            }
            ?>
        </tbody>
        <tfoot >
        <tr>
            <td class="border border-dark">Total</td>
            <td class="border border-dark"><?php echo $carret->calcularTotal(); ?></td>
        </tr>        
    </tfoot>
    </table>
</body>
</html>