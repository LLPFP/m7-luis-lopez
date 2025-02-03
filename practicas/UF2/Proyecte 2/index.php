<?php 


require_once('jugador.class.php');
require_once('partida.class.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['jugadores'], $_POST['cartas'])) {
    $numJugadores = $_POST['jugadores'];
    $numCartas = $_POST['cartas'];

    $array_jugadores = [];

    // 1. Crear baraja principal
    $barajaPrincipal = new Baraja();
    $barajaPrincipal->crea_Baraja();
    $barajaPrincipal->mezcla();

    // 2. Repartir cartas a jugadores
    for ($i = 0; $i < $numJugadores; $i++) {
        // Tomar cartas de la baraja principal
        $manoInicial = array_splice($barajaPrincipal->conjunto_cartas, 0, $numCartas);
        
        // Crear mano del jugador
        $manoJugador = new Baraja();
        $manoJugador->conjunto_cartas = $manoInicial;
        
        $jugador = new Jugador($manoJugador, $i);
        $array_jugadores[] = $jugador;
    }

    // 3. Obtener carta inicial para la mesa
    $cartaInicial = array_shift($barajaPrincipal->conjunto_cartas);

    // 4. Crear partida con configuración correcta
    $partida = new Partida(
        $numJugadores,
        $numCartas,
        1,                          // Turno inicial
        $barajaPrincipal,           // Baraja restante
        $cartaInicial,              // Primera carta en mesa
        $array_jugadores,
        1                           // Sentido del juego
    );
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
                    <div class="grid grid-cols-8 gap-4">
                       <?php 
                        if (isset($_SESSION['partida'])) {
                            $partida = $_SESSION['partida'];
                            $partida->jugar();
                        }

                        
?>
                        <div></div>
                        <div class="flex flex-col items-center">
                            <h2 class="text-2xl font-bold">Robar</h2>
                            <a href="index.php?action=robar">
                            <img src="./img/carta_girada.png" alt="carta_girada" class="w-16 h-24">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    
    

</body></html>