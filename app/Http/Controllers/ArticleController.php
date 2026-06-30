<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{/**
     * Show list of all articles
     */
    public function index()
    {
        // Retrieves all articles from newest to oldest
        $articles = Article::all();

        // Returns view resources/views/article-list.blade.php
        return view('articles-list',['articles' => $articles]); 
    }
    }
