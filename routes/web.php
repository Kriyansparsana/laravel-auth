<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Customer Registration
Route::get('/customer/register', [CustomerController::class, 'customerRegisterForm']);
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');

// Admin Registration
Route::get('/admin/register', [AdminController::class, 'adminRegisterForm']);
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');

// Admin Login
Route::get('/admin/login', [AdminController::class, 'adminLoginForm'])->name("admin.login");
Route::post('/admin/login', [AdminController::class, 'login'])->name('login');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return auth()->user()->role === 'admin'
    ? redirect('/admin/login')->with('success', 'Email verified successfully! Please login to continue.')
    : redirect('/')->with('success', 'Email verified successfully!');

})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Admin Dashboard (Requires Verified Email)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified']);
