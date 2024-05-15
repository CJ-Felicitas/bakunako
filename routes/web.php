<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Smscontroller;
use App\Http\Controllers\HealthCareProviderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\VoucherController;

// get the landing page/default page
Route::get('/', function () {
    return view('landing');
});
Route::get('/pdf/{id}', [PDFController::class, 'generatePDF']);

// Route::post('/verify_schedule', [ScheduleController::class, 'verify_schedule_session']);

// Route::get('/verify', function () {
//     return view('sched');
// });

// get the register page
// Route::get('/sendsms', [Smscontroller::class, 'twilio']);

Route::get('/vaccines_to_vouchers', [VoucherController::class, 'vaccines_associated_with_voucher']);

Route::get('/register', function () {
    return view('register');
});

// get the login page
Route::get('/login_healthcareprovider', function () {
    return view('loginhp');
});

// get the login page
Route::get('/login_parent', function () {
    return view('login');
});

// get the login page
Route::get('/admin', function () {
    return view('loginadmin');
});

Route::post('/hplogin_', [AuthController::class, 'login_hp']);
Route::post('/adminlogin_', [AuthController::class, 'login_admin']);
Route::post('/parentlogin_', [AuthController::class, 'login_parent']);

// terminate currently authenticated user and kill all sessions
Route::get('/logout', [AuthController::class, 'logout']);

// login attempt
// Route::post('/login_', [AuthController::class, 'login']);

// register attempt
Route::post('/register_', [RegistrationController::class, 'register']);

// grouped routes for the PARENT pages
Route::prefix('parent')->middleware('ParentPageRoutes')->group(function () {

    Route::post('/editprofile', [ParentController::class, 'editProfile']);
    // get the edit page
    Route::get('/edit/{id}', [ParentController::class,'edit_infant_view']);
    Route::post('/edit/infantdetails', [ParentController::class,'edit_infant']);
    // get the profile page
    Route::get('/profile', [ProfileController::class, 'showProfile']);
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

    Route::get('/claimvoucher/{id}', [VoucherController::class, 'claimVoucher']);
    // submit feedback controller for the parent page
    Route::post('/submitfeedback_', [FeedbackController::class, 'addFeedback']);

    // store or save the record of the baby
    Route::post('/addinfant_', [ParentController::class, 'store']);

    // get the full details of the baby page
    Route::get('/infant/{id}', [ParentController::class, 'show']);

    Route::get('/voucher/rewards', [ParentController::class, 'voucher_rewards_view']);
    Route::get('/voucher/my_vouchers', [ParentController::class, 'my_vouchers_view']);

    Route::get('/recommendedvaccinesandschedules', function () {
        return view('site.client.recommended_vaccines_and_schedules');
    });
});

// grouped routes for the ADMINISTRATOR pages
Route::prefix('admin')->middleware('AdminPageRoutes')->group(function () {

    // get the profile page
    Route::get('/profile', [ProfileController::class, 'showProfile']);
    // partner routes
    Route::get('/partners', [PartnerController::class, 'partner_view']);
    Route::post('/addPartner', [PartnerController::class, 'addPartner']);
    Route::post('/delete_partner', [PartnerController::class, 'partner_delete']);

    // misc routes
    Route::get('/feedbacks', [AdminController::class, 'view_feedbacks']);
    Route::post('/adduser_', [AdminController::class, 'addUser_']);
    Route::get('/adduser', [AdminController::class, 'add_user_view']);
    Route::get('/dashboard', [AdminController::class, 'dashboard_view']);
    Route::get('/infant/{id}', [ParentController::class, 'show']);
    Route::post('/editprofile', [AdminController::class, 'editProfile']);
    Route::post('/updatepassword', [ProfileController::class, 'updatepassword']);

    // manage vaccination
    Route::get('/vaccination', [AdminController::class, 'view_infants_schedule']);
    Route::get('/vaccination_details/{id}', [AdminController::class, 'view_vaccination_details']);
    Route::post('/updateStatus', [AdminController::class, 'updateStatus']);

    // manage voucher
    Route::get('/voucher', [VoucherController::class, 'view_voucher']);
    Route::post('/addVoucher', [VoucherController::class, 'addVoucher']);
    Route::get('/viewvouchers/{id}', [VoucherController::class, 'detailed_voucher']);
    Route::get('/vaccines_to_vouchers', [VoucherController::class, 'vaccines_associated_with_voucher']);
    Route::post('/update_active_distribution', [VoucherController::class, 'updateActiveVoucher']);
});


Route::prefix('healthcare_provider')->middleware('HealthCareProviderRoutes')->group(function () {
    Route::post('/editprofile', [HealthCareProviderController::class, 'editProfile']);
    // get the profile page
    Route::get('/profile', [ProfileController::class, 'showProfile']);
    // get the healthcare provider dashboard
    Route::get('/dashboard', [HealthCareProviderController::class, 'view_infants_schedule']);
    // get the feedback page for the healthcare provider page
    Route::get('/feedback', [FeedbackController::class, 'hpview']);
    Route::get('/vaccination_details/{id}', [HealthCareProviderController::class, 'view_vaccination_details']);
    // submit feedback controller for the healthcare provider page
    Route::post('/submitfeedback_', [FeedbackController::class, 'addFeedbackhp']);
    // update status
    Route::post('/updateStatus', [HealthCareProviderController::class, 'updateStatus']);

});


