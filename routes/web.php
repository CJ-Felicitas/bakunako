<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;

// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});

// get the register page
Route::get('/register', function () {
    return view('register');
});

// get the login page
Route::get('/login', function () {
    return view('login');
});

// terminate currently authenticated user and kill all sessions
Route::get('/logout', [AuthController::class, 'logout']);

// login attempt
Route::post('/login_', [AuthController::class, 'login']);

// register attempt
Route::post('/register_', [RegistrationController::class, 'register']);

// grouped routes for the parent pages
Route::prefix('parent')->middleware('ParentPageRoutes')->group(function () {

    // get the parent dashboard
    Route::get('/dashboard', function () {
        return view('site.client.dashboard');
    }); 

});

// grouped routes for the admin pages
Route::prefix('admin')->middleware('AdminPageRoutes')->group(function () {

    // get the admin dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

});

