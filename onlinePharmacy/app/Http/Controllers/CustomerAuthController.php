<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerAuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        // Redirect to my account if already logged in
        if (session()->has('customer_id')) {
            return redirect()->route('customer.account');
        }
        return view('customer.login');
    }

    // Show signup page
    public function showSignup()
    {
        // Redirect to my account if already logged in
        if (session()->has('customer_id')) {
            return redirect()->route('customer.account');
        }
        return view('customer.signup');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $customer = CustomerAuth::where('phone', $request->phone)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return back()->withErrors([
                'phone' => 'Invalid phone number or password.',
            ])->withInput();
        }

        // Store customer info in session
        session([
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
        ]);

        // Handle remember me
        if ($request->filled('remember')) {
            $token = Str::random(60);
            $customer->remember_token = $token;
            $customer->save();

            // Set remember me cookie for 30 days
            cookie()->queue('customer_remember_token', $token, 60 * 24 * 30);
        }

        return redirect()->route('customer.account')->with('success', 'Welcome back, ' . $customer->name . '!');
    }

    // Handle signup
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers_auth,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer = CustomerAuth::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Auto login after signup
        session([
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
        ]);

        return redirect()->route('customer.account')->with('success', 'Account created successfully!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        // Clear session
        session()->forget(['customer_id', 'customer_name', 'customer_phone']);
        
        // Clear remember me cookie
        cookie()->queue(cookie()->forget('customer_remember_token'));

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
