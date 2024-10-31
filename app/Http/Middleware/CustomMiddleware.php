<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->roles()->first()) {
            $roleName = $request->user()->roles()->first()->name;

            if (!in_array($roleName, ['admin', 'instructor'])) {
                return redirect('/')->with('error', "You don't have access.");
            }
        } else {
            return redirect('/')->with('error', "You don't have access.");
        }

        return $next($request);
    }
}
