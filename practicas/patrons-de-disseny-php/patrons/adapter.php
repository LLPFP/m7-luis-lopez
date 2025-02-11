<?php
$pageTitle = "Adapter";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Adapter</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet col·laborar a objectes amb interfícies incompatibles convertint la interfície d'un objecte.</p>
        
      <p class="text-gray-600 mb-4">
                  El patró Adapter és especialment útil quan necessitem integrar components que treballen amb formats diferents. Per exemple:
              </p>
              
              <div class="bg-gray-100 p-4 rounded-md mb-4">
                  <h4 class="font-semibold mb-2">Cas pràctic: Anàlisi de mercat de valors</h4>
                  <p class="text-gray-700">
                      Imaginem una aplicació que:
                  </p>
                  <ul class="list-disc list-inside ml-4 text-gray-600">
                      <li>Rep dades de la borsa en format XML</li>
                      <li>Necessita utilitzar una llibreria d'anàlisi que només accepta JSON</li>
                      <li>L'Adapter converteix les dades XML a JSON permetent la comunicació entre els dos sistemes</li>
                  </ul>
              </div>
      
              <p class="text-gray-600 mb-4">
                  Aquest patró resol el problema de compatibilitat sense necessitat de modificar el codi font 
                  de la llibreria d'anàlisi ni el sistema que proporciona les dades XML.
              </p>
              <h3 class="text-2xl font-semibold text-gray-700 mb-3 mt-6">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Integrar sistemes heredats amb nous components</li>
            <li>Treballar amb llibreries de tercers amb interfícies incompatibles</li>
            <li>Proveir múltiples interfícies per a la mateixa funcionalitat</li>
        </ul>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
// Interfície objectiu (EU)
interface Enchufable {
    public function encendre();
}

// Classe adaptada (US)
class BombetaAmericana {
    public function turnOn() {
        return "Luz encendida (110V)";
    }
}

// Adapter
class AdaptadorAmericanoEuropeo implements Enchufable {
    private $bombetaAmericana;
    
    public function __construct(BombetaAmericana $bombeta) {
        $this->bombetaAmericana = $bombeta;
    }
    
    public function encendre() {
        return $this->bombetaAmericana->turnOn() . " - Convertit a 220V";
    }
}

// Client
class Interruptor {
    public function accionar(Enchufable $dispositiu) {
        return $dispositiu->encendre();
    }
}

// Ús
$bombetaUS = new BombetaAmericana();
$adapter = new AdaptadorAmericanoEuropeo($bombetaUS);
$interruptor = new Interruptor();

echo $interruptor->accionar($adapter);
// Resultat: "Luz encendida (110V) - Convertit a 220V"
            </code>
        </pre>
        
        </div>

</main>

<?php include '../footer.php'; ?>