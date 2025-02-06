<?php

class Usuari {
    public $nom;
    public $edat;
    public $correu;

    public function __construct($nom, $edat, $correu)
    {
        $this->nom = $nom;
        $this->edat = $edat;
        $this->correu = $correu;
    }

    public function validarDades(){
        if (!is_numeric($this->edat) || strpos($this->correu, '@') === false){
            return false;        }
        
        return true;
    }
}