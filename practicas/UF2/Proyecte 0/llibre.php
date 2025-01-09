<?php

class Llibre
{
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

    public function mostrarDetalls()
    {
        return "
            <div class='bg-gray-50 p-4 rounded-lg shadow'>
                <img src='{$this->foto}' alt='Foto del llibre' class='w-full h-40 object-cover rounded mb-4'>
                <h3 class='text-lg font-bold text-gray-800'>{$this->titol}</h3>
                <p class='text-gray-600'>Autor: {$this->autor}</p>
                <p class='text-gray-600'>Any: {$this->anyPublicacio}</p>
            </div>
        ";
    }
}
?>
