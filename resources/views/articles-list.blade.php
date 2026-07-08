<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</define>
</head>
<body>
    <h1>Mon List des blogs</h1>

    {{-- Verification --}}
    @if($articles->isEmpty())
        <p>Aucun article pour le moment.</p>
    @else
        {{-- Boucle to show each article. --}}
        @foreach($articles as $article)
        <div>
        <h2> {{ $article->title }} </h2>
        <p> {{ $article->content }}</p>
        <p> Category: {{ $article->category?->name}}</p>
        <p> Author: {{ $article->user?->name}}</p>
        </div>


        @endforeach
    @endif
</body>
</html>