@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="space-y-6">
    {{-- Back Link --}}
    <div>
        <a href="{{ route('articles.index') }}" class="text-sm text-black hover:underline">
            &larr; Retour à la liste
        </a>
    </div>

    {{-- Categories & Tags --}}
    <div class="text-xs text-gray-600">
        [ {{ $article->category->name ?? 'Sans catégorie' }} ] [ Tag 1 ] [ Tag 2 ]
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-light text-black">
        {{ $article->title }}
    </h1>

    {{-- Metadata --}}
    {{--<div class="text-xs text-gray-500">
        Par {{ $article->user->name ?? 'Auteur inconnu' }} &middot; {{ $article->created_at ? $article->created_at->translatedFormat('j M Y') : 'Date inconnue' }}
    </div>--}}
    <div class="text-xs text-gray-500">
    Par {{ $article->user->name ?? 'Auteur inconnu' }} &middot; {{ $article->published_at ? $article->published_at->translatedFormat('j M Y') : 'Non publié' }}
    </div>
    <hr class="border-t border-gray-400">

    {{-- Content --}}
    <div>
        <h3 class="text-sm font-bold mb-3">Contenu complet.</h3>
        <div class="text-sm text-gray-800 leading-relaxed space-y-4">
            {{-- Preserves line breaks from database content --}}
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    <hr class="border-t border-gray-400 my-6">

    {{-- Comments Mockup Block --}}
    <div>
        <h3 class="text-sm font-bold mb-4"> example commentaire "until i figure out the functionality"</h3>
        
        <div class="space-y-4 mb-6">
            {{-- Static Comment 1 --}}
            <div class="border border-gray-400 p-4">
                <div class="text-xs text-gray-500 mb-1">
                    <span class="font-semibold text-black">Henri Amédépan</span> &middot; 15 jan. 2026
                </div>
                <p class="text-xs text-gray-700">
                    Contenu du commentaire. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sollicitudin, turpis sit amet placerat elementum, libero nisl rhoncus nisl, in consequat justo nisi et arcu.
                </p>
            </div>

            {{-- Static Comment 2 --}}
            <div class="border border-gray-400 p-4">
                <div class="text-xs text-gray-500 mb-1">
                    <span class="font-semibold text-black">Théa Louest</span> &middot; 13 jan. 2026
                </div>
                <p class="text-xs text-gray-700">
                    Contenu du commentaire. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sollicitudin, turpis sit amet placerat elementum, libero nisl rhoncus nisl, in consequat justo nisi et arcu.
                </p>
            </div>
        </div>

        {{-- Log In Prompt Button --}}
        <button class="bg-black text-white px-6 py-2 text-xs font-semibold hover:bg-gray-800 transition">
            Connectez-vous pour commenter
        </button>
    </div>
</div>
@endsection