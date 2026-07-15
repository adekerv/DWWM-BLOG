@extends('layouts.app')

@section('content')
    <div>
        {{-- Filters Section --}}
        <div class="flex items-center space-x-6 mb-8 border-b border-gray-300 pb-4">
            <span class="text-sm font-medium text-gray-700">Filtres :</span>
            <select class="border border-gray-450 p-3 text-sm bg-white min-w-[200px] focus:outline-none focus:ring-1 focus:ring-black">
                <option value="">Toutes les catégories</option>
                {{-- Dynamic categories loop will go here in the future --}}
            </select>
            <select class="border border-gray-400 p-3 text-sm bg-white min-w-[200px] focus:outline-none focus:ring-1 focus:ring-black">
                <option value="">Tous les tags</option>
                {{-- Dynamic tags loop will go here in the future --}}
            </select>
        </div>
    </div>

    {{-- Verification --}}
    @if($articles->isEmpty())
        <p class="text-gray-500 italic">Aucun article pour le moment.</p>
    @else
        <div class="space-y-6">
            @foreach($articles as $article)
                <div class="border border-gray-400 p-6 relative">
                    <div class="flex justify-between text-xs text-gray-600 mb-2">
                        <div>
                            {{-- Category with dynamic fallback and static tag placeholders --}}
                            [ {{ $article->category->name ?? 'Sans catégorie' }} ] [ Tag 1 ] [ Tag 2 ]
                        </div>
                        <div>
                            {{ $article->created_at ? $article->created_at->translatedFormat('j M Y') : 'Date inconnue' }}
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-semibold mb-2 text-black">{{ $article->title }}</h2>
                    
                    {{-- Content snippet --}}
                    <p class="text-sm text-gray-700 mb-6 leading-relaxed">
                        {{ Str::limit($article->content, 150) }}
                    </p>
                    
                    {{-- Action Link --}}
                    <div class="absolute bottom-6 right-6">
                        <a href="{{ route('articles.details', $article->id) }}" class="text-sm text-black hover:underline font-medium">
                            Lire &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Custom Pagination matching wireframe --}}
        @if ($articles->hasPages())
            <div style="display: flex; justify-content: center; align-items: center; gap: 2rem; margin-top: 3rem;">
                {{-- Previous Page Button --}}
                @if ($articles->onFirstPage())
                    <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed; display: inline-block; font-family: sans-serif;">
                        &larr; Précédent
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none; display: inline-block; font-family: sans-serif; transition: background 0.2s;">
                        &larr; Précédent
                    </a>
                @endif

                {{-- Progress Indicator --}}
                <span style="font-size: 0.875rem; font-weight: 500; color: #000; font-family: sans-serif;">
                    Page {{ $articles->currentPage() }}/{{ $articles->lastPage() }}
                </span>

                {{-- Next Page Button --}}
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none; display: inline-block; font-family: sans-serif; transition: background 0.2s;">
                        Suivant &rarr;
                    </a>
                @else
                    <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed; display: inline-block; font-family: sans-serif;">
                        Suivant &rarr;
                    </span>
                @endif
            </div>
        @endif
    @endif
@endsection