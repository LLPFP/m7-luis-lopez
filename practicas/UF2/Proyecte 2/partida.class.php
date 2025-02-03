    <?php
    require_once('jugador.class.php');
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

            // Mostrar carta en mesa
            echo "<div class='flex flex-col justify-center items-center'>";
            echo "<div class='text-xl font-bold mb-2'>Carta en mesa:</div>";
            echo "<div class=''>" . $this->carta_en_mesa->pinta_carta() . "</div>";
            echo "</div>";

            // Capturar datos de la URL de manera segura
            $numeroCarta = $_GET['numero'] ?? null;
            $paloCarta = $_GET['palo'] ?? null;
            $indexCarta = $_GET['index'] ?? null;

        
                // Verificar si la carta seleccionada es válida para jugar
                if ($numeroCarta == $this->carta_en_mesa->numero || $paloCarta == $this->carta_en_mesa->palo) {
                    // Crear nueva carta y actualizar la carta en mesa
                    $this->carta_en_mesa = new Carta($paloCarta, $numeroCarta, $indexCarta);
                    
                    $jugador->eliminar_carta($numeroCarta, $paloCarta, $this->turno, $this->array_jugadores);
                
                    

                    $this->normas_uno();

                    // Mostrar la nueva carta en mesa
                    echo "<script>window.location.href = 'index.php';</script>";

                    exit;
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
            $carta = $this->carta_en_mesa;
            
            switch($carta->numero){
                case 'reverse':
                    $this->cambiar_sentido();
                    $this->cambiar_turno();
                    break;
                    
                case 'skip':
                    // Saltar siguiente jugador: cambiar turno dos veces
                    $this->cambiar_turno();
                    $this->cambiar_turno();
                    break;
                    
                case 'picker': 
                    // Añadir dos carta extra a la mano del jugador actual


                default:
                    // Para cartas normales, cambiar turno una vez
                    $this->cambiar_turno();
            }
        }
        


        public function robar_carta(){
            
        }

        public function cambiar_turno(){
            if ($this->constante_sentido == 1) {
                $this->turno = ($this->turno % $this->numero_jugadores) + 1;
            } else {
                $this->turno = ($this->turno - 2 + $this->numero_jugadores) % $this->numero_jugadores + 1;
            }
        }

        public function cambiar_sentido(){
            $this->constante_sentido *= -1;
            $this->turno = ($this->turno - 1 + $this->numero_jugadores) % $this->numero_jugadores + 1;
        }
    }
    ?>
