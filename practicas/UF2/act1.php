<?php

class Llibre
{

    public string $titol;
    public string $autor;
    public function desripcion(){
        echo "Este es el libro " . $this->titol . " y su autor es: " . $this->autor;
    }


}


?>