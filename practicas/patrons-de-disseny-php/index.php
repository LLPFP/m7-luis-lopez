<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Patrons de Disseny' ?> - PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<header class="bg-gray-800 text-white py-4">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Patrons de Disseny en PHP</h1>
    </div>
</nav>
</header>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Introducció als Patrons de Disseny</h1>
    
    <div class="prose max-w-none mb-8">
        <p class="text-gray-700 mb-4">Els patrons de disseny són solucions provades i documentades per a problemes comuns en el desenvolupament de programari. Aquests patrons ofereixen un llenguatge comú entre desenvolupadors i ajuden a crear codi més mantenible i reutilitzable.</p>
        
        <p class="text-gray-700 mb-4">Els patrons de disseny van ser popularitzats pel llibre "Design Patterns: Elements of Reusable Object-Oriented Software" escrit per la "Gang of Four" (GoF). Representen les millors pràctiques desenvolupades per experts en programació orientada a objectes al llarg dels anys.</p>
        
        <p class="text-gray-700 mb-4">Alguns dels beneficis clau d'utilitzar patrons de disseny inclouen:</p>
        
        <ul class="list-disc pl-6 mb-4 text-gray-700">
            <li>Reutilització de solucions provades per problemes comuns</li>
            <li>Establiment d'un vocabulari comú entre desenvolupadors</li>
            <li>Implementació de principis SOLID i bones pràctiques</li>
            <li>Millora en la flexibilitat i mantenibilitat del codi</li>
            <li>Reducció del temps de desenvolupament</li>
        </ul>
        
        <p class="text-gray-700 mb-4">Els patrons es divideixen principalment en tres categories: creacionals (per a la creació d'objectes), estructurals (per a la composició de classes i objectes) i de comportament (per a la comunicació entre objectes). Cada patró té el seu propi propòsit i context d'aplicació específic.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="estructurals.php" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">Patrons Estructurals</h3>
            <p class="text-gray-600">S'enfoquen en com les classes i objectes es composen per formar estructures més grans. Ajuden a assegurar que quan una part del sistema canvia, no cal canviar tota l'estructura. Exemples inclouen Adapter, Bridge i Composite.</p>
        </a>
        
        <a href="creacion.php" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-semibold text-green-600 mb-2">Patrons de Creació</h3>
            <p class="text-gray-600">Proporcionen mecanismes de creació d'objectes que augmenten la flexibilitat i la reutilització del codi. Tracten amb la instanciació d'objectes de manera adequada per a cada situació. Exemples són Singleton, Factory Method i Builder.</p>
        </a>
        
        <a href="comportament.php" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-semibold text-purple-600 mb-2">Patrons de Comportament</h3>
            <p class="text-gray-600">S'ocupen de la comunicació efectiva i l'assignació de responsabilitats entre objectes. Defineixen com els objectes interactuen i distribueixen responsabilitats. Inclouen Observer, Strategy i Command.</p>
        </a>
    </div>
</main>

<?php include 'footer.php'; ?>