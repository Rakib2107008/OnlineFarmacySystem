<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminAuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        // Simple authentication (you can enhance this with database check)
        // For now, using hardcoded credentials
        $phone = $request->phone;
        $password = $request->password;
        
        // Example: admin phone: 01700000000, password: admin123
        if ($phone === '01715997737' && $password === 'islam123') {
            // Set session
            session(['admin_logged_in' => true, 'admin_phone' => $phone]);
            
            // Remember me functionality
            if ($request->remember) {
                // Store in cookie for 30 days
                Cookie::queue('admin_phone', $phone, 43200); // 30 days in minutes
                Cookie::queue('admin_remember', 'true', 43200);
            }
            
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
        }
        
        return back()->withErrors(['phone' => 'Invalid phone number or password.'])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Clear session
        session()->forget(['admin_logged_in', 'admin_phone']);
        
        // Clear cookies
        Cookie::queue(Cookie::forget('admin_phone'));
        Cookie::queue(Cookie::forget('admin_remember'));
        
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
