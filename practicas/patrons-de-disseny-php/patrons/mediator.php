<?php
$pageTitle = "Mediator";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Mediator</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Defineix un objecte que encapsula com un conjunt d'objectes interactuen, reduint l'acoblament entre ells.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Reduir dependències entre components</li>
                    <li>Centralitzar comunicacions complexes</li>
                    <li>Simplificar interaccions multidireccionals</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Gestionar comunicacions caòtiques entre múltiples objectes interdependents.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Sistemes de chat grupals</li>
            <li>Controladors de trànsit aeri</li>
            <li>Gestors de transaccions distribuidas</li>
            <li>Sistemes de notificacions</li>
            <li>Coordinació de components UI</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">📡 Com funciona?</h4>
            <div class="grid md:grid-cols-3 gap-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">1</div>
                    <p>Components registrats al Mediator</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">2</div>
                    <p>Event enviat al Mediator</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">3</div>
                    <p>Mediator distribueix als receptors</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Mediator {
    public function notify(object $sender, string $event): void;
}

class ChatRoom implements Mediator {
    private $users = [];
    
    public function registerUser(User $user): void {
        $this->users[$user->getName()] = $user;
        $user->setMediator($this);
    }
    
    public function notify(object $sender, string $event): void {
        $message = date('[H:i]') . " {$sender->getName()}: $event";
        
        foreach ($this->users as $name => $user) {
            if ($user !== $sender) {
                $user->receive($message);
            }
        }
        
        $this->logMessage($message);
    }
    
    private function logMessage(string $message): void {
        // Simulem registre en fitxer
        file_put_contents('chat.log', $message . PHP_EOL, FILE_APPEND);
    }
}

class User {
    private $name;
    private $mediator;
    
    public function __construct(string $name) {
        $this->name = $name;
    }
    
    public function setMediator(Mediator $mediator): void {
        $this->mediator = $mediator;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function send(string $message): void {
        $this->mediator->notify($this, $message);
    }
    
    public function receive(string $message): void {
        echo "{$this->name} rep: $message\n";
    }
}

// Client
$chat = new ChatRoom();

$anna = new User('Anna');
$pere = new User('Pere');
$marta = new User('Marta');

$chat->registerUser($anna);
$chat->registerUser($pere);
$chat->registerUser($marta);

$anna->send('Hola a tothom!');
$pere->send('Què tal?');
$marta->send('Bon dia!');

/* Sortida:
Pere rep: [10:00] Anna: Hola a tothom!
Marta rep: [10:00] Anna: Hola a tothom!
Anna rep: [10:00] Pere: Què tal?
Marta rep: [10:00] Pere: Què tal?
Anna rep: [10:00] Marta: Bon dia!
Pere rep: [10:00] Marta: Bon dia!
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>