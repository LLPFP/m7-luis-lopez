<?php


class Llibre {

    public string $titol;
    public string $autor;
    public string $anyPublicacio;
    public string $foto;

    public function __construct(string $titol, string $autor, string $anyPublicacio, string $foto)
    {
        $this->titol = $titol;
        $this->autor = $autor;
        $this->anyPublicacio = $anyPublicacio;
        $this->foto = $foto;
    }

    public function mostrarDetalls(){
        return "Aquest es el llibre " . $this->titol . " i el seu autor es: " . $this->autor . ". Es va publicar al any " . $this->anyPublicacio . ". Foto: " .$this->foto;
    }


}





class Biblioteca{

    public string $llibre;

    public function afegirLlibre(){

    }

    public function mostrarLlibre(){

    }

    public function cercarLlibre($llibre){

    }
}




?>



<!DOCTYPE html>
<html lang="es">
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

</head>
<body>


<h1 class="mt-12 text-center">Biblioteca</h1>


    <div class="container mx-auto mt-12 flex justify-center">
        <div class="w-full max-w-xs align-items-center" >
        <form method="POST" action="" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
            <div class="mb-4">
                <label class="block text-grey-700 font-bold mb-2" for="titol">Titol:</label>
                <input type="text" id="titol" name="titol" required>
            </div>
            <div class="mb-4">
                <label class="block text-grey-700 font-bold mb-2 for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div class="mb-4">
                <label class="block text-grey-700 font-bold mb-2 for="anyPublicacio">Any de Publicacio:</label>
                <input type="date" id="anyPublicacio" name="anyPublicacio" required>
            </div>
            <div class="mb-4">
                <label class="block text-grey-700 font-bold mb-2 for="foto">Foto:</label>
                <input type="text" id="foto" name="foto" required>
            </div>
            <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 font-bold py-2 px-4 rounded hover:bg-blue-700 text-white ">Afegir Llibre</button>
            </div>
    </form>
    </div>

    </div>

    <div class="container mx-auto mt-12 flex justify-center">
    <?php

    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['titol'], $_POST['autor'], $_POST['anyPublicacio'], $_POST['foto'])) {
        $titol = $_POST['titol'];
        $autor = (int)$_POST['autor'];
        $anyPublicacio = $_POST['anyPublicacio'];
        $foto = $_POST['foto'];

        $Llibre = new Llibre($titol, $autor, $anyPublicacio, $foto);

        echo $Llibre->mostrarDetalls();
    }

    ?>
    </div>    
    
</body>
</html>