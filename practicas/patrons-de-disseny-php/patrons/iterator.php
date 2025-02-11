<?php
$pageTitle = "Iterator";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Iterator</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Proporciona una manera d'accedir seqüencialment als elements d'una col·lecció sense exposar la seva representació interna.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Recórrer col·leccions complexes</li>
                    <li>Ocultar l'estructura interna</li>
                    <li>Proveir múltiples formes de recorregut</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Accedir a elements d'estructures de dades complexes sense conèixer els detalls d'implementació.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Recorregut d'estructures d'arbres</li>
            <li>Accés a resultats de bases de dades</li>
            <li>Col·leccions personalitzades</li>
            <li>Implementació de filtres</li>
            <li>Traversar elements en múltiples formats</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">🔄 Flux de l'Iterador</h4>
            <div class="flex items-center justify-center space-x-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">1</div>
                    <p>Inicialitzar</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">2</div>
                    <p>Validar</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">3</div>
                    <p>Obtenir actual</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">4</div>
                    <p>Següent</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface IteratorInterface {
    public function current();
    public function next();
    public function key();
    public function valid(): bool;
    public function rewind();
}

interface AggregateInterface {
    public function getIterator(): IteratorInterface;
}

class Book {
    public function __construct(
        private string $title,
        private string $author
    ) {}
    
    public function getInfo(): string {
        return "$this->title - $this->author";
    }
}

class LibraryCollection implements AggregateInterface {
    private $books = [];
    
    public function addBook(Book $book) {
        $this->books[] = $book;
    }
    
    public function getIterator(): IteratorInterface {
        return new LibraryIterator($this->books);
    }
}

class LibraryIterator implements IteratorInterface {
    private $position = 0;
    
    public function __construct(
        private array $books
    ) {}
    
    public function current() {
        return $this->books[$this->position];
    }
    
    public function next() {
        $this->position++;
    }
    
    public function key() {
        return $this->position;
    }
    
    public function valid(): bool {
        return isset($this->books[$this->position]);
    }
    
    public function rewind() {
        $this->position = 0;
    }
}

// Client
$library = new LibraryCollection();
$library->addBook(new Book("El Quixot", "Miguel de Cervantes"));
$library->addBook(new Book("1984", "George Orwell"));
$library->addBook(new Book("Ulisses", "James Joyce"));

$iterator = $library->getIterator();

while ($iterator->valid()) {
    $book = $iterator->current();
    echo $book->getInfo() . "\n";
    $iterator->next();
}

/* Sortida:
El Quixot - Miguel de Cervantes
1984 - George Orwell
Ulisses - James Joyce
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>