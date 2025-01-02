<?php

// 1. Definició d'una classe bàsica: Classe Cotxe
class Cotxe
{
    public string $marca = "Sense marca";
    public string $model = "Sense model";

    public function __construct(string $marca = "Sense marca", string $model = "Sense model")
    {
        $this->marca = $marca;
        $this->model = $model;
    }

    public function descripcio(): string
    {
        return "Aquest cotxe és un " . $this->marca . " " . $this->model . ".";
    }
}

// Exemple d'ús:
$cotxe1 = new Cotxe();
$cotxe2 = new Cotxe("Tesla", "Model S");

echo $cotxe1->descripcio() . "<br>"; // Valors per defecte
echo $cotxe2->descripcio() . "<br>"; // Valors personalitzats

// 2. Classe Persona amb constructor
class Persona
{
    public string $nom;
    public int $edat;

    public function __construct(string $nom, int $edat)
    {
        $this->nom = $nom;
        $this->edat = $edat;
    }

    public function benvinguda(): string
    {
        return "Hola, sóc " . $this->nom . " i tinc " . $this->edat . " anys.";
    }
}

// Exemple d'ús:
$persona1 = new Persona("Anna", 25);
$persona2 = new Persona("Joan", 30);

echo $persona1->benvinguda() . "<br>";
echo $persona2->benvinguda() . "<br>";

// 3. Classe Calculadora amb mètode sumar
class Calculadora
{
    public function sumar(float $a, float $b): float
    {
        return $a + $b;
    }
}

// Exemple d'ús:
$calculadora = new Calculadora();
echo "La suma de 5 i 10 és: " . $calculadora->sumar(5, 10) . "<br>";

// 4. Interacció amb HTML i la Classe Persona
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['edat'])) {
    $nom = $_POST['nom'];
    $edat = (int)$_POST['edat'];

    $personaForm = new Persona($nom, $edat);
    echo $personaForm->benvinguda() . "<br>";
}

// 5. Classe Animal amb atributs personalitzats i mètodes amb retorn personalitzat
class Animal
{
    public string $nom;
    public string $tipus;

    public function __construct(string $nom, string $tipus)
    {
        $this->nom = $nom;
        $this->tipus = $tipus;
    }

    public function saludar(): string
    {
        return "Hola, sóc un " . $this->tipus . " i em dic " . $this->nom . ".";
    }
}

// Exemple d'ús:
$animal = new Animal("Simba", "lleó");
echo $animal->saludar() . "<br>";

// 6. Classe Producte i llista d'objectes en taula HTML
class Producte
{
    public string $nom;
    public float $preu;

    public function __construct(string $nom, float $preu)
    {
        $this->nom = $nom;
        $this->preu = $preu;
    }
}

// Llista de productes
$productes = [
    new Producte("Llibre", 15.99),
    new Producte("Ordinador", 899.50),
    new Producte("Telèfon", 699.00),
];

echo "<table border='1'>";
echo "<tr><th>Nom</th><th>Preu (€)</th></tr>";
foreach ($productes as $producte) {
    echo "<tr><td>" . $producte->nom . "</td><td>" . number_format($producte->preu, 2) . "</td></tr>";
}
echo "</table>";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Exercicis PHP</title>
</head>
<body>
    <h2>Formulari per crear una Persona</h2>
    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="edat">Edat:</label>
        <input type="number" id="edat" name="edat" required>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
