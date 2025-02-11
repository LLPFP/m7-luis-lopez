<?php
$pageTitle = "Visitor";
include '../header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patró Visitor</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Explicació teòrica</h3>
        <p class="text-gray-600 mb-4">Permet separar algoritmes dels objectes sobre els quals operen, permetent afegir noves operacions sense modificar les classes dels objectes.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800 mb-2">🎯 Propòsit</h4>
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    <li>Afegir operacions sense canviar classes</li>
                    <li>Agrupar operacions relacionades</li>
                    <li>Operacions sobre estructures complexes</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800 mb-2">🔍 Problema Resolt</h4>
                <p class="text-green-700">Implementar noves funcionalitats sobre una estructura d'objectes estable sense modificar-la.</p>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mt-6 mb-3">Casos d'ús</h3>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Exportació a múltiples formats</li>
            <li>Validació de objectes complexos</li>
            <li>Càlcul de mètriques sobre estructures</li>
            <li>Renderitzat de UI multiplataforma</li>
            <li>Operacions de manteniment (backup, logging)</li>
        </ul>

        <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800 mb-2">🔗 Estructura del patró</h4>
            <div class="grid md:grid-cols-4 gap-4 text-purple-700">
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Visitor</div>
                    <p>Interfície amb mètodes visit</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">ConcreteVisitor</div>
                    <p>HTMLExportVisitor<br>MarkdownExportVisitor</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Element</div>
                    <p>DocumentElement<br>(accept() method)</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 p-2 rounded-full mb-2">Client</div>
                    <p>Itera elements<br>i aplica visitor</p>
                </div>
            </div>
        </div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Exemple de codi</h3>
        <pre class="bg-gray-800 text-gray-100 p-4 rounded-md overflow-x-auto">
            <code class="text-sm">
interface DocumentVisitor {
    public function visitParagraph(Paragraph $paragraph);
    public function visitImage(Image $image);
    public function visitTable(Table $table);
}

interface DocumentElement {
    public function accept(DocumentVisitor $visitor);
}

// Elements del document
class Paragraph implements DocumentElement {
    public function __construct(private string $text) {}
    
    public function accept(DocumentVisitor $visitor) {
        $visitor->visitParagraph($this);
    }
    
    public function getText(): string {
        return $this->text;
    }
}

class Image implements DocumentElement {
    public function __construct(private string $src, private string $alt) {}
    
    public function accept(DocumentVisitor $visitor) {
        $visitor->visitImage($this);
    }
    
    public function getSrc(): string {
        return $this->src;
    }
    
    public function getAlt(): string {
        return $this->alt;
    }
}

class Table implements DocumentElement {
    public function __construct(private array $rows) {}
    
    public function accept(DocumentVisitor $visitor) {
        $visitor->visitTable($this);
    }
    
    public function getRows(): array {
        return $this->rows;
    }
}

// Visitors
class HTMLExportVisitor implements DocumentVisitor {
    private $output = '';
    
    public function visitParagraph(Paragraph $paragraph) {
        $this->output .= "&lt;p&gt;{$paragraph->getText()}&lt;/p&gt;\n";
    }
    
    public function visitImage(Image $image) {
        $this->output .= "&lt;img src='{$image->getSrc()}' alt='{$image->getAlt()}'&gt;\n";
    }
    
    public function visitTable(Table $table) {
        $this->output .= "&lt;table&gt;\n";
        foreach ($table->getRows() as $row) {
            $this->output .= "  &lt;tr&gt;&lt;td&gt;" . implode("&lt;/td&gt;&lt;td&gt;", $row) . "&lt;/td&gt;&lt;/tr&gt;\n";
        }
        $this->output .= "&lt;/table&gt;\n";
    }
    
    public function getHTML(): string {
        return $this->output;
    }
}

class MarkdownExportVisitor implements DocumentVisitor {
    private $output = '';
    
    public function visitParagraph(Paragraph $paragraph) {
        $this->output .= "{$paragraph->getText()}\n\n";
    }
    
    public function visitImage(Image $image) {
        $this->output .= "![{$image->getAlt()}]({$image->getSrc()})\n";
    }
    
    public function visitTable(Table $table) {
        foreach ($table->getRows() as $row) {
            $this->output .= "| " . implode(" | ", $row) . " |\n";
        }
        $this->output .= "\n";
    }
    
    public function getMarkdown(): string {
        return $this->output;
    }
}

// Client
$documentElements = [
    new Paragraph("Benvingut al nostre document"),
    new Image("foto.jpg", "Descripció de la imatge"),
    new Table([["Dada 1", "Dada 2"], ["Valor A", "Valor B"]])
];

// Exportar a HTML
$htmlVisitor = new HTMLExportVisitor();
foreach ($documentElements as $element) {
    $element->accept($htmlVisitor);
}
echo "HTML Export:\n" . $htmlVisitor->getHTML();

// Exportar a Markdown
$mdVisitor = new MarkdownExportVisitor();
foreach ($documentElements as $element) {
    $element->accept($mdVisitor);
}
echo "\nMarkdown Export:\n" . $mdVisitor->getMarkdown();
            </code>
        </pre>

     
    </div>
</main>

<?php include '../footer.php'; ?>