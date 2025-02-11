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
</header>
<nav class="bg-gray-700 p-4">
    <div class="container mx-auto px-4 flex space-x-4">
        <a href="index.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded">🏠 Inici</a>
        <div class="relative group">
            <a href="estructurals.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded flex items-center">
                Estructurals
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </a>
            <div class="absolute hidden group-hover:block w-48 bg-gray-700 rounded-md shadow-lg py-1">
                <a href="patrons/adapter.php" class="block px-4 py-2 text-white hover:bg-gray-600">Adapter</a>
                <a href="patrons/bridge.php" class="block px-4 py-2 text-white hover:bg-gray-600">Bridge</a>
                <a href="patrons/composite.php" class="block px-4 py-2 text-white hover:bg-gray-600">Composite</a>
                <a href="patrons/decorator.php" class="block px-4 py-2 text-white hover:bg-gray-600">Decorator</a>
                <a href="patrons/facade.php" class="block px-4 py-2 text-white hover:bg-gray-600">Facade</a>
                <a href="patrons/flyweight.php" class="block px-4 py-2 text-white hover:bg-gray-600">Flyweight</a>
                <a href="patrons/proxy.php" class="block px-4 py-2 text-white hover:bg-gray-600">Proxy</a>
            </div>
        </div>
        <div class="relative group">
            <a href="creacion.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded flex items-center">
                Creació
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </a>
            <div class="absolute hidden group-hover:block w-48 bg-gray-700 rounded-md shadow-lg py-1">
                <a href="patrons/factory.php" class="block px-4 py-2 text-white hover:bg-gray-600">Factory Method</a>
                <a href="patrons/abstract-factory.php" class="block px-4 py-2 text-white hover:bg-gray-600">Abstract Factory</a>
                <a href="patrons/builder.php" class="block px-4 py-2 text-white hover:bg-gray-600">Builder</a>
                <a href="patrons/prototype.php" class="block px-4 py-2 text-white hover:bg-gray-600">Prototype</a>
                <a href="patrons/singleton.php" class="block px-4 py-2 text-white hover:bg-gray-600">Singleton</a>
            </div>
        </div>
        <div class="relative group">
            <a href="comportament.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded flex items-center">
                Comportament
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </a>
            <div class="absolute hidden group-hover:block w-48 bg-gray-700 rounded-md shadow-lg py-1">
                <a href="patrons/chain.php" class="block px-4 py-2 text-white hover:bg-gray-600">Chain of Responsibility</a>
                <a href="patrons/command.php" class="block px-4 py-2 text-white hover:bg-gray-600">Command</a>
                <a href="patrons/iterator.php" class="block px-4 py-2 text-white hover:bg-gray-600">Iterator</a>
                <a href="patrons/mediator.php" class="block px-4 py-2 text-white hover:bg-gray-600">Mediator</a>
                <a href="patrons/memento.php" class="block px-4 py-2 text-white hover:bg-gray-600">Memento</a>
                <a href="patrons/observer.php" class="block px-4 py-2 text-white hover:bg-gray-600">Observer</a>
                <a href="patrons/state.php" class="block px-4 py-2 text-white hover:bg-gray-600">State</a>
                <a href="patrons/strategy.php" class="block px-4 py-2 text-white hover:bg-gray-600">Strategy</a>
                <a href="patrons/template.php" class="block px-4 py-2 text-white hover:bg-gray-600">Template Method</a>
                <a href="patrons/visitor.php" class="block px-4 py-2 text-white hover:bg-gray-600">Visitor</a>
            </div>
        </div>
    </div>
</nav>
<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Patrons de Comportament</h2>
    
    <p class="text-gray-600 mb-4">Aquests patrons gestionen la comunicació entre objectes, definint com els objectes interactuen i distribueixen responsabilitats. Ajuden a fer que el sistema sigui més flexible i mantenible, permetent que els objectes es comuniquin de manera eficient sense estar estretament acoblats. Alguns dels beneficis inclouen la reducció de dependències entre classes, millor reutilització del codi i major adaptabilitat als canvis.</p>
    
    <select 
        onchange="location = this.value;"
        class="block w-full md:w-1/2 p-2 border rounded-md bg-white border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
    >
        <option value="">Selecciona un patró...</option>
        <option value="patrons/chain.php">Chain of Responsibility</option>
        <option value="patrons/command.php">Command</option>
        <option value="patrons/iterator.php">Iterator</option>
        <option value="patrons/mediator.php">Mediator</option>
        <option value="patrons/memento.php">Memento</option>
        <option value="patrons/observer.php">Observer</option>
        <option value="patrons/state.php">State</option>
        <option value="patrons/strategy.php">Strategy</option>
        <option value="patrons/template.php">Template Method</option>
        <option value="patrons/visitor.php">Visitor</option>
    </select>
</main>

<?php include 'footer.php'; ?>