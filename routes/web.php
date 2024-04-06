<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SmsController;

// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});

Route::get('/sendsms', [SmsController::class, 'index']);



// get the login page
Route::get('/login', function () {
    return view('login');
});

// login attempt
Route::post('/login_', [AuthController::class, 'login']);

// grouped routes for the parent pages
Route::prefix('parent')->group(function () {
    // get the parent dashboard
    Route::get('/dashboard', function () {
        return view('parent.dashboard');
    });
});

// grouped routes for the admin pages
Route::prefix('admin')->group(function () {
    // get the admin dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');

    });

});

