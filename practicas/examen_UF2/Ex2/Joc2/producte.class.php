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
        echo "<td>" . $this->nom . "</td>";
        echo "<td>" . $this->preu . "</td>";
        echo "</tr>";
    }

   
}
