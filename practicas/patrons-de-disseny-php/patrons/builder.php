<?php
$pageTitle = "Builder";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Builder</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Separa la construcció d'un objecte complex de la seva representació.</p>
        
        
                <p class="text-gray-600 mb-4">El patró Builder és un patró de disseny creacional que permet construir objectes complexos pas a pas. Aquest patró és especialment útil quan necessitem crear diferents variants d'un objecte que requereix múltiples passos de configuració.</p>
        
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <p class="text-yellow-700">
                        <strong>Problema que resol:</strong> Quan tenim objectes que requereixen una inicialització laboriosa amb molts camps i objectes niats, el codi d'inicialització pot acabar en constructors molt grans i complexos o dispersat pel codi client.
                    </p>
                </div>
        
                <div class="mb-4">
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Avantatges:</h4>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Permet construir objectes pas a pas</li>
                        <li>Permet reutilitzar el mateix codi de construcció</li>
                        <li>Principi de responsabilitat única: aïlla el codi de construcció complex</li>
                    </ul>
                </div>
        

        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
class Pizza {
    public $size;
    public $cheese = false;
    public $pepperoni = false;
}

interface PizzaBuilder {
    public function setSize($size);
    public function addCheese();
    public function addPepperoni();
    public function build(): Pizza;
}

class ConcretePizzaBuilder implements PizzaBuilder {
    private $pizza;
    
    public function __construct() {
        $this->pizza = new Pizza();
    }
    
    public function setSize($size) {
        $this->pizza->size = $size;
        return $this;
    }
    
    public function addCheese() {
        $this->pizza->cheese = true;
        return $this;
    }
    
    public function addPepperoni() {
        $this->pizza->pepperoni = true;
        return $this;
    }
    
    public function build(): Pizza {
        return $this->pizza;
    }
}

// Ús
$builder = new ConcretePizzaBuilder();
$pizza = $builder->setSize("large")
                 ->addCheese()
                 ->addPepperoni()
                 ->build();
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>