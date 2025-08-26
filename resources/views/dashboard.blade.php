<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Laravel + Tailwind</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col bg-gray-100">

<!-- Header -->
<header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">Laravel + Vite + Tailwind 🚀</h1>
    <nav>
        <a href="#"
           class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-400 transition">
            Get started
        </a>
    </nav>
</header>

<!-- Main Content -->
<main class="flex-1 flex items-center justify-center">
    <div class="text-center">
        <h2 class="text-4xl font-bold text-blue-600 mb-6">
            Bem-vindo ao seu painel!
        </h2>
        <p class="text-gray-700 mb-6">
            Use este template para começar a desenvolver com Laravel + Vite + Tailwind CSS rapidamente.
        </p>
        <a href="#"
           class="rounded-md bg-indigo-500 px-6 py-3 text-lg font-semibold text-white shadow hover:bg-indigo-400 transition">
            Começar Agora
        </a>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white shadow-md text-center py-4 text-gray-600">
    &copy; 2025 Laravel + Tailwind. Todos os direitos reservados.
</footer>

</body>
</html>
