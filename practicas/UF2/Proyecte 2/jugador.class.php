<?php

require_once('baraja.class.php');
require_once('carta.class.php');


class Jugador {
    public $mano;
    public $id;

    public function __construct($mano, $id) {
        $this->mano = $mano;
        $this->id = $id+1;
    }

    public function afegir_carta() {
    }

    // jugador.class.php
    public function eliminar_carta() {
    
    }


    public function mostrar_ma($giradas = false) {
    echo "<div class='bg-gray-100 rounded-lg shadow-md p-4'>";
    echo "<h2 class='mb-5'>Jugador $this->id</h2>";
    echo "<div class='grid grid-cols-2 gap-2'>";
    
    foreach ($this->mano->conjunto_cartas as $carta) {
        echo "<div class='transform hover:scale-105 transition-transform duration-200'>";
        if ($giradas) {
            echo $carta->pinta_carta_girada();
        } else {
            echo $carta->pinta_carta_link();
        }
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
}
}