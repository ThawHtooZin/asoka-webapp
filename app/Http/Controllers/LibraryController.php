<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Adjust based on your book model
use Stripe\Stripe;
use Stripe\PaymentIntent;

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

        // Create a PaymentIntent and get the client secret
        Stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntent = PaymentIntent::create([
            'amount' => $book->price * 100, // Assuming price is in dollars
            'currency' => 'usd', // Change as needed
        ]);

        return view('elibrary.buy', [
            'book' => $book,
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

    public function processPayment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Set your secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Create a PaymentIntent
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount, // Amount should be in cents
                'currency' => $request->currency,
            ]);

            // Return the client secret
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        return view('elibrary.success'); // View for payment success
    }
}
