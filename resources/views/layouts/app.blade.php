<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dynamic Title for each page -->
    <title>@yield('title', 'Mon Blog')</title>
    <!-- Add your CSS / Tailwind framework here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased font-sans">

    <!-- Global Header (Persistent on all screens) -->
    <header class="border-b border-gray-300 max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo / Placeholder box -->
        <div class="w-12 h-12 border-2 border-black flex items-center justify-center relative">
            <span class="absolute inset-0 flex items-center justify-center text-xl font-light">KING</span>
        </div>
        
        <!-- Authentication Links -->
        <nav class="space-x-4 text-sm font-medium">
            <a href="#" class="underline hover:text-gray-600">Se connecter</a>
            <a href="#" class="underline hover:text-gray-600">S'inscrire</a>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- This is where your individual pages will insert themselves -->
        @yield('content')
    </main>

</body>
</html>