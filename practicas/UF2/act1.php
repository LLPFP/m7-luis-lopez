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
        
        return "Hola soy " . $this->nom . " y tengo " . $this->edad ;
    }

    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['edat'])) {
    $nom = $_POST['nom'];
    $edat = (int)$_POST['edat'];

    $persona = new Persona($nom, (int) $edat);
    echo $persona->saludar();
}


class Producte
{
    public string $nom;
    public float $preu;

    public function __construct(string $nom, float $preu)
    {
        $this->nom = $nom;
        $this->preu = $preu;
    }

    public function mostrarPreu(){
        return "El preu es de: " .$this->preu ;
    }

    public function filasTabla(): string
    {
        return "<tr><td>" . $this->nom . "</td><td>" . $this->preu . "€</td></tr>";
    }
}

$productes = [
    new Producte("Llibre", 12.50),
    new Producte("Llapis", 0.99),
    new Producte("Portàtil", 899.99),
];

echo "<table border='1'><tr><th>Nom</th><th>Preu</th></tr>";
foreach ($productes as $producte) {
    echo $producte->filasTabla();
}
echo "</table>";


class Calculadora{

    public function sumar(int $a, int $b){
        return $a+$b;

    }

    public function restar(int $a, int $b){
        return $a-$b;

    }

    public function multiplicar(int $a, int $b){
        return $a*$b;

    }

    public function dividir(int $a, int $b){

        if($b==0){
            return "No se puede devidir entre zero.";
        }else{
            return $a / $b;
        }


    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $edad = (int)$_POST['edad'];

    $persona = new Persona($nom, $edad);

    $persona->saludar();
}


class Animal
{
    public string $nom;
    public string $tipus;

    public function __construct(string $nom, string $tipus)
    {
        $this->nom = $nom;
        $this->tipus = $tipus;
    }

    public function descriure(): string
    {
        return "L'animal és un " . $this->tipus . " i es diu " . $this->nom . ".";
    }
}

// Processament del formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['tipus'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $tipus = htmlspecialchars($_POST['tipus']);

    $animal = new Animal($nom, $tipus);
    echo $animal->descriure();
}




?>


<!DOCTYPE html>
<html>
<head>
    <title>Exercicis PHP</title>
</head>
<body>
    <!-- Exercici 6: Crear una Persona -->
    <h2>Crear una Persona</h2>
    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="edat">Edat:</label>
        <input type="number" id="edat" name="edat" required>
        <button type="submit">Crear Persona</button>
    </form>

    <br>

    <h2>Crear un Animal</h1>
    <form method="POST" action="">
        <label for="nom">Nom de l'animal:</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="tipus">Tipus d'animal:</label>
        <input type="text" id="tipus" name="tipus" required>
        <br>
        <button type="submit">Descripció</button>
    </form>

</body>
</html>
