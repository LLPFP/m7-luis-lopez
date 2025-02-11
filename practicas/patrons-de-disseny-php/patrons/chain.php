<?php
$pageTitle = "Chain of Responsibility";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Chain of Responsibility</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet passar sol·licituds al llarg d'una cadena de manejadors fins que un objecte la processi.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Desacoblar l'emissor i receptor</li>
                    <li>Permetre múltiples manejadors</li>
                    <li>Decidir dinàmicament qui processa la petició</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Gestionar sol·licituds on múltiples objectes poden processar-la sense conèixer el receptor final.</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Sistemes de gestió d'errors</li>
            <li>Processament de comandes</li>
            <li>Sistemes d'aprovació multi-nivell</li>
            <li>Filtres de seguretat</li>
            <li>Middlewares en aplicacions web</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">🔗 Flux de la Cadena</h4>
            <div class="flex items-center justify-center space-x-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">1</div>
                    <p>Sol·licitud</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">2</div>
                    <p>Handler 1</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">3</div>
                    <p>Handler 2</p>
                </div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full">4</div>
                    <p>Handler 3</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
abstract class Logger {
    const INFO = 1;
    const DEBUG = 2;
    const ERROR = 3;

    protected $level;
    protected $nextLogger;

    public function setNext(Logger $logger) {
        $this->nextLogger = $logger;
        return $logger;
    }

    public function logMessage($level, $message) {
        if ($this->level <= $level) {
            $this->write($message);
        }
        
        if ($this->nextLogger !== null) {
            $this->nextLogger->logMessage($level, $message);
        }
    }

    abstract protected function write($message);
}

class ConsoleLogger extends Logger {
    public function __construct($level) {
        $this->level = $level;
    }
    
    protected function write($message) {
        echo "Consola: $message\n";
    }
}

class FileLogger extends Logger {
    public function __construct($level) {
        $this->level = $level;
    }
    
    protected function write($message) {
        echo "Arxiu: $message\n";
    }
}

class ErrorLogger extends Logger {
    public function __construct($level) {
        $this->level = $level;
    }
    
    protected function write($message) {
        echo "ERROR: $message\n";
    }
}

// Configurar cadena
$errorLogger = new ErrorLogger(Logger::ERROR);
$fileLogger = new FileLogger(Logger::DEBUG);
$consoleLogger = new ConsoleLogger(Logger::INFO);

$errorLogger->setNext($fileLogger)->setNext($consoleLogger);

// Provar la cadena
$errorLogger->logMessage(Logger::INFO, "Missatge informatiu");
$errorLogger->logMessage(Logger::DEBUG, "Depurant codi");
$errorLogger->logMessage(Logger::ERROR, "Error crític!");

/* Sortida:
Consola: Missatge informatiu
Arxiu: Depurant codi
Consola: Depurant codi
ERROR: Error crític!
Arxiu: Error crític!
Consola: Error crític!
*/
            </code>
        </pre>

    </div>
</main>

<?php include '../footer.php'; ?>