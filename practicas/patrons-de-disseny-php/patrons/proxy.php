<?php
$pageTitle = "Proxy";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Proxy</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Proporciona un intermediari que actua com a substitut d'un altre objecte per controlar l'accés a ell.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Control d'accés</li>
                    <li>Caching intel·ligent</li>
                    <li>Inicialització lenta (lazy)</li>
                    <li>Monitorització d'operacions</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Gestionar l'accés a objectes complexos o recursos costosos de manera eficient.</p>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Accés a recursos remots</li>
            <li>Protecció d'accés a dades sensibles</li>
            <li>Optimització de càrrega de recursos</li>
            <li>Monitorització d'operacions</li>
            <li>Validació de permisos</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">🔒 Tipus de Proxy</h4>
            <div class="grid md:grid-cols-3 gap-4 text-purple-700">
                <div>
                    <p class="font-semibold">Virtual Proxy</p>
                    <p>Inicialització lenta d'objectes costosos</p>
                </div>
                <div>
                    <p class="font-semibold">Protection Proxy</p>
                    <p>Control d'accés i permisos</p>
                </div>
                <div>
                    <p class="font-semibold">Smart Proxy</p>
                    <p>Gestó de caches i logs</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface VideoDownloader {
    public function download($videoId): string;
}

class RealVideoDownloader implements VideoDownloader {
    public function download($videoId): string {
        // Simulem descàrrega costosa
        sleep(2);
        return "Contingut del vídeo #$videoId";
    }
}

class ProxyVideoDownloader implements VideoDownloader {
    private $realDownloader;
    private $cache = [];
    private $log = [];
    
    public function __construct() {
        $this->realDownloader = new RealVideoDownloader();
    }
    
    public function download($videoId): string {
        // Verificar cache
        if (isset($this->cache[$videoId])) {
            $this->log[] = "Vídeo #$videoId obtingut de la cache";
            return $this->cache[$videoId];
        }
        
        // Descàrrega real
        $content = $this->realDownloader->download($videoId);
        $this->cache[$videoId] = $content;
        $this->log[] = "Vídeo #$videoId descarregat i guardat a cache";
        
        return $content;
    }
    
    public function getAccessLog(): array {
        return $this->log;
    }
}

// Client
$proxy = new ProxyVideoDownloader();

// Primera descàrrega (sense cache)
echo $proxy->download(123);  // 2 segons

// Segona descàrrega (amb cache)
echo $proxy->download(123);  // Instantani

// Mostrar registres
print_r($proxy->getAccessLog());
/* Sortida:
Array (
    [0] => Vídeo #123 descarregat i guardat a cache
    [1] => Vídeo #123 obtingut de la cache
)
*/
            </code>
        </pre>

    
    </div>
</main>

<?php include '../footer.php'; ?>