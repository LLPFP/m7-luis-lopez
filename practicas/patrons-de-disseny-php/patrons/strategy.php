<?php
$pageTitle = "Strategy";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Strategy</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Strategy és un patró de disseny de comportament que permet definir una família d'algoritmes, col·locar cadascun d'ells en una classe separada i fer els seus objectes intercanviables.</p>
        <p class="text-gray-600 mb-4">Per exemple, en una aplicació de navegació, podríem tenir diferents estratègies per calcular rutes: en cotxe, a peu, en transport públic o en bicicleta. Cada estratègia implementaria el seu propi algoritme de càlcul de ruta, però totes serien intercanviables des del punt de vista del client.</p>
        
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface PaymentStrategy {
    public function pay($amount);
}

class CreditCardPayment implements PaymentStrategy {
    public function pay($amount) {
        return "Pagament de $amount € amb targeta de crèdit";
    }
}

class PayPalPayment implements PaymentStrategy {
    public function pay($amount) {
        return "Pagament de $amount € amb PayPal";
    }
}

class ShoppingCart {
    private $strategy;
    
    public function __construct(PaymentStrategy $strategy) {
        $this->strategy = $strategy;
    }
    
    public function checkout($amount) {
        return $this->strategy->pay($amount);
    }
}

// Ús
$cart = new ShoppingCart(new CreditCardPayment());
echo $cart->checkout(100); // "Pagament de 100 € amb targeta de crèdit"
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>