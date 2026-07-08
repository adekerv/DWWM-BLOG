<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste de Categories</title>
</head>
</define>
<body>
    <h1>Categories</h1>
    {{-- Verification --}}
    @if($categories->isEmpty())
        <p>Pani Category sorti la</p>
    @else 
        {{-- -Boucle to display the categories --}}

        @foreach ($categories as $category)
         <h2> {{ $category -> name }}</h2>
         <p>{{ $article->title }}</p>
            
        @endforeach
    @endif
</body>
</html>