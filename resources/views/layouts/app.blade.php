<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Blog') - KING</title>
    
    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen flex flex-col antialiased">

   {{-- Global Navigation Header --}}
    <header class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-xl font-bold tracking-tight">KING</a>
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-black transition">Articles</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-black transition">Catégories</a>
                </nav>
            </div>
            
            {{-- Right side actions container --}}
            <div class="flex items-center space-x-6 text-sm font-medium">
                
                {{-- Guest Navigation (When NOT logged in) --}}
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-black underline underline-offset-4 transition">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-black underline underline-offset-4 transition">
                        S'inscrire
                    </a>
                @endguest

                {{-- Auth Navigation (When logged in) --}}
                @auth
                    {{-- User Greeting --}}
                    <span class="text-black font-semibold">
                        Bonjour, {{ Auth::user()->firstname ?? Auth::user()->name }}
                    </span>

                    {{-- Logout Form (POST request with CSRF protection) --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0 flex items-center">
                        @csrf
                        <button type="submit" class="text-gray-600 bg-transparent border-none cursor-pointer hover:text-black underline underline-offset-4 transition">
                            Se déconnecter
                        </button>
                    </form>

                    {{-- Espace Admin Button (Shown only for Admin users) --}}
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-black border border-gray-300 px-3 py-1.5 rounded hover:bg-gray-50 transition">
                            Espace Admin
                        </a>
                    @endif
                @endauth

            </div>
        </div>
    </header>

    {{-- Main Content Area --}}
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Success Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-400 text-green-800 text-sm font-medium rounded flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="font-bold text-green-600 hover:text-green-900">&times;</button>
            </div>
        @endif

        {{-- Validation Error Flash Messages --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-400 text-red-800 text-sm font-medium rounded">
                <p class="font-semibold mb-1">Veuillez corriger les erreurs suivantes :</p>
                <ul class="list-disc list-inside space-y-0.5 opacity-90">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page-Specific Content Injection --}}
        @yield('content')
        
    </main>

</body>
</html>