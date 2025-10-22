<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCustomerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If customer is already logged in, redirect to account page
        if (session('customer_id')) {
            return redirect()->route('customer.account')
                ->with('info', 'You are already logged in.');
        }

        return $next($request);
    }
}
