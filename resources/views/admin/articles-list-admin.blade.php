@extends('layouts.app')

@section('title', 'Admin - Liste des articles')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-light text-black">Articles</h1>
        <a href="{{ route('admin.articles.create') }}" class="bg-black text-white px-6 py-2 text-sm font-semibold hover:bg-gray-800 transition">
            + Nouvel article
        </a>
    </div>

    {{-- Admin Status Filter --}}
    <form action="{{ route('admin.articles.index') }}" method="GET" class="mb-6">
        <select name="status" onchange="this.form.submit()" class="border border-gray-400 p-3 text-sm bg-white focus:outline-none">
            <option value="">Tous les statuts</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publiés</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Brouillons</option>
        </select>
    </form>

    {{-- Admin Table --}}
    <div class="border-t border-b border-gray-400 py-2">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-300">
                    <th class="py-4 font-semibold text-sm text-gray-800 w-1/3">Titre</th>
                    <th class="py-4 font-semibold text-sm text-gray-800">Catégorie</th>
                    <th class="py-4 font-semibold text-sm text-gray-800">Statut</th>
                    <th class="py-4 font-semibold text-sm text-gray-800">Date</th>
                    <th class="py-4 font-semibold text-sm text-gray-800">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr class="border-b border-gray-200 last:border-0 hover:bg-gray-50">
                        <td class="py-4 text-sm text-black pr-4">{{ $article->title }}</td>
                        <td class="py-4 text-sm text-gray-700">{{ $article->category->name ?? 'Sans catégorie' }}</td>
                        <td class="py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                @if($article->status === 'published')
                                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                                    <span class="text-gray-700">Publié</span>
                                @else
                                    <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                                    <span class="text-gray-700">Brouillon</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 text-sm text-gray-700">
                            {{ 
                                $article->published_at?->format('d/m/Y') ?? 
                                $article->updated_at?->format('d/m/Y') ?? 
                                $article->created_at?->format('d/m/Y') ?? 
                                'Date inconnue' 
                            }}
                        </td>
                        
                        <td class="py-4 text-sm text-gray-700">
    <div class="flex items-center space-x-4">
        {{-- Functional Edit Button (Pencil Icon) --}}
        <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-black hover:text-gray-600 transition" title="Modifier">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
        </a>

        {{-- Delete Button (Cross Icon) --}}
        <a href="#" class="text-black hover:text-gray-600 transition" title="Supprimer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </a>

        {{-- View Public Details Button (External Link Icon) --}}
        <a href="{{ route('articles.details', $article->slug) }}" class="text-black hover:text-gray-600 transition" title="Voir l'article">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V12M16.5 4.5h4.5m0 0v4.5m0-4.5L11 14" />
            </svg>
        </a>
    </div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-sm text-gray-500 italic text-center">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Admin Pagination --}}
    @if ($articles->hasPages())
        <div style="display: flex; justify-content: center; align-items: center; gap: 2rem; margin-top: 3rem;">
            @if ($articles->onFirstPage())
                <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed;">&larr; Précédent</span>
            @else
                <a href="{{ $articles->previousPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none;">&larr; Précédent</a>
            @endif
            <span style="font-size: 0.875rem; font-weight: 500; color: #000;">Page {{ $articles->currentPage() }}/{{ $articles->lastPage() }}</span>
            @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none;">Suivant &rarr;</a>
            @else
                <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed;">Suivant &rarr;</span>
            @endif
        </div>
    @endif
@endsection