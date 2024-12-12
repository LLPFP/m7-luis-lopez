<?php

class Llibre
{




    public string $titol = "Don Quijote";
    public string $autor = "Miguel de Cervantes ";


    public function _construct(string $titol, string $autor){
        $this->titol = $titol;
        $this->autor = $autor;
    }


    public function getAutor(){
        echo "El autor es " . $this->autor;
    }

    public function desripcion(){
        echo "Este es el libro " . $this->titol . " y su autor es: " . $this->autor;
    }


}


class Persona{
    public string $nom = "Anna";
    public int $edad = 25;

    public function saludar(){
        echo "Hola soy " . $this->nom . " y tengo " . $this->edad;

    }
}


?>