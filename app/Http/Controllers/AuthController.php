<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        // Redirect to dashboard if already logged in
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Check if the user exists and authenticate
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();

            // Check if the email is verified
            if (!$user->hasVerifiedEmail()) {
                // Log the user out if their email is not verified
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your email address is not verified. Please check your inbox to verify your email.',
                ]);
            }

            // Redirect to the dashboard if email is verified
            return redirect()->route('admin.dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    // Show registration form
    public function showRegisterForm()
    {
        // Redirect to dashboard if already logged in
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.register');
    }

    // Handle registration request (No email verification at this stage)
    public function register(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new user (without triggering email verification)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in immediately after registration
        Auth::login($user);

        // Redirect the user to the dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Registration successful! Please verify your email.');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();

        // Redirect to login page after logout
        return redirect()->route('login');
    }
}

