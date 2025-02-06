<?php

class Animal{
    public $nom;

    function __construct($nom){
        $this->nom = $nom;
    }

    function getNom(){
        return $this->nom;
    }
}


$gos = new Animal("Toby");
echo $gos->getNom();
?>