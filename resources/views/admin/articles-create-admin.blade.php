@extends('layouts.app')

@section('title', 'Nouvel article')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    {{-- Back Link --}}
    <div>
        <a href="{{ route('admin.articles.index') }}" class="text-sm text-black hover:underline">
            &larr; Retour à la liste
        </a>
    </div>

    {{-- Update Form Action --}}
    <form action="{{ route('admin.articles.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Titre --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full border border-gray-400 p-2 focus:outline-none focus:border-black" required>
        </div>

        {{-- Catégorie Selector --}}
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
            <select id="category_id" name="category_id" class="border border-gray-400 p-2 w-64 bg-white focus:outline-none focus:border-black" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tags (Mockup based on wireframe) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
            <div class="flex items-center space-x-2">
                <span class="bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full flex items-center gap-2">Tag 1 <button type="button" class="font-bold">&times;</button></span>
                <span class="bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full flex items-center gap-2">Tag 2 <button type="button" class="font-bold">&times;</button></span>
                <button type="button" class="border border-gray-400 px-3 py-1 text-xs rounded-full hover:bg-gray-100">+ Ajouter un tag</button>
            </div>
        </div>

        {{-- Contenu --}}
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu <span class="text-red-500">*</span></label>
            <textarea id="content" name="content" rows="12" class="w-full border border-gray-400 p-2 focus:outline-none focus:border-black resize-y" required>{{ old('content') }}</textarea>
        </div>

        {{-- Statut --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
            <div class="flex items-center space-x-6">
                <label class="flex items-center text-sm cursor-pointer">
                    <input type="radio" name="status" value="draft" class="mr-2 border-gray-400 text-black focus:ring-black" {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                    Brouillon
                </label>
                <label class="flex items-center text-sm cursor-pointer">
                    <input type="radio" name="status" value="published" class="mr-2 border-gray-400 text-black focus:ring-black" {{ old('status') === 'published' ? 'checked' : '' }}>
                    Publié
                </label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex justify-end space-x-4 pt-6">
            <a href="{{ route('admin.articles.index') }}" class="border border-gray-400 text-black px-6 py-2 text-sm font-semibold hover:bg-gray-100 transition">
                Annuler
            </a>
            <button type="submit" class="bg-black text-white px-6 py-2 text-sm font-semibold hover:bg-gray-800 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection