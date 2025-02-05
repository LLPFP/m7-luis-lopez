<?php 
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario - Uno!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body class="bodyForm">
    <video autoplay muted loop>
        <source src="./img/video_fondo_uno.mp4" type="video/mp4">
    </video>
    <div class="container mx-auto p-4">


        <div class="bg-white p-4 rounded-lg shadow-lg mt-5 w-2/4 mx-auto">
        <h1 class="text-center text-4xl font-bold mb-3">Uno!</h1>
        <h2 class="text-center text-4xkl font-bold">Selecciona la cantidad de jugadores y la cantidad de cartas</h2>
        
        <form action="index.php" method="POST" class="mt-5 mb-10">
        
            <div class="flex justify-center">
                <div class="bg-slate-100 p-4 rounded-lg shadow-lg ">
                <div class="mb-4">
    <label for="jugadores" class="block text-gray-700 font-bold mb-2">Número de jugadores:</label>
    <input
        type="number"
        name="jugadores"
        min="1"
        max="5"
        id="jugadores"
        class="border border-gray-300 rounded-md px-4 py-3 w-full text-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
        required
    >
    <label for="cartas" class="block text-gray-700 font-bold mb-2 mt-5">Número de cartas:</label>
    <input
        type="number"
        name="cartas"
        min="1"
        max="7"
        id="cartas"
        class="border border-gray-300 rounded-md px-4 py-3 w-full text-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
        required
    >
    <div class="flex justify-center">
        <button
            type="submit"
            class="bg-blue-500 mt-5 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-200"
        >
            ¡Jugar!
        </button>
    </div>
</div>
                </div>
            </div>
        </form>
        </div>
    </div>
    
</body>
</html>