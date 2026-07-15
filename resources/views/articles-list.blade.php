@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-6">Liste des articles</h1>
    </div>

    {{-- Verification --}}
    @if($articles->isEmpty())
        <p class="text-gray-500 italic">Aucun article pour le moment.</p>
    @else
        <div class="space-y-6">
            @foreach($articles as $article)
                <div class="border border-gray-400 p-6 relative">
                    <div class="flex justify-between text-xs text-gray-600 mb-2">
                        {{-- Safely check if category exists to avoid errors --}}
                        <div>
                            [ {{ $article->category->name ?? 'Sans catégorie' }} ]
                        </div>
                        <div>
                            {{ $article->created_at ? $article->created_at->format('d m. Y') : 'Date inconnue' }}
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-semibold mb-2">{{ $article->title }}</h2>
                    
                    {{-- Limit the content snippet for the list view --}}
                    <p class="text-sm text-gray-700 mb-4">
                        {{ Str::limit($article->content, 150) }}
                    </p>
                    
                    <div class="text-xs text-gray-500">
                        Par {{ $article->user->name ?? 'Auteur inconnu' }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection