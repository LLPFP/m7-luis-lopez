<?php
session_start();

// Incluir las clases
require_once('llibre.php');
require_once('biblioteca.php');

// Inicializar la biblioteca si no existe en la sesión
if (!isset($_SESSION['biblioteca']) || !is_string($_SESSION['biblioteca'])) {
    $_SESSION['biblioteca'] = serialize(new Biblioteca()); // Crear y guardar una instancia serializada
}

// Recuperar la biblioteca desde la sesión
$biblioteca = unserialize($_SESSION['biblioteca']);

// Llibre afegir
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['titol'], $_POST['autor'], $_POST['anyPublicacio'], $_POST['foto'])) {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $anyPublicacio = $_POST['anyPublicacio'];
    $foto = $_POST['foto'];

    $llibre = new Llibre($titol, $autor, $anyPublicacio, $foto);

    $existeix = false;

    // Comprobar si el libro ya existe en la biblioteca
    foreach ($biblioteca->mostrarLlibres() as $llibreExistente) {
        if ($llibreExistente->titol == $llibre->titol && $llibreExistente->autor == $llibre->autor) {
            $existeix = true;
            break;
        }
    }

    if (!$existeix) {
        // Añadir el libro a la biblioteca
        $biblioteca->afegirLlibre($llibre);

        // Guardar la biblioteca actualizada en la sesión
        $_SESSION['biblioteca'] = serialize($biblioteca);
    }
}

// Procesar la búsqueda de libros
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['busqueda']) && !empty($_POST['busqueda'])) {
    $textBusqueda = $_POST['busqueda'];
    $llibresCercats = $biblioteca->cercarLlibre($textBusqueda);
} else {
    $llibresCercats = $biblioteca->mostrarLlibres();
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
    <!-- Cabecera con fondo verde azulado, padding 4 -->
    <header class="bg-teal-500 p-4">
        <!-- Texto blanco, centrado, tamaño muy grande y negrita -->
        <h1 class="text-5xl text-white text-center font-bold">Biblioteca</h1>
    </header>

    <!-- Formulario de búsqueda -->
    <!-- Contenedor con margen automático y padding 4 -->
    <div class="container mx-auto p-4">
        <!-- Flex para alinear al inicio, ancho máximo medio -->
        <div class="flex justify-start max-w-md">
            <!-- Formulario con fondo blanco, bordes redondeados y padding -->
            <form method="POST" action="" class="bg-white rounded px-8 pt-6">
                <h2 class="text-2xl mb-3">Cercador de llibres</h2>
                <div class="mb-6">
                    <!-- Texto gris oscuro, negrita y margen inferior -->
                    <label class="block text-gray-700 font-semibold mb-2" for="busqueda">Cercar per títol:</label>
                    <div class="flex">
                        <!-- Input que ocupa el espacio disponible, con bordes y esquina izquierda redondeada -->
                        <input type="text" id="busqueda" name="busqueda" class="flex-1 px-2 py-2 border border-gray-300 rounded-l">
                        <!-- Botón azul con texto blanco, negrita y esquina derecha redondeada -->
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
        <!-- Contenedor blanco con sombra, bordes redondeados y padding -->

        <div class="bg-white shadow-lg rounded-lg p-6 mt-5">
            <!-- Título grande, negrita y color gris oscuro -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Llibres</h2>
            <!-- Grid responsive: 1 columna en móvil, 3 en desktop -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if (count($llibresCercats) > 0): ?>
                    <?php foreach ($llibresCercats as $llibre): ?>
                        <?php echo $llibre->mostrarDetalls(); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Texto gris para mensaje de no resultados -->
                    <p class="text-gray-600">No s'ha trobat cap llibre amb aquest títol.</p>
                <?php endif; ?>
            </div>

            <!-- Formulario para agregar un nuevo libro -->


            <!-- Contenedor centrado con margen superior -->
            <div class="container mx-auto mt-12 flex justify-center">
                <!-- Ancho completo con máximo medio -->
                <div class="w-full max-w-md">
                    <!-- Título centrado, grande y gris oscuro -->
                    <h2 class="text-2xl text-center font-semibold text-gray-800 mt-5 mb-4">Afegeix un nou llibre!</h2>
                    <!-- Formulario con fondo blanco, sombra y bordes redondeados -->
                    <form method="POST" action="" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-8">
                        <div class="mb-6">
                            <!-- Labels con texto gris oscuro y negrita -->
                            <label class="block text-gray-700 font-semibold mb-2" for="titol">Títol:</label>
                            <!-- Inputs con ancho completo, bordes y esquinas redondeadas -->
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
                        <!-- Contenedor flex para centrar el botón -->
                        <div class="flex items-center justify-center">
                            <!-- Botón azul con texto blanco y efecto hover -->
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
