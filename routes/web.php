<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionTestController;
use App\Http\Controllers\AuthController;

// Route::get('/test', [TestController::class, 'test']);
Route::get('/test-connection', [ConnectionTestController::class, 'testConnection']);

// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});

// get the login page
Route::get('/login', function () {
    return view('login');
});

// login attempt
Route::post('/login_', [AuthController::class, 'login']);


