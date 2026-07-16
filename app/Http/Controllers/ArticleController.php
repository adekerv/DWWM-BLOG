<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Show list of all articles (4 per page) with status filters
     */
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user']);

        // Check if a status filter has been selected ('published' or 'draft')
        if ($request->filled('status') && in_array($request->status, ['published', 'draft'])) {
            $query->where('status', $request->status);
        }

        // Apply clean sorting based on status type
        if ($request->status === 'draft') {
            $query->latest('created_at');
        } else {
            // Sort by correct DB schema column 'published_at'
            $query->orderByDesc('published_at');
        }

        // Paginate and retain active query selections on page swaps
        $articles = $query->paginate(4)->withQueryString();

        // Returns view resources/views/articles-list.blade.php
        return view('articles-list', compact('articles')); 
    }

    public function adminIndex()
    {
        $articles = Article::with(['category', 'user'])->latest()->get();
        return view('articles-list-admin', compact('articles'));
    }

    /**
     * Show details of a single article
     */
    public function details(Article $article): View
    {
        // Eager load relationships on the already-resolved model
        $article->load(['category', 'user']);

        return view('articles-details', compact('article'));
    }
}