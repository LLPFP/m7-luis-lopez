<?php
$pageTitle = "Observer";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Observer</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Defineix una dependència d'un-a-molts entre objectes, de manera que quan un objecte canvia d'estat, tots els seus dependents són notificats i actualitzats automàticament.</p>
        
        
                <div class="bg-gray-100 p-4 rounded-md mb-6">
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Propòsit</h4>
                    <p class="text-gray-600 mb-4">Observer és un patró de disseny de comportament que permet definir un mecanisme de subscripció per notificar a diversos objectes sobre qualsevol esdeveniment que succeeixi a l'objecte que estan observant.</p>
                    
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Problema</h4>
                    <p class="text-gray-600 mb-4">Imagina que tens dos tipus d'objectes: un objecte Client i un objecte Botiga. El client està molt interessat en una marca particular de producte (per exemple, un nou model d'iPhone) que estarà disponible a la botiga molt aviat.</p>
                    
                    <p class="text-gray-600">El client pot visitar la botiga cada dia per comprovar la disponibilitat del producte. Però, mentre el producte està en camí, la majoria d'aquestes visites seran en va.</p>
                </div>
        


        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

interface Observer {
    public function update($subject);
}

class Newsletter implements Subject {
    private $observers = [];
    private $lastNews;
    
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    public function detach(Observer $observer) {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }
    
    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    
    public function publishNews($news) {
        $this->lastNews = $news;
        $this->notify();
    }
    
    public function getLastNews() {
        return $this->lastNews;
    }
}

class Subscriber implements Observer {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function update($subject) {
        echo "{$this->name} ha rebut: {$subject->getLastNews()}\n";
    }
}

// Ús
$newsletter = new Newsletter();

$subscriber1 = new Subscriber("Anna");
$subscriber2 = new Subscriber("Pere");

$newsletter->attach($subscriber1);
$newsletter->attach($subscriber2);

$newsletter->publishNews("Nova versió de PHP disponible!");
// Sortida:
// Anna ha rebut: Nova versió de PHP disponible!
// Pere ha rebut: Nova versió de PHP disponible!

$newsletter->detach($subscriber2);
$newsletter->publishNews("Taller de patrons de disseny proper dijous!");
// Sortida:
// Anna ha rebut: Taller de patrons de disseny proper dijous!
            </code>
        </pre>
        
        <h3 class="text-2xl font-semibold text-gray-700 mb-3 mt-6">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Sistemes de notificacions en temps real</li>
            <li>Actualitzacions de preus en aplicacions de comerç electrònic</li>
            <li>Sistemes de publicació/subscripció (Pub/Sub)</li>
            <li>Monitorització d'estat d'aplicacions</li>
        </ul>
        
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">🔍 Com funciona?</h4>
            <p class="text-blue-700">1. El Subject manté una llista d'Observers<br>
            2. Quan ocorre un canvi, crida el mètode notify()<br>
            3. Cada Observer rep la notificació i executa update()</p>
        </div>
    </div>
</main>

<?php include '../footer.php'; ?>