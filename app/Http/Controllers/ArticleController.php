<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // Start building the article query
        $query = Article::query();

        // Filter by search term if provided
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        }

        // Filter by category if provided
        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            $query->where('article_category_id', $categoryId);
        }

        // Execute the query to get the articles
        $articles = $query->orderByDesc('created_at')->get();

        // Fetch only the categories that are used in the articles table
        $categories = ArticleCategory::whereIn('id', Article::pluck('article_category_id'))->get();

        // Return the view with articles and categories
        return view('articles.index', compact('articles', 'categories'));
    }


    public function show($id)
    {
        $article = Article::findOrFail($id); // Retrieve article by ID
        return view('articles.show', compact('article'));
    }
}
