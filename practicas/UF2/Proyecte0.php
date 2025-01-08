<?php

session_start();  // Asegúrate de que la sesión esté iniciada al principio del archivo.

class Llibre {
    public string $titol;
    public string $autor;
    public string $anyPublicacio;
    public string $foto;

    public function __construct(string $titol, string $autor, string $anyPublicacio, string $foto) {
        $this->titol = $titol;
        $this->autor = $autor;
        $this->anyPublicacio = $anyPublicacio;
        $this->foto = $foto;
    }

    public function mostrarDetalls() {
        return "Aquest es el llibre " . $this->titol . " i el seu autor es: " . $this->autor . ". Es va publicar al any " . $this->anyPublicacio . ". Foto: <img src='" .$this->foto . "'>";
    }
}

class Biblioteca {
    public array $llibres = [];

    public function afegirLlibre($llibre) {
        $this->llibres[] = $llibre;
    }

    public function mostrarLlibres() {
        return $this->llibres;
    }

    public function cercarLlibre($text) {
        $resultats = [];
        foreach ($this->llibres as $llibre) {
            if (stripos($llibre->titol, $text) !== false) {
                $resultats[] = $llibre;
            }
        }
        return $resultats;
    }
}

// Comprovar si la biblioteca ja existeix a la sessió
if (!isset($_SESSION['biblioteca']) || !$_SESSION['biblioteca'] instanceof Biblioteca) {
    $_SESSION['biblioteca'] = new Biblioteca();  // Crear una nova biblioteca si no existe
}

// Afegir llibre inicial si no existeix ningú llibre
if (count($_SESSION['biblioteca']->mostrarLlibres()) == 0) {
    $_SESSION['biblioteca']->afegirLlibre(new Llibre("El Gran Gatsby", "F. Scott Fitzgerald", "1925", "https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg/220px-The_Great_Gatsby_Cover_1925_Retouched.jpg"));
}

// Llibre afegir
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['titol'], $_POST['autor'], $_POST['anyPublicacio'], $_POST['foto'])) {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $anyPublicacio = $_POST['anyPublicacio'];
    $foto = $_POST['foto'];

    $llibre = new Llibre($titol, $autor, $anyPublicacio, $foto);

    // Afegir el llibre a la biblioteca
    $_SESSION['biblioteca']->afegirLlibre($llibre);
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style>
    body{
        background-color:rgb(243, 243, 243);
    }
  </style>
</head>
<body>

<h1 class="mt-12 text-center text-4xl font-bold text-gray-700">Biblioteca</h1>

<!-- Llista de llibres -->
<div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Llibres actuals</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($_SESSION['biblioteca']->mostrarLlibres() as $llibre): ?>
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <img src="<?php echo $llibre->foto; ?>" alt="Foto del llibre" class="w-full h-40 object-cover rounded mb-4">
                <h3 class="text-lg font-bold text-gray-800"><?php echo $llibre->titol; ?></h3>
                <p class="text-gray-600"><?php echo $llibre->autor; ?></p>
                <p class="text-gray-600">Any: <?php echo $llibre->anyPublicacio; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="mt-6">
    <div class="flex max-w-md">
        <form method="POST" action="" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-2">
            <h2 class="text-2xl mb-3">Cercador de llibres</h2>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="titol">Títol:</label>
                <div class="flex">
                    <input type="text" id="titol" name="titol" class="flex-1 px-2 py-2 border border-gray-300 rounded-l" required>
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-6 rounded-r hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mx-auto mt-12 flex justify-center">
    <div class="w-full max-w-md">
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

</body>
</html>
