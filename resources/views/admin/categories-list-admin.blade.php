@extends('layouts.app')

@section('title', 'Admin - Liste des catégories')

@section('content')

    {{-- Session Notifications --}}
   {{--   @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif --}}

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Espace Admin Tabs --}}
    <div class="border-b border-gray-200 mb-8 mt-2">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('admin.articles.index') }}" 
               class="{{ request()->routeIs('admin.articles.*') ? 'border-black text-black' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg transition">
                Articles
            </a>
            <a href="{{ route('admin.categories.index') }}" 
               class="{{ request()->routeIs('admin.categories.*') ? 'border-black text-black' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg transition">
                Catégories
            </a>
        </nav>
    </div>

    {{-- Header Section --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-light text-black">Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-black text-white px-6 py-2 text-sm font-semibold hover:bg-gray-800 transition">
            + Nouvelle catégorie
        </a>
    </div>

    {{-- Admin Table --}}
    <div class="border-t border-b border-gray-400 py-2">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-300">
                    <th class="py-4 font-semibold text-lg text-gray-800 w-1/3">Nom</th>
                    <th class="py-4 font-semibold text-lg text-gray-800">Nombre d'articles</th>
                    <th class="py-4 font-semibold text-lg text-gray-800">Date de création</th>
                    <th class="py-4 font-semibold text-lg text-gray-800">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b border-gray-200 last:border-0 hover:bg-gray-50">
                        <td class="py-4 text-base text-black pr-4 font-medium">{{ $category->name }}</td>
                        <td class="py-4 text-base text-gray-700">
                            {{ $category->articles_count }} {{ Str::plural('article', $category->articles_count) }}
                        </td>
                        <td class="py-4 text-sm text-gray-700">
                            {{ $category->created_at?->format('d/m/Y') ?? 'Date inconnue' }}
                        </td>
                        
                        <td class="py-4 text-sm text-gray-700">
                            <div class="flex items-center space-x-4">
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-black hover:text-gray-600 transition" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.25" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-black hover:text-gray-600 transition bg-transparent border-none p-1 cursor-pointer flex items-center" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-sm text-gray-500 italic text-center">Aucune catégorie trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Admin Pagination --}}
    @if ($categories->hasPages())
        <div style="display: flex; justify-content: center; align-items: center; gap: 2rem; margin-top: 3rem;">
            @if ($categories->onFirstPage())
                <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed;">&larr; Précédent</span>
            @else
                <a href="{{ $categories->previousPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none;">&larr; Précédent</a>
            @endif
            <span style="font-size: 0.875rem; font-weight: 500; color: #000;">Page {{ $categories->currentPage() }}/{{ $categories->lastPage() }}</span>
            @if ($categories->hasMorePages())
                <a href="{{ $categories->nextPageUrl() }}" style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; text-decoration: none;">Suivant &rarr;</a>
            @else
                <span style="background-color: #000; color: #fff; padding: 8px 24px; font-size: 0.875rem; opacity: 0.5; cursor: not-allowed;">Suivant &rarr;</span>
            @endif
        </div>
    @endif
@endsection