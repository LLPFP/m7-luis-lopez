<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice de Practicas</title>
    <!-- Incluimos Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Índice de Prácticas</h1>
        <div class="card">
            <div class="card-body">
                <?php
                function listarArchivosYCarpetas($directorio) {
                    // Verificamos si el directorio existe
                    if (!is_dir($directorio)) {
                        echo "<p class='text-danger'>El directorio especificado no existe.</p>";
                        return;
                    }

                    // Obtenemos los elementos del directorio
                    $elementos = scandir($directorio);

                    echo "<ul class='list-group'>";

                    // Recorremos cada elemento en el directorio
                    foreach ($elementos as $elemento) {
                        // Ignoramos los directorios especiales "." y ".."
                        if ($elemento == '.' || $elemento == '..') {
                            continue;
                        }

                        // Construimos la ruta completa del archivo o carpeta
                        $rutaCompleta = $directorio . DIRECTORY_SEPARATOR . $elemento;
                        $rutaRelativa = str_replace($_SERVER['DOCUMENT_ROOT'], '', $rutaCompleta);

                        // Si es un archivo, lo mostramos como enlace
                        if (is_file($rutaCompleta)) {
                            echo "<li class='list-group-item'>
                                    <a href='$rutaRelativa' target='_blank' class='text-primary'>📄 $elemento</a>
                                  </li>";
                        }

                        // Si es una carpeta, también la mostramos y llamamos a la función de forma recursiva
                        if (is_dir($rutaCompleta)) {
                            echo "<li class='list-group-item font-weight-bold text-secondary'>
                                    📁 $elemento
                                  </li>";
                            echo "<ul class='list-group ml-4'>";
                            listarArchivosYCarpetas($rutaCompleta); // Llamada recursiva para mostrar contenido de la carpeta
                            echo "</ul>";
                        }
                    }

                    echo "</ul>";
                }

                // Llamamos a la función para listar el contenido de la carpeta 'practicas'
                $directorioPracticas = __DIR__ . DIRECTORY_SEPARATOR . 'practicas';
                listarArchivosYCarpetas($directorioPracticas);
                ?>
            </div>
        </div>
    </div>

    <!-- Incluimos Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
