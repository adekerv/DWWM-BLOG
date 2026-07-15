<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article list Admin</title>
</head>
<body>
    <div class="admin-header">
    <h1>Articles</h1>
    <a href="#" class="btn-create">+ Nouvel article</a>
</div>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category->name }}</td>
                <td>
                    @if ($article->status === 'PUBLISHED')
                        <span class="status-published">• Publié</span>
                    @else
                        <span class="status-draft">• Brouillon</span>
                    @endif
                </td>
                <td>{{ $article->created_at->format('d/m/Y') }}</td>
                <td class="actions-cell">✏️ ❌ ➜</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-container">
    <button class="btn-pagination">- Précédent</button>
    <span class="page-info">Page 1/2</span>
    <button class="btn-pagination">Suivant -</button>
</div>
</body>
</html>