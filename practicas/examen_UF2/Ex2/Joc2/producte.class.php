<?php

class Producte{
    public $nom;
    public $preu;


    public function __construct($nom, $preu)
    {
        $this->nom = $nom;
        $this->preu = $preu;
    }

    public function detallesProducte(){
        echo "<tr>";
        echo "<td class='border border-dark'>" . $this->nom . "</td>";
        echo "<td class='border border-dark'>" . $this->preu . "</td>";
        echo "</tr>";
    }

   
}
