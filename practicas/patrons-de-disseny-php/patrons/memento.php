<?php
$pageTitle = "Memento";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Memento</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet capturar i externalitzar l'estat intern d'un objecte sense violar l'encapsulació.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Implementar funcionalitat de desfer</li>
                    <li>Guardar i restaurar estats</li>
                    <li>Mantenir històric d'estats</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Gestionar versions anteriors d'un objecte sense exposar els seus detalls interns.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Editors de text amb funcionalitat de desfer</li>
            <li>Jocs amb sistema de guardat</li>
            <li>Transaccions de bases de dades</li>
            <li>Control de versions</li>
            <li>Configuracions de sistemes</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">⏳ Components del patró</h4>
            <div class="grid md:grid-cols-3 gap-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Originador</div>
                    <p>EditorText<br>(Guarda l'estat actual)</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Memento</div>
                    <p>Instantània de l'estat<br>(Conté contingut i data)</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Caretaker</div>
                    <p>Historial<br>(Gestiona versions)</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
class EditorText {
    private $contingut;
    
    public function escriure($text) {
        $this->contingut .= $text;
    }
    
    public function mostrar() {
        return $this->contingut;
    }
    
    public function crearMemento(): Memento {
        return new Memento($this->contingut);
    }
    
    public function restaurarMemento(Memento $memento) {
        $this->contingut = $memento->obtenirContingut();
    }
}

class Memento {
    private $contingut;
    private $data;
    
    public function __construct($contingut) {
        $this->contingut = $contingut;
        $this->data = date('Y-m-d H:i:s');
    }
    
    public function obtenirContingut() {
        return $this->contingut;
    }
    
    public function obtenirData() {
        return $this->data;
    }
}

class Historial {
    private $mementos = [];
    
    public function afegir(Memento $memento) {
        $this->mementos[] = $memento;
    }
    
    public function ultimMemento(): ?Memento {
        if (!empty($this->mementos)) {
            return array_pop($this->mementos);
        }
        return null;
    }
}

// Client
$editor = new EditorText();
$historial = new Historial();

// Edició 1
$editor->escriure('Primera línea de text');
$historial->afegir($editor->crearMemento());

// Edició 2
$editor->escriure("\nSegona línea amb més contingut");
echo "Estat actual:\n" . $editor->mostrar();

// Desfer última edició
$mementoAnterior = $historial->ultimMemento();
if ($mementoAnterior) {
    $editor->restaurarMemento($mementoAnterior);
}

echo "\n\nEstat després de desfer:\n" . $editor->mostrar();

/* Sortida:
Estat actual:
Primera línea de text
Segona línea amb més contingut

Estat després de desfer:
Primera línea de text
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>