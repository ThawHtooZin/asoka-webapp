<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookPurchase;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Fetch all books
        return view('elibrary.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id); // Fetch the specific book
        return view('elibrary.show', compact('book'));
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);
        return view('elibrary.read', compact('book'));
    }

    public function buy($id)
    {
        $book = Book::findOrFail($id);
        return view('elibrary.buy', compact('book'));
    }

    public function purchase(Request $request, $id)
    {
        $data = $request->validate([
            'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Add validation for image format and size
        ]);

        if ($request->hasFile('payment_image')) {
            // Store the file in the 'images/payments' directory in the public disk
            $imagePath = $request->file('payment_image')->store('images/payments', 'public');
            $data['payment_image'] = '/' . $imagePath; // Store the path in database format
        }

        $user_id = Auth::user()->id;

        $data['user_id'] = $user_id;
        $data['book_id'] = $id;
        $data['status'] = 'requested';
        BookPurchase::create($data);

        return redirect('elibrary/book/' . $id)->with('success', 'Book Requested Successfully!');
    }
}
