<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if customer is logged in
        if (!session('customer_id')) {
            // Store the intended URL so we can redirect back after login
            session(['url.intended' => $request->url()]);
            
            // Redirect to customer login page with error message
            return redirect()->route('customer.login')
                ->withErrors(['auth' => 'Please login to access this page.'])
                ->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
