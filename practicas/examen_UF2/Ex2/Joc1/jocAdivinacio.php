<?php 

session_start();
require_once('jocAdivinacio.class.php');

if (!isset($_SESSION['numeroSecret'])) {
    $_SESSION['numeroSecret'] = rand(1, 20);
}

$numeroSecret = $_SESSION['numeroSecret'];

if (!isset($_SESSION['intents'])) {
    $_SESSION['intents'] = 0;
}

$intents = $_SESSION['intents'];
$joc = new JocAdivinacio($numeroSecret, $intents);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num = $_POST['num'];
    $_SESSION['intents']++;
    echo $joc->comprovar($num);
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="" method="POST">
        <input class="w-50" type="text" name="num" placeholder="Introdueix un número">
        <input type="submit" value="Comprovar">
    </form>
</body>
</html>