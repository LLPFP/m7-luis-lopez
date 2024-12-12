<?php

class Llibre
{

    public string $titol = "Don Quijote";
    public string $autor = "Miguel de Cervantes ";
    public function desripcion(){
        echo "Este es el libro " . $this->titol . " y su autor es: " . $this->autor;
    }


}


?>