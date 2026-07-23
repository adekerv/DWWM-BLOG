@extends('layouts.app')

@section('title', 'Créer un nouveau compte')

@section('content')
<div class="flex justify-center mt-12">
    <div class="w-full max-w-2xl">
        <h1 class="text-4xl font-semibold text-center text-black mb-6">Créer un nouveau compte</h1>
        
        <div class="text-center mb-10 text-sm text-black">
            Vous êtes déjà inscrit ? <a href="{{ route('login') }}" class="underline underline-offset-4 hover:text-gray-600 transition">&rarr; Se connecter</a>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            {{-- Firstname & Lastname Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="firstname" class="block text-sm font-medium text-black mb-2">Prénom</label>
                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" required autofocus
                        class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                        placeholder="Jane">
                </div>
                <div>
                    <label for="lastname" class="block text-sm font-medium text-black mb-2">Nom</label>
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" required
                        class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                        placeholder="Sépa">
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-black mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                    placeholder="janesepa@email.com">
            </div>

            {{-- Passwords Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-black mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                        placeholder="******">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-black mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                        placeholder="******">
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-center pt-4">
                <button type="submit" class="bg-black text-white font-semibold py-3 px-10 hover:bg-gray-800 transition">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</div>
@endsection