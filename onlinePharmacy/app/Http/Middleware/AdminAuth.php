<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            // Redirect to admin login page with error message
            return redirect()->route('admin.login')
                ->withErrors(['auth' => 'Please login to access the admin panel.'])
                ->with('error', 'Unauthorized access. Please login first.');
        }

        return $next($request);
    }
}
