<?php
session_start();

// Incluir las clases
require_once('llibre.php');
require_once('biblioteca.php');

// Asegúrate de que la biblioteca esté correctamente inicializada
if (!isset($_SESSION['biblioteca']) || !$_SESSION['biblioteca'] instanceof Biblioteca) {
    $_SESSION['biblioteca'] = new Biblioteca();  // Crear una nueva instancia si no existe
        $_SESSION['biblioteca'] = serialize($_SESSION['biblioteca']);

}




// Llibre afegir
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['titol'], $_POST['autor'], $_POST['anyPublicacio'], $_POST['foto'])) {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $anyPublicacio = $_POST['anyPublicacio'];
    $foto = $_POST['foto'];

    $llibre = new Llibre($titol, $autor, $anyPublicacio, $foto);

    $existeix = false;


    // Comprobar si el libro ya existe en la biblioteca
    foreach ($_SESSION['biblioteca']->mostrarLlibres() as $llibreExistente) {
        if ($llibreExistente->titol == $llibre->titol && $llibreExistente->autor == $llibre->autor) {
            $existeix = true;
            break;
        }
    }

    if (!$existeix) {
        // Añadir el libro a la biblioteca
        $_SESSION['biblioteca']->afegirLlibre($llibre);


    }
}

// Procesar la búsqueda de libros
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['busqueda']) && !empty($_POST['busqueda'])) {
    $textBusqueda = $_POST['busqueda'];
    $llibresCercats = $_SESSION['biblioteca']->cercarLlibre($textBusqueda);
} else {

    $llibresCercats = $_SESSION['biblioteca']->mostrarLlibres();

}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: rgb(243, 243, 243);
        }
    </style>
</head>

<body>
    <header class="bg-teal-500 p-4">
        <h1 class="text-5xl text-white text-center font-bold">Biblioteca</h1>
    </header>

    <!-- Formulario de búsqueda -->
    <div class="container mx-auto p-4">
        <div class="flex justify-start max-w-md">
            <form method="POST" action="" class="bg-white rounded px-8 pt-6">
                <h2 class="text-2xl mb-3">Cercador de llibres</h2>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="busqueda">Cercar per títol:</label>
                    <div class="flex">
                        <input type="text" id="busqueda" name="busqueda" class="flex-1 px-2 py-2 border border-gray-300 rounded-l">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-6 rounded-r hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Llista de llibres -->
        <div class="bg-white shadow-lg rounded-lg p-6 mt-5">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Llibres</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if (count($llibresCercats) > 0): ?>
                    <?php foreach ($llibresCercats as $llibre): ?>
                        <?php echo $llibre->mostrarDetalls(); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600">No s'ha trobat cap llibre amb aquest títol.</p>
                <?php endif; ?>
            </div>
            <!-- Formulario para agregar un nuevo libro -->
        <div class="container mx-auto mt-12 flex justify-center">
            <div class="w-full max-w-md">
                <h2 class="text-2xl text-center font-semibold text-gray-800 mt-5 mb-4">Afegeix un nou llibre!</h2>
                <form method="POST" action="" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-8">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="titol">Títol:</label>
                        <input type="text" id="titol" name="titol" class="w-full px-2 py-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" class="w-full px-2 py-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="anyPublicacio">Any de Publicació:</label>
                        <input type="date" id="anyPublicacio" name="anyPublicacio" class="w-full px-2 py-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="foto">Foto:</label>
                        <input type="text" id="foto" name="foto" class="w-full px-2 py-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-700">
                            Afegir Llibre
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        

    </div>
</body>

</html>
