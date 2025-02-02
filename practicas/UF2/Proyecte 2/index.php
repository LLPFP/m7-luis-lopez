<?php 


require_once('jugador.class.php');
require_once('partida.class.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['jugadores'], $_POST['cartas'])) {
    $numJugadores = $_POST['jugadores'];
    $numCartas = $_POST['cartas'];

    $array_jugadores = [];
    for($i = 0; $i < $numJugadores; $i++) {
        $baraja = new Baraja();
        $baraja->crea_Baraja();
        $baraja->mezcla();
        $jugador = new Jugador($baraja, $i);
        $array_jugadores[] = $jugador;
    }
    $barajaPartida = new Baraja();
    $barajaPartida->crea_Baraja();
    $barajaPartida->mezcla();

    $partida = new Partida($numJugadores, $numCartas, 1, $barajaPartida, $barajaPartida->conjunto_cartas[0], $array_jugadores, 1);
    
    $_SESSION['partida'] = $partida;
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uno!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">

</head>
<body class="bodyJuego">
    <video autoplay muted loop>
        <source src="./img/video_fondo_uno.mp4" type="video/mp4">
    </video>
    <header class="bg-red-500 text-amber-300 py-5 px-5 ">
        <h1 class="text-center text-5xl font-bold w-50 textoUno ">UNO !</h1>
    </header>
    <main>

        <div class="container mx-auto p-4">
            <div class="flex justify-center">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold ms-4 mb-4">Cartas</h2>
                    <div class="grid grid-cols-12 gap-4">
                       <?php 
                        if (isset($_SESSION['partida'])) {
                            $partida = $_SESSION['partida'];
                            $partida->jugar();
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    
    

</body></html>