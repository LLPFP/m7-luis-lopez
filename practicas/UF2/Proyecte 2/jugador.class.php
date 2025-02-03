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

    public function robar_carta(&$barajaPrincipal) {
        if (!empty($barajaPrincipal->conjunto_cartas)) {
            // Toma la primera carta de la baraja principal
            $cartaRobada = array_shift($barajaPrincipal->conjunto_cartas);
            
            // Añade la carta a la mano del jugador
            $this->mano->conjunto_cartas[] = $cartaRobada;
        }
    }

    public function eliminar_carta($numeroCarta, $paloCarta, $turno, $array_jugadores) {
         // Eliminar la carta jugada de la mano del jugador
         foreach ($array_jugadores as $jugador) {
            if ($jugador->id == $turno) {
                foreach ($jugador->mano->conjunto_cartas as $key => $carta) {
                    if ($carta->numero == $numeroCarta && $carta->palo == $paloCarta) {
                        unset($jugador->mano->conjunto_cartas[$key]); // Quita la carta jugada
                        break;
                    }
                }
                // Reindexar array después de eliminar
                $jugador->mano->conjunto_cartas = array_values($jugador->mano->conjunto_cartas);
                break;
            }
        }
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