<?php 
session_start();

require_once('carta.class.php');
require_once('baraja.class.php');


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
<body>
    <header class="bg-red-400 text-white py-5 px-5">
        <h1 class="text-center text-5xl font-bold ">Uno!</h1>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div class="flex justify-center">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Cartas</h2>
                    <div class="grid grid-cols-4 gap-4">
                        <?php 
                        
                        pinta_carta


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    
    
</body>
</html>