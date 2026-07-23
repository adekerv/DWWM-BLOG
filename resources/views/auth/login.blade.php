@extends('layouts.app')

@section('title', 'Se connecter')

@section('content')
<div class="flex justify-center mt-12">
    <div class="w-full max-w-md">
        <h1 class="text-4xl font-semibold text-center text-black mb-10">Se connecter</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-black mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                    placeholder="janesepa@email.com">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-black mb-2">Mot de passe</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-400 p-3 text-gray-900 focus:outline-none focus:border-black"
                    placeholder="******">
            </div>

            {{-- Submit --}}
            <div class="flex justify-center pt-4">
                <button type="submit" class="bg-black text-white font-semibold py-3 px-8 hover:bg-gray-800 transition">
                    Se connecter
                </button>
            </div>
        </form>

        {{-- Register Link --}}
        <div class="mt-8 text-center text-sm text-black">
            Pas encore de compte ? <br>
            <a href="{{ route('register') }}" class="underline underline-offset-4 hover:text-gray-600 transition">&rarr; S'inscrire</a>
        </div>
    </div>
</div>
@endsection