<?php

class Biblioteca
{
    public array $llibres = [];

    public function afegirLlibre($llibre)
    {
        $this->llibres[] = $llibre;
    }

    public function mostrarLlibres()
    {
        return $this->llibres;
    }

    public function cercarLlibre($text)
    {
        $resultats = [];
        foreach ($this->llibres as $llibre) {
            if (stripos($llibre->titol, $text) !== false) {
                $resultats[] = $llibre;
            }
        }
        return $resultats;
    }
}
?>
