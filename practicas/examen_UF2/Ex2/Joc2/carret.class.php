<?php

class Carret {
    public $productes =[];

    public function afegirProductes($producte){
        $this->productes[] = $producte;
    }

    public function mostrarProductes(){
        $this->productes;
    }

    public function calcularTotal(){
        $total = 0;
        foreach ($this->productes as $producte) {
            $total += $producte->preu;
        }
        return "Total: " . $total;
        
    }
}


