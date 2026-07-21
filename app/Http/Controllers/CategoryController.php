<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
/**
 * Display public listing of categories.
 */
public function index()
{
    // Eager-load articles for each category to avoid N+1 queries
    $categories = Category::with('articles')->get();

    // Renders resources/views/categories-list.blade.php
    return view('categories-list', compact('categories'));
}
    /**
     * Display admin list of categories.
     * Fixes: Route 'admin.categories.index' expecting adminIndex()
     */
    public function adminIndex()
    {
        $categories = Category::withCount('articles')
            ->latest()
            ->paginate(10);

        return view('admin.categories-list-admin', compact('categories'));
    }

    /**
     * Show form to create a category.
     */
    public function create()
    {
        return view('admin.categories-create-admin');
    }

    /**
     * Store a new category and redirect back to the create page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.unique' => 'Cette catégorie existe déjà.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()
            ->route('admin.categories.create')
            ->with('success', 'La catégorie a été créée avec succès !');
    }

    /**
     * Show form to edit a category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories-edit-admin', compact('category'));
    }

    /**
     * Update specified category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.unique' => 'Cette catégorie existe déjà.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'La catégorie a été modifiée avec succès !');
    }

    /**
     * Remove category from storage if no articles are linked to it.
     */
    public function destroy(Category $category)
    {
        // Prevent deletion if articles exist in this category
        if ($category->articles()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer la catégorie "' . $category->name . '" car elle contient encore des articles.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'La catégorie a été supprimée avec succès !');
    }
}