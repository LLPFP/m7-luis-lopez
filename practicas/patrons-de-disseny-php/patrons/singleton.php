<?php
$pageTitle = "Singleton";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Singleton</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">El patró Singleton és un patró de disseny creacional que garanteix que una classe només tingui una única instància i proporciona un punt d'accés global a aquesta instància. És útil quan necessitem coordinar accions en tot el sistema a través d'un únic punt de control, com per exemple en la gestió de connexions a bases de dades, configuracions globals o recursos compartits.</p>
        
        
                <div class="bg-gray-100 p-4 rounded-md mb-4">
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Problemes que resol</h4>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Garanteix que una classe tingui una única instància, evitant la creació de múltiples instàncies innecessàries.</li>
                        <li>Proporciona un punt d'accés global a aquesta instància única.</li>
                        <li>Controla l'accés a recursos compartits (com bases de dades o arxius).</li>
                    </ul>
                    
                    <h4 class="text-xl font-semibold text-gray-700 mt-4 mb-2">Com funciona</h4>
                    <p class="text-gray-600 mb-2">Quan es crea un objecte i posteriorment s'intenta crear un altre nou:</p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>En lloc de rebre un objecte nou, s'obté la instància que ja existia.</li>
                        <li>Aquest comportament no es pot implementar amb un constructor normal, ja que per disseny sempre retorna un nou objecte.</li>
                        <li>S'utilitza un mètode estàtic que actua com a constructor (getInstance) que controla el procés de creació d'objectes.</li>
                    </ul>
                </div>
        

        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
class Singleton {
    private static $instance;
    
    private function __construct() {}
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function demo() {
        echo "Funció de demostració";
    }
}

// Ús
$singleton = Singleton::getInstance();
$singleton->demo();
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>