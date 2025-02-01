<?php

require_once('baraja.class.php');
require_once('baraja.class.php');
require_once('carta.class.php');
require_once('jugador.class.php');
require_once('partida.class.php');


class Jugador {
    public $mano;
    public $id;

    public function __construct($mano, $id) {
        $this->mano = $mano;
        $this->id = $id;
    }

    public function afegir_carta() {
    }

    public function eliminar_carta() {
    }
    public function mostrar_ma() {
        echo "<div class='bg-gray-100 rounded-lg shadow-md p-4'>";
        echo "<h2 class='mb-5'>Jugador $this->id</h2>";
        echo "<div class='grid grid-cols-2 gap-2'>";
        
        foreach ($this->mano->conjunto_cartas as $carta) {
            echo "<div class='transform hover:scale-105 transition-transform duration-200'>";
            echo $carta->pinta_carta_link();
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
}