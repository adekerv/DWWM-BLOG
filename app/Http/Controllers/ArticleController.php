<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * USER VIEW: Show list of PUBLISHED articles only (4 per page)
     */
    public function index(Request $request)
    {
        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(4);

        // Returns view resources/views/articles-list.blade.php
        return view('articles-list', compact('articles')); 
    }

    /**
     * ADMIN VIEW: Show all articles with status filtering
     */
    public function adminIndex(Request $request)
    {
        $query = Article::with(['category', 'user']);

        // Check if a status filter has been selected ('published' or 'draft')
        if ($request->filled('status') && in_array($request->status, ['published', 'draft'])) {
            $query->where('status', $request->status);
        }

        // Sort by the latest updated date for admins
        $query->orderByDesc('updated_at');

        // Paginate and retain active query selections on page swaps
        $articles = $query->paginate(4)->withQueryString();

        // Note the "admin." prefix based on your folder structure!
        return view('admin.articles-list-admin', compact('articles'));
    }

    /**
     * ADMIN VIEW: Show create article form
     */
    public function create(): View
    {
        // Fetch categories to populate your dropdown list
        $categories = Category::all();
        
        // Updated to use your specific blade filename: articles-create-admin.blade.php
        return view('admin.articles-create-admin', compact('categories'));
    }

    /**
     * ADMIN ACTION: Store a newly created article in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        // Generate a clean slug from the title and add a random suffix to avoid duplicates
        $article->slug = Str::slug($validated['title']) . '-' . rand(1000, 9999); 
        $article->category_id = $validated['category_id'];
        $article->content = $validated['content'];
        $article->status = $validated['status'];
        $article->user_id = 1; // Temporary hardcoded user ID matching your DB row until Auth is configured

        if ($validated['status'] === 'published') {
            $article->published_at = Carbon::now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès !');
    }

    /**
     * ADMIN VIEW: Show the form for editing an existing article.
     */
    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('admin.articles-edit-admin', compact('article', 'categories'));
    }

    /**
     * ADMIN ACTION: Update an existing article in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article->title = $validated['title'];
        $article->category_id = $validated['category_id'];
        $article->content = $validated['content'];
        
        // Update publication timestamp toggles depending on status change
        if ($validated['status'] === 'published' && $article->status !== 'published') {
            $article->published_at = now();
        } elseif ($validated['status'] === 'draft') {
            $article->published_at = null;
        }
        
        $article->status = $validated['status'];
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article modifié avec succès !');
    }

    /**
     * USER & ADMIN VIEW: Show details of a single article
     * (Laravel automatically uses the slug here based on our route setup)
     */
    public function details(Article $article): View
    {
        // Eager load relationships on the already-resolved model
        $article->load(['category', 'user']);

        return view('articles-details', compact('article'));
    }
}