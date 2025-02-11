<?php
$pageTitle = "Template Method";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Template Method</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Defineix l'esquelet d'un algoritme en una operació, delegant alguns passos a les subclasses.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Reutilitzar estructura d'algoritme</li>
                    <li>Permetre personalització de passos</li>
                    <li>Evitar duplicació de codi</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Implementar variants d'un algoritme sense duplicar l'estructura comuna.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Processament de dades en múltiples formats</li>
            <li>Fluxos de treball estandarditzats</li>
            <li>Generació de informes</li>
            <li>Pipelines d'execució</li>
            <li>Validació de formularis</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">📐 Estructura del patró</h4>
            <div class="grid md:grid-cols-3 gap-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Abstracte</div>
                    <p>ProcessadorDades<br>(Defineix l'esquelet)</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Concret</div>
                    <p>ProcessadorCSV<br>(Implementa passos específics)</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Client</div>
                    <p>Utilitza el mètode plantilla<br>sense modificar l'estructura</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
abstract class ProcessadorDades {
    // Mètode plantilla
    final public function procesar() {
        $this->obrirConnexió();
        $dades = $this->llegirDades();
        $dadesProcessades = $this->processarDades($dades);
        $this->guardarResultats($dadesProcessades);
        $this->tancarConnexió();
    }
    
    protected function obrirConnexió() {
        echo "Connexió oberta\n";
    }
    
    protected function tancarConnexió() {
        echo "Connexió tancada\n\n";
    }
    
    abstract protected function llegirDades(): array;
    abstract protected function processarDades(array $dades): array;
    abstract protected function guardarResultats(array $resultats): void;
}

class ProcessadorCSV extends ProcessadorDades {
    protected function llegirDades(): array {
        echo "Llegint dades de CSV...\n";
        return ['dades' => 'exemple.csv'];
    }
    
    protected function processarDades(array $dades): array {
        echo "Processant {$dades['dades']}...\n";
        return ['resultat' => 'dades_processades.csv'];
    }
    
    protected function guardarResultats(array $resultats): void {
        echo "Guardant {$resultats['resultat']}...\n";
    }
}

class ProcessadorJSON extends ProcessadorDades {
    protected function llegirDades(): array {
        echo "Llegint dades de JSON...\n";
        return ['dades' => 'exemple.json'];
    }
    
    protected function processarDades(array $dades): array {
        echo "Validant i transformant {$dades['dades']}...\n";
        return ['resultat' => 'dades_processades.json'];
    }
    
    protected function guardarResultats(array $resultats): void {
        echo "Exportant {$resultats['resultat']}...\n";
    }
}

// Client
$processadorCSV = new ProcessadorCSV();
echo "Processant CSV:\n";
$processadorCSV->procesar();

$processadorJSON = new ProcessadorJSON();
echo "Processant JSON:\n";
$processadorJSON->procesar();

/* Sortida:
Processant CSV:
Connexió oberta
Llegint dades de CSV...
Processant exemple.csv...
Guardant dades_processades.csv...
Connexió tancada

Processant JSON:
Connexió oberta
Llegint dades de JSON...
Validant i transformant exemple.json...
Exportant dades_processades.json...
Connexió tancada
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>