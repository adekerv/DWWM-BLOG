@extends('layouts.app')

@section('title', 'Liste des Catégories')

@section('content')
    <h1 class="text-3xl font-light text-black mb-8">Liste des Catégories</h1>

    <div class="space-y-8">
        @foreach ($categories as $category)
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-semibold text-black mb-3">{{ $category->name }}</h2>

                @if($category->articles->count() > 0)
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        @foreach ($category->articles as $article)
                            <li>
                                <a href="{{ route('articles.details', $article->slug) }}" class="hover:underline">
                                    {{ $article->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500 italic">Aucun article dans cette catégorie.</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection