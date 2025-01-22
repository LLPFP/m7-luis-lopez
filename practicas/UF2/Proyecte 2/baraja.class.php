<?php

class Baraja{

    public array $conjunto_cartas = [
        '0_blue, 1_blue, 2_blue, 3_blue, 4_blue, 5_blue, 6_blue, 7_blue, 8_blue, 9_blue, reverse_blue, skip_blue, picker_blue, 0_red, 1_red, 2_red, 3_red, 4_red, 5_red, 6_red, 7_red, 8_red, 9_red, reverse_red, skip_red, picker_red, 0_green, 1_green, 2_green, 3_green, 4_green, 5_green, 6_green, 7_green, 8_green, 9_green, reverse_green, skip_green, picker_green, 0_yellow, 1_yellow, 2_yellow, 3_yellow, 4_yellow, 5_yellow, 6_yellow, 7_yellow, 8_yellow, 9_yellow, reverse_yellow, skip_yellow, picker_yellow',
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