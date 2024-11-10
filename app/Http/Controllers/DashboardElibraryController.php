<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class DashboardElibraryController extends Controller
{
    public function index()
    {
        $books = Book::get();
        $categories = BookCategory::get();
        return view('dashboard.book', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'book_category_id' => 'required',
            'isbn' => 'required|string|max:17', // ISBN typically 10 or 13 characters
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'description' => 'required|string',
            'price' => 'required|numeric',
            'book_url' => 'required|mimes:pdf|max:10240', // Assuming books are PDFs, max 10MB
        ]);

        // Handle the cover image upload if present
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('images/coverimage', 'public');
            $data['cover_image'] = '/' . $coverImagePath; // Store path in a database-friendly format
        }

        // Handle the book file upload
        if ($request->hasFile('book_url')) {
            $bookPath = $request->file('book_url')->store('books', 'public');
            $data['book_url'] = '/' . $bookPath; // Store path in a database-friendly format
        }

        // Create the book record with validated data
        Book::create($data);

        // Flash success message and redirect
        session()->flash('success', 'Book added successfully!');
        return redirect('/dashboard/books');
    }

    public function update(Request $request, $id)
    {
        // Find the book by ID
        $book = Book::findOrFail($id);

        // Validate the inputs
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'book_category_id' => 'required',
            'isbn' => 'required|string|max:17', // ISBN typically 10 or 13 characters
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'description' => 'required|string',
            'price' => 'required|numeric',
            'book_url' => 'nullable|mimes:pdf|max:10240', // Optional book file validation
        ]);

        // Handle the cover image upload if present and delete the old image if it exists
        if ($request->hasFile('cover_image')) {
            // Delete the old cover image if it exists
            if ($book->cover_image) {
                $oldImagePath = public_path($book->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $coverImagePath = $request->file('cover_image')->store('images/coverimage', 'public');
            $data['cover_image'] = '/' . $coverImagePath; // Store path in a database-friendly format
        }

        // Handle the book file upload if present and delete the old book file if it exists
        if ($request->hasFile('book_url')) {
            // Delete the old book file if it exists
            if ($book->book_url) {
                $oldBookPath = public_path($book->book_url);
                if (file_exists($oldBookPath)) {
                    unlink($oldBookPath);
                }
            }

            $bookPath = $request->file('book_url')->store('books', 'public');
            $data['book_url'] = '/' . $bookPath; // Store path in a database-friendly format
        }

        // Update the book record with the new data
        $book->update($data);

        // Flash success message and redirect
        session()->flash('success', 'Book updated successfully!');
        return redirect('/dashboard/books');
    }

    public function destroy(Request $request)
    {
        $book = Book::find($request->id);
        if ($book) {
            $book->delete();
            return redirect()->back()->with('success', 'Book deleted successfully!');
        }
        return redirect()->back()->with('error', 'Book not found');
    }
}
