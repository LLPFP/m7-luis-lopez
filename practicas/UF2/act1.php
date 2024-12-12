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
        return "Este es el libro " . $this->titol . " y su autor es: " . $this->autor;
    }


}


class Persona{
    public string $nom = "Anna";
    public int $edad = 25;

    public function __construct(string $nom, int $edad) {
        $this->nom = $nom;
        $this->edad = $edad;
    }


    public function saludar(){
        return "Hola soy " . $this->nom . " y tengo " . $this->edad;
    }

    
}

class Producte{
    public string $nom; 
    public int $preu;

    public function mostrarPreu(){
        return "El precio es de " . $this->preu;
    }
}

class Calculadora{

    public function sumar(){

    }

    public function restar(){

    }

    public function multiplicar(){


    }

    public function dividir(){
        
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $edad = (int)$_POST['edad'];

    $persona = new Persona($nom, $edad);

    $persona->saludar();
}


?>


<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari Persona</title>
</head>
<body>

    <h2>Introdueix el teu nom i edat</h2>

    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="edad">Edat:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>