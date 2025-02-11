<?php
$pageTitle = "Bridge";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Bridge</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Desacobla una abstracció de la seva implementació, permetent que ambdues puguin variar independentment.</p>
        
        <div class="grid md:grid-cols-2 gap-8 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <p class="text-blue-700">
                    Separar permanentment la interfície d'un objecte de la seva implementació<br>
                    Permet canviar implementacions en temps d'execució<br>
                    Reduir l'explosió de classes en sistemes amb múltiples dimensions
                </p>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">
                    Evitar una jerarquia de classes rígida quan:<br>
                    - Hi ha múltiples variants d'una funcionalitat<br>
                    - Les implementacions poden canviar dinàmicament<br>
                    - Es necessita compartir implementacions entre objectes
                </p>
            </div>
        </div>
        
        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Sistemes amb múltiples tipus i implementacions</li>
            <li>Drivers de dispositius</li>
            <li>Connexió entre bases de dades diferents</li>
            <li>Renderitzadors gràfics multiplataforma</li>
            <li>Gestor de finestres amb diferents APIs (OpenGL/DirectX)</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">💡 Com funciona?</h4>
            <div class="flex items-center space-x-4 text-purple-700">
                <div class="flex-1">
                    <p>1. Separar l'abstracció (Control Remot)<br>
                    2. Implementació independent (Dispositiu)<br>
                    3. Connexió dinàmica en temps d'execució</p>
                </div>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
// Implementació (Dispositiu)
interface Device {
    public function powerOn(): string;
    public function powerOff(): string;
    public function adjustVolume(int $level): string;
}

class TV implements Device {
    public function powerOn(): string {
        return "TV encesa";
    }
    
    public function powerOff(): string {
        return "TV apagada";
    }
    
    public function adjustVolume(int $level): string {
        return "Volum TV ajustat a $level";
    }
}

class Radio implements Device {
    public function powerOn(): string {
        return "Ràdio encesa";
    }
    
    public function powerOff(): string {
        return "Ràdio apagada";
    }
    
    public function adjustVolume(int $level): string {
        return "Volum ràdio ajustat a $level";
    }
}

// Abstracció (Control Remot)
abstract class RemoteControl {
    protected $device;
    
    public function __construct(Device $device) {
        $this->device = $device;
    }
    
    public function togglePower(): string {
        return $this->device->powerOn() . " | " . $this->device->powerOff();
    }
    
    abstract public function volumeUp(): string;
    abstract public function volumeDown(): string;
}

class BasicRemote extends RemoteControl {
    private $volume = 10;
    
    public function volumeUp(): string {
        $this->volume++;
        return $this->device->adjustVolume($this->volume);
    }
    
    public function volumeDown(): string {
        $this->volume--;
        return $this->device->adjustVolume($this->volume);
    }
}

class AdvancedRemote extends RemoteControl {
    private $volume = 20;
    private $muted = false;
    
    public function volumeUp(): string {
        $this->volume += 2;
        return $this->device->adjustVolume($this->volume);
    }
    
    public function volumeDown(): string {
        $this->volume -= 2;
        return $this->device->adjustVolume($this->volume);
    }
    
    public function mute(): string {
        $this->muted = !$this->muted;
        return $this->muted ? "Silenci activat" : "Silenci desactivat";
    }
}

// Client
$tv = new TV();
$radio = new Radio();

$basicRemoteForTV = new BasicRemote($tv);
echo $basicRemoteForTV->togglePower(); 
echo $basicRemoteForTV->volumeUp(); // Volum TV ajustat a 11

$advancedRemoteForRadio = new AdvancedRemote($radio);
echo $advancedRemoteForRadio->volumeUp(); // Volum ràdio ajustat a 22
echo $advancedRemoteForRadio->mute(); // Silenci activat
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>