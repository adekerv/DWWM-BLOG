<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;




class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories-list',['categories' => $categories]);

       
    }
}
