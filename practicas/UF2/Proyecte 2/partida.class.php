<?php
require_once('jugador.class.php');
require_once('baraja.class.php');
require_once('carta.class.php');
    

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

               // Capturar acción de robar carta
            if (isset($_GET['action']) && $_GET['action'] == 'robar') {
                $this->robar_carta_jugador_actual();
        
                // Redirigir para evitar reenvío del formulario
                echo "<script>window.location.href='index.php';</script>";
                exit;
            }


            // Capturar datos de la URL de manera segura
            $numeroCarta = $_GET['numero'];
            $paloCarta = $_GET['palo'];
            $indexCarta = $_GET['index'];

            

            // Verificar si la carta seleccionada es válida para jugar
            if ($numeroCarta == $this->carta_en_mesa->numero || $paloCarta == $this->carta_en_mesa->palo || $numeroCarta == 'four') {

                // Crear nueva carta y actualizar la carta en mesa
                $this->carta_en_mesa = new Carta($paloCarta, $numeroCarta, $indexCarta);
                
                


                // Eliminar la carta jugada de la mano del jugador
                $jugador->eliminar_carta($numeroCarta, $paloCarta, $this->turno, $this->array_jugadores);

                
                
                $this->normas_uno();
                

                // Redirigir para evitar reenvío del formulario
            header('Location: index.php');
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
                for ($i = 0; $i < 2; $i++) {
                    $this->cambiar_turno();
                }
                    break;
                    
                case 'picker': 
                    // Añadir dos carta extra a la mano del jugador actual
                    // El siguiente jugador roba 2 cartas
                    $this->cambiar_turno(); // Cambiar al siguiente jugador
                    for($i = 0; $i < 2; $i++) {
                        $this->robar_carta_jugador_actual(); // Robar 2 cartas

                    }
                    $this->cambiar_turno();

                    break;

                case 'four': 
                    if (isset($_POST['color'])) {
                        $colorElegido = $_POST['color'];
                        $this->carta_en_mesa->palo = $colorElegido;
                            
                        $this->cambiar_turno();
                        for ($i = 0; $i < 4; $i++) {
                            $this->robar_carta_jugador_actual();
                        }
                        $this->cambiar_turno();

                        } else {
                            $this->mostrarFormularioColor();
                            exit; // Detener completamente la ejecución aquí
                        }
                        break;

                default:
                    // Para cartas normales, cambiar turno una vez
                    $this->cambiar_turno();
            }
        }
        

        public function mostrarFormularioColor() {
            echo '
            <div id="colorModal" class="modal" style="display:block;">
                <div class="modal-content">
                    <h3>Elige un color</h3>
                    <form method="POST">
                        <button type="submit" name="color" value="red">Rojo</button>
                        <button type="submit" name="color" value="blue">Azul</button>
                        <button type="submit" name="color" value="green">Verde</button>
                        <button type="submit" name="color" value="yellow">Amarillo</button>
                    </form>
                </div>
            </div>
            <script>
                document.getElementById("colorModal").style.display = "block";
            </script>
            ';
        }
        

        public function robar_carta_jugador_actual() {
            // Obtener jugador actual
            $jugadorActual = $this->array_jugadores[$this->turno - 1];
            
            // Robar carta de la baraja principal
            $jugadorActual->robar_carta($this->baraja);
            
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
