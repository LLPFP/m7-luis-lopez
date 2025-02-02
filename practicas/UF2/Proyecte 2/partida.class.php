<?php

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

        
        // Repartir cartas iniciales si es necesario
        foreach ($this->array_jugadores as $jugador) {
            $cartas_jugador = array_slice($jugador->mano->conjunto_cartas, 0, $this->numero_cartas);
            $jugador->mano->conjunto_cartas = $cartas_jugador;
        }


        $turno_actual = $this->turno;

        foreach ($this->array_jugadores as $jugador) {
            if ($turno_actual == $jugador->id) {
                $jugador->mostrar_ma(); // Cartas normales
            } else {
                $jugador->mostrar_ma(true); // Cartas giradas
            }
        }

        // Mostrar turno actual
        echo "<div class='text-center mb-4 text-2xl font-bold'>Turno: Jugador $this->turno</div>";
        echo "<div class='text-center mb-4 text-2xl font-bold'></div>";
        echo "<div class='text-center mb-4 text-2xl font-bold'></div>";

        // Mostrar carta en mesa
        echo "<div class='flex flex-col justify-center items-center'>";
        echo "<div class='text-xl font-bold mb-2'>Carta en mesa:</div>";
        echo "<div class=''>" . $this->carta_en_mesa->pinta_carta() . "</div>";
        echo "</div>";

        
        $numeroCarta = $_GET['numero'];
        $paloCarta = $_GET['palo'];
        $indexCarta = $_GET['index'];

        var_dump($this->carta_en_mesa->numero);

        if(isset($numeroCarta) && isset($paloCarta) && ($numeroCarta == $this->carta_en_mesa->numero || $paloCarta == $this->carta_en_mesa->palo)){ 
            $cartaSeleccionada = new Carta($paloCarta, $numeroCarta, $indexCarta);
            $this->carta_en_mesa = $cartaSeleccionada;
            $this->carta_en_mesa->pinta_carta();
        }

        
        // Verificar si algún jugador ha ganado
        foreach ($this->array_jugadores as $index => $jugador) {
            if (count($jugador->mano->conjunto_cartas) == 0) {
                echo "<div class='text-center mt-4 text-2xl font-bold'>¡El jugador " . ($index + 1) . " ha ganado!</div>";
                return true;
            }
        }
        
    }
    
    public function normas_uno(){
        echo "hola";
    }

    public function cambiar_turno(){
        echo "hola";
    }

    public function cambiar_sentido(){
        echo "hola";
    }

}

?>