<?php
$pageTitle = "Facade";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Facade</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Proporciona una interfície simplificada per a un sistema complex (classes, llibreries o frameworks).</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-yellow-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-yellow-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-yellow-700 space-y-2">
                    <li>Ocultar complexitat de subsistemes</li>
                    <li>Proveir punt d'accés únic</li>
                    <li>Reduir acoblament entre components</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Simplificar la interacció amb sistemes que requereixen múltiples passos o configuracions complexes.</p>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Simplificar APIs complexes</li>
            <li>Integració de múltiples llibreries</li>
            <li>Sistemes de configuració multi-pas</li>
            <li>Orquestració de serveis microservice</li>
        </ul>

        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">💻 Estructura del sistema</h4>
            <div class="flex items-center space-x-4">
                <div class="flex-1 text-blue-700">
                    <p>1. Subsistemes (SistemaSo, Projector, Llums)<br>
                    2. Facade (HomeTheaterFacade)<br>
                    3. Client (que interactua només amb el Facade)</p>
                </div>
               
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
// Subsistemes complexos
class SistemaSo {
    public function configurar() {
        return "Configurant sistema de so...\n";
    }
    
    public function ajustarVolum($nivell) {
        return "Volum ajustat a $nivell dB\n";
    }
}

class Projector {
    public function encendre() {
        return "Projector encès\n";
    }
    
    public function modeCinema() {
        return "Mode cinema activat\n";
    }
}

class Llums {
    public function atenuar($intensitat) {
        return "Llums atenuats al $intensitat%\n";
    }
}

// Facade
class HomeTheaterFacade {
    private $so;
    private $projector;
    private $llums;
    
    public function __construct() {
        $this->so = new SistemaSo();
        $this->projector = new Projector();
        $this->llums = new Llums();
    }
    
    public function veurePelicula() {
        $resultat = [];
        $resultat[] = $this->llums->atenuar(20);
        $resultat[] = $this->projector->encendre();
        $resultat[] = $this->projector->modeCinema();
        $resultat[] = $this->so->configurar();
        $resultat[] = $this->so->ajustarVolum(75);
        return implode('', $resultat);
    }
    
    public function acabarPelicula() {
        $resultat = [];
        $resultat[] = $this->llums->atenuar(100);
        $resultat[] = "Projector apagat\n";
        $resultat[] = "Sistema de so desactivat\n";
        return implode('', $resultat);
    }
}

// Client
$homeTheater = new HomeTheaterFacade();
echo "Iniciant pel·lícula:\n" . $homeTheater->veurePelicula();
echo "\nFi de la pel·lícula:\n" . $homeTheater->acabarPelicula();

/* Sortida:
Iniciant pel·lícula:
Llums atenuats al 20%
Projector encès
Mode cinema activat
Configurant sistema de so...
Volum ajustat a 75 dB

Fi de la pel·lícula:
Llums atenuats al 100%
Projector apagat
Sistema de so desactivat
*/
            </code>
        </pre>

     
    </div>
</main>

<?php include '../footer.php'; ?>