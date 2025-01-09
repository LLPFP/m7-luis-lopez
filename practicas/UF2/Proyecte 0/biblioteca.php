<?php
class Biblioteca {
    private $llibres = [];

    public function __construct() {
        if (isset($_SESSION['biblioteca_llibres'])) {
            $this->llibres = $_SESSION['biblioteca_llibres'];
        }
    }

    // Agregar un libro a la biblioteca
    public function afegirLlibre(Llibre $llibre) {
        // Verificar si el libro ya existe
        foreach ($this->llibres as $llibreExistente) {
            if ($llibreExistente->titol == $llibre->titol && $llibreExistente->autor == $llibre->autor) {
                return; // El libro ya existe, no lo agregamos
            }
        }
        // Agregar el libro a la lista
        $this->llibres[] = $llibre;
        $_SESSION['biblioteca_llibres'] = $this->llibres; // Guardar los libros en la sesión
    }

    // Mostrar todos los libros
    public function mostrarLlibres() {
        return $this->llibres;
    }

    // Buscar libros por título
    public function cercarLlibre($texto) {
        return array_filter($this->llibres, function($llibre) use ($texto) {
            return strpos(strtolower($llibre->titol), strtolower($texto)) !== false;
        });
    }
}
?>
