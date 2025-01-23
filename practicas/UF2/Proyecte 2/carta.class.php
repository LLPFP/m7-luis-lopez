<?php
class Carta{
    public  $palo;
    public  $numero;
    public  $index;


    public function __construct( $palo , $numero,  $index){
        $this->palo = $palo;
        $this->numero = $numero;
        $this->index = $index;
    }


    public function pinta_carta(): string {
        return "
        <div>
            <img src='./img/'{$this->numero}_{$this->palo}.png' alt='{$this->numero} {$this->palo}'>
        </div>";
    }

    public function pinta_carta_link(): string {
        return "
        <div>
            <a href='index.php?.$this->numero&$this->palo&$this->index'>
                <img src='./img/{$this->numero}_{$this->palo}.png' alt='{$this->numero} {$this->palo}'>
            </a>
        </div>";

    }

    public function pinta_carta_girada(){
        return "
        <div>
            <img src='./img/cartas/''>
        </div>";
    }
}