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
        $articles = Article::with(['category','user'])->get();

        // Returns view resources/views/article-list.blade.php
        return view('articles-list',compact('articles')); 
    }

    public function adminIndex()
    {

        $articles = Article::with(['category','user'])->get();
        return view('articles-list-admin',compact('articles'));
    }
    }
