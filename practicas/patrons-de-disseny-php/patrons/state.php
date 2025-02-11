<?php
$pageTitle = "State";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró State</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet que un objecte alteri el seu comportament quan el seu estat intern canvia.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Gestionar màquines d'estat</li>
                    <li>Canviar comportament dinàmicament</li>
                    <li>Reduir condicionals complexos</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Eliminar lògica condicional complexa gestionant múltiples estats d'un objecte.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Màquines de venda amb estats</li>
            <li>Workflows de documents</li>
            <li>Estats de comanda (pendent, enviat, entregat)</li>
            <li>Jocs amb estats de personatge</li>
            <li>Processos d'aprovació</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">📊 Diagrama d'estats</h4>
            <div class="flex justify-center items-center space-x-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-lg">Draft</div>
                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    <p class="text-sm">publicar()</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-lg">Published</div>
                    <svg class="w-6 h-6 mx-auto transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    <p class="text-sm">arxivar()</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-lg">Archived</div>
                    <svg class="w-6 h-6 mx-auto transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    <p class="text-sm">modificar()</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface State {
    public function publicar(): void;
    public function modificar(): void;
    public function arxivar(): void;
}

class Document {
    private $state;
    
    public function __construct() {
        $this->transitionTo(new DraftState());
    }
    
    public function transitionTo(State $state): void {
        $this->state = $state;
        $this->state->setDocument($this);
    }
    
    public function publicar(): void {
        $this->state->publicar();
    }
    
    public function modificar(): void {
        $this->state->modificar();
    }
    
    public function arxivar(): void {
        $this->state->arxivar();
    }
}

abstract class BaseState implements State {
    protected $document;
    
    public function setDocument(Document $document): void {
        $this->document = $document;
    }
}

class DraftState extends BaseState {
    public function publicar(): void {
        echo "Document publicat!\n";
        $this->document->transitionTo(new PublishedState());
    }
    
    public function modificar(): void {
        echo "Ja estàs en mode edició\n";
    }
    
    public function arxivar(): void {
        echo "No pots arxivar un esborrany\n";
    }
}

class PublishedState extends BaseState {
    public function publicar(): void {
        echo "El document ja està publicat\n";
    }
    
    public function modificar(): void {
        echo "Tornant a mode esborrany per editar\n";
        $this->document->transitionTo(new DraftState());
    }
    
    public function arxivar(): void {
        echo "Document arxivat!\n";
        $this->document->transitionTo(new ArchivedState());
    }
}

class ArchivedState extends BaseState {
    public function publicar(): void {
        echo "No es pot publicar des de l'arxiu\n";
    }
    
    public function modificar(): void {
        echo "Desarxivant per editar...\n";
        $this->document->transitionTo(new DraftState());
    }
    
    public function arxivar(): void {
        echo "El document ja està arxivat\n";
    }
}

// Client
$document = new Document();

$document->publicar();    // Publica el document
$document->modificar();   // Retorna a Draft
$document->arxivar();     // No permès
$document->publicar();    // Publica de nou
$document->arxivar();     // Arxiva

/* Sortida:
Document publicat!
Tornant a mode esborrany per editar
No pots arxivar un esborrany
Document publicat!
Document arxivat!
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>