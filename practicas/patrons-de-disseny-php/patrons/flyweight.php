<?php
$pageTitle = "Flyweight";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Flyweight</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet compartir eficientment dades comuns entre múltiples objectes per estalviar memòria.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Reduir el consum de memória</li>
                    <li>Compartir dades intrínseques</li>
                    <li>Gestionar gran quantitat d'objectes lleugers</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Optimitzar aplicacions que treballen amb grans quantitats d'objectes amb dades repetides.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Processadors de text amb format ric</li>
            <li>Renderitzat de gràfics 2D amb sprites</li>
            <li>Sistemes de caching d'objectes</li>
            <li>Jocs amb molts elements similars</li>
            <li>Optimització de bases de dades</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">📊 Estalvi de Memòria</h4>
            <div class="grid md:grid-cols-2 gap-4 text-purple-700">
                <div>
                    <p class="font-semibold">Sense Flyweight:</p>
                    <p>1000 caràcters × 3 estils = 3000 objectes</p>
                </div>
                <div>
                    <p class="font-semibold">Amb Flyweight:</p>
                    <p>3 estils + 1000 caràcters = 1003 objectes</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
// Flyweight
class EstilText {
    private $font;
    private $mida;
    private $color;
    
    public function __construct($font, $mida, $color) {
        $this->font = $font;
        $this->mida = $mida;
        $this->color = $color;
    }
    
    public function aplicar($caracter) {
        return "&lt;span style='font-family: $this->font; font-size: {$this->mida}px; color: $this->color;'&gt;$caracter&lt;/span&gt;";
    }
}

// Flyweight Factory
class FabricaEstils {
    private $estils = [];
    
    public function obtenirEstil($font, $mida, $color) {
        $clau = "$font-$mida-$color";
        
        if (!isset($this->estils[$clau])) {
            $this->estils[$clau] = new EstilText($font, $mida, $color);
        }
        
        return $this->estils[$clau];
    }
    
    public function totalEstils() {
        return count($this->estils);
    }
}

// Client
class EditorText {
    private $fabrica;
    private $caracters = [];
    
    public function __construct() {
        $this->fabrica = new FabricaEstils();
    }
    
    public function afegirCaracter($caracter, $font, $mida, $color) {
        $estil = $this->fabrica->obtenirEstil($font, $mida, $color);
        $this->caracters[] = [
            'caracter' => $caracter,
            'estil' => $estil
        ];
    }
    
    public function renderitzar() {
        $output = '';
        foreach ($this->caracters as $c) {
            $output .= $c['estil']->aplicar($c['caracter']);
        }
        return $output;
    }
}

// Ús
$editor = new EditorText();

// Afegim 1000 caràcters amb només 3 estils diferents
for ($i = 0; $i < 1000; $i++) {
    $estil = match ($i % 3) {
        0 => ['Arial', 12, '#333'],
        1 => ['Times New Roman', 14, '#666'],
        2 => ['Courier New', 16, '#999']
    };
    
    $editor->afegirCaracter(chr(65 + ($i % 26)), ...$estil);
}

echo "Total estils creats: " . $editor->fabrica->totalEstils(); // 3
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>