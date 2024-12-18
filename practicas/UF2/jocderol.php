<?php 

class Campeon{
    public string $nombre;
    public int $hp;
    public int $atack;
    public int $defensa;
    public string $habilidad;


    public function _construct($nombre, $hp, $atac, $defensa, $habilidad){
        $this->nombre = $nombre;
        $this->hp = $hp;
        $this->atack = $atac;
        $this->defensa = $defensa;
        $this->habilidad = $habilidad;
    }

    public function recibirDaño($daño){

    }

    public function atacar($objectivo){

    }

}



class Jugador{
    public string $nombre;
    public $campeon;


    public function _construct($nombre){
        $this->nombre = $nombre;
    }


    public function seleccionarCampeon($campeon){

    }

    public function realizarAcciom($acciom, $objectivi){

    }
}




?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc de Rol</title>
</head>
<body>

    
</body>
</html>

  