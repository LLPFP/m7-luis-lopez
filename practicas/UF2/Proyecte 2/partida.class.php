<?php

require_once('carta.class.php');
require_once('baraja.class.php');

class Partida{
    public $numero_jugadores;
    public $numero_cartas;
    public $turno;
    public $baraja;
    public $carta_en_mesa;
    public $array_jugadores = [];
    public $constante_sentido;


    public function __construct($numero_jugadores, $numero_cartas, $turno, $baraja, $carta_en_mesa, $array_jugadores, $constante_sentido)
    {
        $this->numero_jugadores = $numero_jugadores;
        $this->numero_cartas = $numero_cartas;
        $this->turno = $turno;
        $this->baraja = $baraja;
        $this->carta_en_mesa = $carta_en_mesa;
        $this->array_jugadores = $array_jugadores;
        $this->constante_sentido = $constante_sentido;
    }


    public function jugar(){
        foreach ($this->array_jugadores as $jugador) {
            $jugador->baraja->mezcla();
            $jugador->baraja->pinta_Baraja();
    }
    }

}

?>