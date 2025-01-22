<?php
class Carta{
    public string $palo;
    public int $numero;
    public string $index;


    public function __construct(string $palo, int $numero, string $index){
        $this->palo = $palo;
        $this->numero = $numero;
        $this->index = $index;
    }


    public function pinta_carta(): string {
        return "
        <div>
            <img src='./img/cartas/'{$this->palo}_{$this->numero}.png' alt='{$this->palo} {$this->numero}'>
        </div>";
    }

    public function pinta_carta_link(): string {
        return "
        <div>
            <a href='./img/cartas/'{$this->palo}_{$this->numero}.png' target='_blank'>
                <img src='./img/cartas/'{$this->palo}_{$this->numero}.png' alt='{$this->palo} {$this->numero}'>
            </a>
        </div>";

    }

    public function pinta_carta_girada(){
        return "
        <div>
            <img src='./img/cartas/'{$this->palo}_{$this->numero}.png' alt='{$this->palo} {$this->numero}'>
        </div>";
    }
}