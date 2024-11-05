<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            // Filter articles by name or description based on search term
            $query->where('title', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc');
        }

        $articles = $query->orderBy('created_at', 'desc')->get();
        $categories = ArticleCategory::all(); // Assuming categories are displayed as well

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id); // Retrieve article by ID
        return view('articles.show', compact('article'));
    }
}
