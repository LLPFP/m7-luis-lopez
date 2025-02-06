<?php
session_start();
require_once('factura.class.php');

if (!isset($_SESSION['facturas'])) {
    $_SESSION['facturas'] = serialize(new Factura($client, $producte, $quantitat, $preuUnitari));
}


$facturas = unserialize($_SESSION['facturas']);

$facturasAleatorias =[];


for($i = 0; $i < 5; $i++){
    $client = rand(1, 5);
    $producte = rand(1, 25);
    $quantitat = rand(1, 20);
    $preuUnitari = rand(10, 150);
    $facturasAleatorias[$i] = new Factura($client, $producte, $quantitat, $preuUnitari);
}

//Falta descompte


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taula facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<table class='container mt-5 border border-dark'>
        <thead class="border border-dark">
            <tr>
                <th class="border border-dark">Facturas ID</th>
                <th class="border border-dark">Producte Num.</th>
                <th class="border border-dark">Quantitat</th>
                <th class="border border-dark">Preu Unitari</th>
            </tr>
        </thead>
        <tbody class="border border-dark">
            <?php 
            
            forEach($facturasAleatorias as $factura){
                echo "<tr>";
                echo "<td class='border border-dark'>" . $factura->client . "</td>";
                echo "<td class='border border-dark'>" . $factura->producte . "</td>";
                echo "<td class='border border-dark'>" . $factura->quantitat . " productes</td>";
                echo "<td class='border border-dark'>" . $factura->preuUnitari . "€</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot >
            <tr>
                <td class="border border-dark" colspan="3">Total</td>
                <td class="border border-dark"><?php echo $factura->calcularTotal() ?></td>
            </tr>
               
    </tfoot>
    </table>
    
</body>
</html>
