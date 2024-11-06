<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::get();
        return view('dashboard.articlecategories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        // Create the article
        ArticleCategory::create($data);

        session()->flash('success', 'Category created successfully!');
        return redirect('/dashboard/articles/categories');
    }



    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Retrieve the article to be updated
        $article = ArticleCategory::find($request->id);

        if ($article) {
            // Prepare data to update, mapping category_id to article_category_id
            $dataToUpdate = $request->only(['name']);
            // Update the article
            $article->update($dataToUpdate);

            session()->flash('success', 'Category updated successfully!');
            return redirect('/dashboard/articles/categories');
        }

        session()->flash('error', 'Categories not found');
        return redirect('/dashboard/articles/categories');
    }

    public function destroy(Request $request)
    {
        $article = ArticleCategory::find($request->id);
        if ($article) {
            $article->delete();
            return redirect()->back()->with('success', 'Category deleted successfully!');
        }
        return redirect()->back()->with('error', 'Category not found');
    }
}
