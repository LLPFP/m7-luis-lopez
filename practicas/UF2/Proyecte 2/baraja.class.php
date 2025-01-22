<?php

class Baraja{

    public array $conjunto_cartas = [
        'blue_0', 'blue_1', 'blue_2', 'blue_3', 'blue_4', 'blue_5', 'blue_6', 'blue_7', 'blue_8', 'blue_9', 'blue_reverse', 'blue_skip', 'blue_+2',
        'red_0', 'red_1', 'red_2', 'red_3', 'red_4', 'red_5', 'red_6', 'red_7', 'red_8', 'red_9', 'red_reverse', 'red_skip', 'red_+2',
        'yellow_0', 'yellow_1', 'yellow_2', 'yellow_3', 'yellow_4', 'yellow_5', 'yellow_6', 'yellow_7', 'yellow_8', 'yellow_9', 'yellow_reverse', 'yellow_skip', 'yellow_+2',
        'green_0', 'green_1', 'green_2', 'green_3', 'green_4', 'green_5', 'green_6', 'green_7', 'green_8', 'green_9', 'green_reverse', 'green_skip', 'green_+2',
        'wild', 'wild_+4'
    ];


    
    public string $color;



    public function __construct()
    {
        $this->conjunto_cartas = [];
        $this->color = '';
    }


    public function crea_Baraja(){
        foreach (['red', 'yellow', 'blue', 'green'] as $color) {
            for ($i = 1; $i <= 9; $i++) {
                $this->conjunto_cartas[] = new Carta($color, $i, 'number');
            }
            // Afegeix cartes especials
            $this->conjunto_cartas[] = new Carta($color, 'reverse', 'action');
            $this->conjunto_cartas[] = new Carta($color, 'skip', 'action');
            $this->conjunto_cartas[] = new Carta($color, '+2', 'action');
        }        


    }

    public function mezcla()
    {
        shuffle($this->conjunto_cartas);
    }


    public function pinta_baraja(){
        foreach ($this->conjunto_cartas as $carta) {
            echo $carta->pinta_carta();
        }
    }


    public function pinta_baraja_girada(){
        foreach ($this->conjunto_cartas as $carta) {
            echo $carta->pinta_carta_girada();
        }

    }

}   