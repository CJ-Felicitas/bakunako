<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Smscontroller;
use App\Http\Controllers\HealthCareProviderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;

// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});

// Route::post('/verify_schedule', [ScheduleController::class, 'verify_schedule_session']);

// Route::get('/verify', function () {
//     return view('sched');
// });

// get the register page
Route::get('/sendsms', [Smscontroller::class, 'sendSms']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/pdf', [PDFController::class, 'generatePDF']);

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

// get the profile page
Route::get('/profile', [ProfileController::class, 'showProfile']);



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

    Route::get('/recommendedvaccinesandschedules', function () {
        return view('site.client.recommended_vaccines_and_schedules');
    });
});

// grouped routes for the ADMINISTRATOR pages
Route::prefix('admin')->middleware('AdminPageRoutes')->group(function () {
   
    Route::get('/feedbacks', [AdminController::class, 'view_feedbacks']);
    Route::post('/adduser_', [AdminController::class, 'addUser_']);
    Route::get('/adduser', [AdminController::class, 'add_user_view']);
    Route::get('/dashboard', [AdminController::class, 'dashboard_view']);
    Route::get('/infant/{id}', [ParentController::class, 'show']);
    Route::post('/editprofile', [ProfileController::class, 'editProfile']);
    Route::post('/updatepassword', [ProfileController::class, 'updatepassword']);

    // manage vaccination
    Route::get('/vaccination', [AdminController::class, 'view_infants_schedule']);
    Route::get('/vaccination_details/{id}', [AdminController::class, 'view_vaccination_details']);
    Route::post('/updateStatus', [AdminController::class, 'updateStatus']);
});


Route::prefix('healthcare_provider')->middleware('HealthCareProviderRoutes')->group(function () {

    // get the healthcare provider dashboard
    Route::get('/dashboard', [HealthCareProviderController::class, 'view_infants_schedule']);

    // get the feedback page for the healthcare provider page
    Route::get('/feedback', [FeedbackController::class, 'view']);

    Route::get('/vaccination_details/{id}', [HealthCareProviderController::class, 'view_vaccination_details']);

    // submit feedback controller for the healthcare provider page
    Route::post('/submitfeedback_', [FeedbackController::class, 'addFeedback']);

    // update status
    Route::post('/updateStatus', [HealthCareProviderController::class, 'updateStatus']);

});


