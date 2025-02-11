<?php
$pageTitle = "Command";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Command</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Encapsula una sol·licitud com a objecte.</p>
        
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Command {
    public function execute();
}

class Light {
    public function turnOn() {
        return "Llum encesa";
    }
}

class LightOnCommand implements Command {
    private $light;
    
    public function __construct(Light $light) {
        $this->light = $light;
    }
    
    public function execute() {
        return $this->light->turnOn();
    }
}

class RemoteControl {
    private $command;
    
    public function setCommand(Command $command) {
        $this->command = $command;
    }
    
    public function pressButton() {
        return $this->command->execute();
    }
}

// Ús
$light = new Light();
$command = new LightOnCommand($light);
$remote = new RemoteControl();
$remote->setCommand($command);
echo $remote->pressButton(); // "Llum encesa"
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>