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
            <img src='./img/{$this->numero}_{$this->palo}.png' alt='{$this->numero} {$this->palo}'>
        </div>";
    }

    public function pinta_carta_link(): string {
        return "
        <div>
            <a href='index.php?numero={$this->numero}&palo={$this->palo}&index={$this->index}'>
                <img src='./img/{$this->numero}_{$this->palo}.png' alt='{$this->numero} {$this->palo}'>
            </a>
        </div>";

    }

    public function pinta_carta_girada(){
        return "
        <div>
            <img src='./img/carta_girada.png' alt='carta girada'>
        </div>";
    }
}