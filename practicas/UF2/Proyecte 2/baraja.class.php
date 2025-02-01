<?php

require_once('carta.class.php');


class Baraja{

    public array $conjunto_cartas;
    public string $color;

    public $contadorIndice = 1;


    public function __construct($conjunto_cartas = [], $color = '')
    {
        $this->conjunto_cartas = $conjunto_cartas;
        $this->color = $color;
    }


    public function crea_Baraja(){

        foreach (['red', 'yellow', 'blue', 'green'] as $color) {
            for ($i = 0; $i <= 9; $i++) {
                $this->conjunto_cartas[] = new Carta($color, $i, $this->contadorIndice++);
            }
            // Afegeix cartes especials
            $this->conjunto_cartas[] = new Carta($color, 'reverse', $this->contadorIndice++);
            $this->conjunto_cartas[] = new Carta($color, 'skip', $this->contadorIndice++);
            $this->conjunto_cartas[] = new Carta($color, 'picker', $this->contadorIndice++);
        }        
    }



    public function mezcla()
    {
        shuffle($this->conjunto_cartas);
    }


    public function pinta_Baraja(){
        foreach ($this->conjunto_cartas as $carta) {
            echo $carta->pinta_carta_link();
        }

    }


    public function pinta_Baraja_girada(){
        foreach ($this->conjunto_cartas as $c) {
            echo $c->pinta_carta_girada();
        }    


    }


}   