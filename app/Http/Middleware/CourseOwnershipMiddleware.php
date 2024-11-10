<?php

namespace App\Http\Middleware;

use App\Models\CoursePurchase;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the book ID from the route
        $bookId = $request->route('course');

        // Check if the current user has a confirmed purchase for this book
        $isOwned = CoursePurchase::where('course_id', $bookId)
            ->where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->exists();

        if (!$isOwned) {
            // Redirect back if the user doesn't own the book
            return back()->with('error', 'You do not own this course.');
        }

        // Allow the request to proceed if ownership is confirmed
        return $next($request);
    }
}
