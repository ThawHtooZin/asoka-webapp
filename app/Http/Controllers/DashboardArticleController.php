<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardArticleController extends Controller
{
    public function index()
    {
        $articles = Article::get();
        $categories = ArticleCategory::get();
        return view('dashboard.article', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'intro' => 'required',
            'category_id' => 'required', // Keep this for validation
            'pdf_url' => 'nullable|file|mimes:pdf|max:4000', // Validate PDF file
        ]);

        // Prepare the data for creation
        $data['user_id'] = Auth::id(); // Get the authenticated user's ID
        $data['article_category_id'] = $data['category_id']; // Map to the correct column name

        // Handle the PDF file upload
        if ($request->hasFile('pdf_url')) {
            $pdfPath = $request->file('pdf_url')->store('uploads/articles', 'public'); // Save in the 'uploads/articles' directory
            $data['pdf_url'] = $pdfPath; // Save the file path in the database
        }

        // Optionally, you can unset category_id if it's not needed in the database
        unset($data['category_id']); // Remove the old key if it exists

        // Create the article
        Article::create($data);

        session()->flash('success', 'Article created successfully!');
        return redirect('/dashboard/articles');
    }




    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'intro' => 'required',
            'category_id' => 'required',
        ]);

        // Retrieve the article to be updated
        $article = Article::find($request->id);
        if ($article) {
            // Prepare data to update, mapping category_id to article_category_id
            $dataToUpdate = $request->only(['title', 'intro', 'category_id']);
            $dataToUpdate['article_category_id'] = $dataToUpdate['category_id']; // Map to the correct column name
            unset($dataToUpdate['category_id']); // Remove the old key if it exists

            $dataToUpdate['user_id'] = Auth::id(); // Get the authenticated user's ID

            // Handle the PDF file upload
            if ($request->hasFile('pdf_url')) {
                // Delete the existing PDF file if it exists
                if ($article->pdf_url) {
                    Storage::disk('public')->delete($article->pdf_url);
                }

                // Store the new PDF file
                $pdfPath = $request->file('pdf_url')->store('uploads/articles', 'public');
                $dataToUpdate['pdf_url'] = $pdfPath; // Save the new file path in the database
            }

            // Update the article
            $article->update($dataToUpdate);

            session()->flash('success', 'Article updated successfully!');
            return redirect('/dashboard/articles');
        }

        session()->flash('error', 'Article not found');
        return redirect('/dashboard/articles');
    }

    public function destroy(Request $request)
    {
        $article = Article::find($request->id);
        if ($article) {
            $article->delete();
            return redirect()->back()->with('success', 'Article deleted successfully!');
        }
        return redirect()->back()->with('error', 'Article not found');
    }
}
