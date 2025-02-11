<?php
$pageTitle = "Decorator";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Decorator</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Afegeix funcionalitats dinàmicament a objectes.</p>
        
    <p class="text-gray-600 mb-4">El patró Decorator permet afegir noves funcionalitats a objectes existents sense alterar la seva estructura. Actua com una capa envoltant al voltant d'objectes concrets.</p>
            
            <h4 class="text-xl font-semibold text-gray-700 mb-2">Problema a resoldre</h4>
            <p class="text-gray-600 mb-4">En el context d'una biblioteca de notificacions, inicialment es té una classe Notificador simple que envia missatges per correu electrònic. La implementació base només permet enviar notificacions bàsiques, però es necessita afegir més funcionalitats com:</p>
            
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Enviar notificacions per SMS</li>
                <li>Enviar notificacions per Slack</li>
                <li>Guardar notificacions en una base de dades</li>
                <li>Afegir formats especials als missatges</li>
            </ul>
    
            <p class="text-gray-600 mb-4">El patró Decorator permet afegir aquestes noves funcionalitats de manera modular, envoltant l'objecte base amb decoradors que afegeixen el nou comportament.</p>
    

        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Coffee {
    public function cost();
}

class SimpleCoffee implements Coffee {
    public function cost() {
        return 2;
    }
}

abstract class CoffeeDecorator implements Coffee {
    protected $coffee;
    
    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }
}

class MilkDecorator extends CoffeeDecorator {
    public function cost() {
        return $this->coffee->cost() + 0.5;
    }
}

class WhipDecorator extends CoffeeDecorator {
    public function cost() {
        return $this->coffee->cost() + 0.7;
    }
}

// Ús
$coffee = new SimpleCoffee();
$coffee = new MilkDecorator($coffee);
$coffee = new WhipDecorator($coffee);
echo $coffee->cost(); // 3.2
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>