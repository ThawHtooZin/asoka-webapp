<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\BookPurchase;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the book ID from the route
        $bookId = $request->route('id');

        // Check if the current user has a confirmed purchase for this book
        $isOwned = BookPurchase::where('book_id', $bookId)
            ->where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->exists();

        if (!$isOwned) {
            // Redirect back if the user doesn't own the book
            return back()->with('error', 'You do not own this book.');
        }

        // Allow the request to proceed if ownership is confirmed
        return $next($request);
    }
}
