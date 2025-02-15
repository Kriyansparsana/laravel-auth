<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
class AdminController extends Controller
{
    public function adminRegisterForm()
    {
        return view('admin.register');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('verification.notice');
    }

    public function adminLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Admin Login successful!');
            }

            Auth::logout();
            return redirect()->back()->with("error", 'You are not allowed to login from here.');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');

        // return redirect('/admin/dashboard');
    }

}
