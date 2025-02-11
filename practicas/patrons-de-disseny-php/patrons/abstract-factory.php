<?php
$pageTitle = "Abstract Factory";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Abstract Factory</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet crear famílies d'objectes relacionats sense especificar les seves classes concretes.</p>
           <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Sistemes que necessiten múltiples famílies d'objectes relacionats</li>
            <li>Productes amb variants específiques per a diferents entorns</li>
            <li>Libreries UI multi-plataforma</li>
            <li>Configuracions de temes/d'estils complexes</li>
        </ul>

        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">⚡ Quan utilitzar-lo?</h4>
            <p class="text-blue-700">• Quan el sistema ha de ser independent de com es creen els objectes<br>
            • Quan necessites múltiples famílies d'objectes relacionats<br>
            • Per evitar acoblament entre productes concrets i el codi client</p>
        
    </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
// Interfícies dels productes
interface Cadira {
    public function seure(): string;
}

interface Sofa {
    public function estirar(): string;
}

interface Tauleta {
    public function posarCafè(): string;
}

// Fàbrica abstracta
interface FurnitureFactory {
    public function crearCadira(): Cadira;
    public function crearSofa(): Sofa;
    public function crearTauleta(): Tauleta;
}

// Família Moderna
class CadiraModerna implements Cadira {
    public function seure(): string {
        return "Seient modern amb corretges elàstiques";
    }
}

class SofaModerna implements Sofa {
    public function estirar(): string {
        return "Sofà modular amb llums LED";
    }
}

class TauletaModerna implements Tauleta {
    public function posarCafè(): string {
        return "Tauleta de vidre temperat amb cargol invisible";
    }
}

class FactoryModerna implements FurnitureFactory {
    public function crearCadira(): Cadira {
        return new CadiraModerna();
    }
    public function crearSofa(): Sofa {
        return new SofaModerna();
    }
    public function crearTauleta(): Tauleta {
        return new TauletaModerna();
    }
}

// Família Victoriana
class CadiraVictoricana implements Cadira {
    public function seure(): string {
        return "Cadira de fusta tallada amb vellut";
    }
}

class SofaVictoricana implements Sofa {
    public function estirar(): string {
        return "Sofà de 3 places amb peu de llauna";
    }
}

class TauletaVictoricana implements Tauleta {
    public function posarCafè(): string {
        return "Tauleta de marqueteria amb incrustacions de nacre";
    }
}

class FactoryVictoricana implements FurnitureFactory {
    public function crearCadira(): Cadira {
        return new CadiraVictoricana();
    }
    public function crearSofa(): Sofa {
        return new SofaVictoricana();
    }
    public function crearTauleta(): Tauleta {
        return new TauletaVictoricana();
    }
}

// Client
class SimuladorBotiga {
    public function crearConjunt(FurnitureFactory $factory) {
        $cadira = $factory->crearCadira();
        $sofa = $factory->crearSofa();
        $tauleta = $factory->crearTauleta();
        
        return [
            'cadira' => $cadira->seure(),
            'sofa' => $sofa->estirar(),
            'tauleta' => $tauleta->posarCafè()
        ];
    }
}

// Ús
$simulador = new SimuladorBotiga();

// Conjunt Modern
$factoryModerna = new FactoryModerna();
print_r($simulador->crearConjunt($factoryModerna));

// Conjunt Victorià
$factoryVictoricana = new FactoryVictoricana();
print_r($simulador->crearConjunt($factoryVictoricana));
            </code>
        </pre>

        </div>
</main>

<?php include '../footer.php'; ?>