@extends('layouts.app')

@section('title', 'Admin - Créer une catégorie')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        
        {{-- Success Flash Notification --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-light text-black mb-6">Nouvelle catégorie</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de la catégorie</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}" 
                       required 
                       class="w-full border @error('name') border-red-500 @else @enderror p-3 text-sm focus:outline-none">
                
                {{-- Show validation error (e.g., "Cette catégorie existe déjà.") --}}
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-black text-white px-6 py-2 text-sm font-semibold hover:bg-gray-800 transition">
                    Enregistrer
                </button>
                <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-600 hover:underline">Annuler</a>
            </div>
        </form>
    </div>
@endsection