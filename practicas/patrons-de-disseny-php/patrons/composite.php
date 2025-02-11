<?php
$pageTitle = "Composite";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Composite</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet tractar objectes individuals i composicions d'objectes de manera uniforme.</p>
        
        
                <p class="text-gray-600 mb-4">El patró Composite permet compondre objectes en estructures d'arbre i treballar amb aquestes estructures com si fossin objectes individuals. És especialment útil quan el model central de l'aplicació es pot representar en forma d'arbre.</p>
        
                <h4 class="text-xl font-semibold text-gray-700 mb-2">Problema que resol</h4>
                <p class="text-gray-600 mb-4">Imaginem que tenim dos tipus d'objectes: Productes i Caixes. Una Caixa pot contenir diversos Productes i també altres Caixes més petites. Aquestes Caixes petites també poden contenir Productes o més Caixes, formant una estructura d'arbre.</p>
        
                <h4 class="text-xl font-semibold text-gray-700 mb-2">Exemple pràctic</h4>
                <p class="text-gray-600 mb-4">En un sistema de comandes, necessitem calcular el preu total d'una comanda que pot contenir tant productes individuals com caixes amb més productes o caixes. El patró Composite ens permet tractar tots aquests elements de manera uniforme, simplificant el càlcul del preu total.</p>
        

        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface Component {
    public function render();
}

class Leaf implements Component {
    public function render() {
        return "Renderitzant fulla";
    }
}

class Composite implements Component {
    private $children = [];
    
    public function add(Component $component) {
        $this->children[] = $component;
    }
    
    public function render() {
        $output = "";
        foreach ($this->children as $child) {
            $output .= $child->render() . "\n";
        }
        return $output;
    }
}

// Ús
$composite = new Composite();
$composite->add(new Leaf());
$composite->add(new Leaf());
echo $composite->render();
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>