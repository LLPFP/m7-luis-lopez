<?php
$pageTitle = "Prototype";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Prototype</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet crear nous objectes clonant instàncies existents.</p>
        
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
abstract class Shape {
    public $x;
    public $y;
    public $color;
    
    public function __clone() {}
}

class Rectangle extends Shape {
    public $width;
    public $height;
}

// Ús
$original = new Rectangle();
$original->width = 10;
$original->height = 20;
$original->color = "blue";

$copia = clone $original;
$copia->color = "red"; // Modificació independent
            </code>
        </pre>
    </div>
</main>

<?php include '../footer.php'; ?>