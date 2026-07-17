@extends('layouts.app')

@section('content')
    <div>
        {{-- Filters Section (Categories and Tags ONLY) --}}
        <form action="{{ route('articles.index') }}" method="GET" class="flex items-center space-x-6 mb-8 border-b border-gray-300 pb-4">
            <span class="text-sm font-medium text-gray-700">Filtres :</span>
            
            <select name="category" class="border border-gray-400 p-3 text-sm bg-white min-w-[200px] focus:outline-none focus:ring-1 focus:ring-black">
                <option value="">Toutes les catégories</option>
            </select>
            
            <select name="tag" class="border border-gray-400 p-3 text-sm bg-white min-w-[200px] focus:outline-none focus:ring-1 focus:ring-black">
                <option value="">Tous les tags</option>
            </select>
        </form>
    </div>

    @if($articles->isEmpty())
        <p class="text-gray-500 italic">Aucun article pour le moment.</p>
    @else
        <div class="space-y-6">
            @foreach($articles as $article)
                <div class="border border-gray-400 p-6 relative">
                    <div class="flex justify-between text-xs text-gray-600 mb-2">
                        <div>
                            [ {{ $article->category->name ?? 'Sans catégorie' }} ] [ Tag 1 ] [ Tag 2 ]
                        </div>
                        <div>
                            {{ $article->published_at ? $article->published_at->translatedFormat('d/m/Y') : '' }}
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-semibold mb-2 text-black">{{ $article->title }}</h2>
                    
                    <p class="text-sm text-gray-700 mb-6 leading-relaxed">
                        {{ Str::limit($article->content, 150) }}
                    </p>
                    
                    <div class="absolute bottom-6 right-6">
                        {{-- UPDATED TO USE SLUG --}}
                        <a href="{{ route('articles.details', $article->slug) }}" class="text-sm text-black hover:underline font-medium">
                            Lire &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Custom Pagination --}}
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
    @endif
@endsection