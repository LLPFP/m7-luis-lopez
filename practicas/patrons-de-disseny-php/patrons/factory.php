<?php
$pageTitle = "Factory Method";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Factory Method</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Proporciona una interfície per crear objectes però permet a les subclasses decidir quina classe instanciar.</p>
        
                <div class="bg-gray-100 p-4 rounded-md mb-4">
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Problema</h4>
                    <p class="text-gray-600">Imagina que estàs creant una aplicació de gestió logística. La primera versió de la teva aplicació només és capaç de gestionar el transport en camió, per la qual cosa la major part del teu codi es troba dins de la classe Camió. Al cap d'un temps, la teva aplicació es torna bastant popular. Cada dia reps desenes de peticions d'empreses de transport marítim perquè incorporis la logística per mar a l'aplicació.</p>
                </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Transport {
    public function deliver();
}

class Truck implements Transport {
    public function deliver() {
        return "Entrega per camió";
    }
}

class Ship implements Transport {
    public function deliver() {
        return "Entrega per vaixell";
    }
}

abstract class Logistics {
    abstract public function createTransport(): Transport;
    
    public function planDelivery() {
        $transport = $this->createTransport();
        return $transport->deliver();
    }
}

class RoadLogistics extends Logistics {
    public function createTransport(): Transport {
        return new Truck();
    }
}

class SeaLogistics extends Logistics {
    public function createTransport(): Transport {
        return new Ship();
    }
}

// Ús
$logistics = new RoadLogistics();
echo $logistics->planDelivery(); // "Entrega per camió"
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>