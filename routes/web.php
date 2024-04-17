<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Smscontroller;
use App\Http\Controllers\HealthCareProviderController;


// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});

Route::post('/verify_schedule', [ScheduleController::class, 'verify_schedule_session']);
Route::get('/verify', function () {
    return view('sched');
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

// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
// grouped routes for the PARENT pages
Route::prefix('parent')->middleware('ParentPageRoutes')->group(function () {

    // get the parent dashboard
    Route::get('/dashboard', [ParentController::class, 'index']);

    // get the add baby page
    Route::get('/addinfant', function () {
        return view('site.client.addinfant');
    });

    // get the feedback page for the parent page
    Route::get('/feedback', [FeedbackController::class, 'view']);

    Route::get('/vaccines', function () {
        return view('site.client.vaccine');
    });

    // submit feedback controller for the parent page
    Route::post('/submitfeedback_', [FeedbackController::class, 'addFeedback']);

    // store or save the record of the baby
    Route::post('/addinfant_', [ParentController::class, 'store']);

    // get the full details of the baby page
    Route::get('/infant/{id}', [ParentController::class, 'show']);

});
// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
// grouped routes for the ADMINISTRATOR pages
Route::prefix('admin')->middleware('AdminPageRoutes')->group(function () {
    // get the admin dashboard
    Route::get('/dashboard', function () {
        return view('site.admin.dashboard');
    });
});
// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
// grouped routes for the HEALTHCARE PROVIDER pages
Route::prefix('healthcare_provider')->middleware('HealthCareProviderRoutes')->group(function () {
    // get the healthcare provider dashboard
    Route::get('/dashboard', [HealthCareProviderController::class, 'view_infants_schedule']);
    // get the feedback page for the healthcare provider page
    Route::get('/feedback', [FeedbackController::class, 'view']);

    // submit feedback controller for the healthcare provider page
    Route::post('/submitfeedback_', [FeedbackController::class, 'addFeedback']);
});
// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

