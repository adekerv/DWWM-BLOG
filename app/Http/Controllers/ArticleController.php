<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Show list of all articles (4 per page)
     */
    public function index()
    {
        // Retrieves articles newest to oldest, paginated 4 per page
        $articles = Article::with(['category', 'user'])
                            ->where('status','published')      
                            ->orderByDesc('publish_at')
                            ->latest()
                            ->paginate(4);

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