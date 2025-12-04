<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailSendingController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageReplyController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');


    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard')->with('status', 'Email verified!');
    })->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // Forgot password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.store');

// ADMIN SPACE
Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function () {
    // ! DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ! USER
    Route::resource('/user', UserController::class)->except('show');
    // ! USER-PROFILE
    Route::resource('/user-profile', UserProfileController::class)->except('show');
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.show');
    // ! MESSAGES
    Route::resource('/messages', MessageController::class)->except('show');
    Route::get('/message/detail/{id}', [MessageController::class, 'show'])->name('messages.show');
    // ! REPLIES
    Route::resource('replies', MessageReplyController::class)->except('show');
    // ! EMAIL TEMPLATE
    Route::resource('email-templates', EmailTemplateController::class);
    // ! EMAIL SENDING
    Route::get('/email-send', [EmailSendingController::class, 'create'])->name('email-send.create');
    Route::post('/email-send/fill', [EmailSendingController::class, 'fillForm'])->name('email-send.fill');
    Route::post('/email-send/send', [EmailSendingController::class, 'send'])->name('email-send.send');
});

// USER SPACE
Route::middleware('auth')->prefix('/user')->name('user.')->group(function () {
    // ! DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ! MESSAGES
    Route::resource('/messages', MessageController::class)->except('show');
    Route::get('/inbox', function () {
        return view('user.messages.inbox');
    })->name('messages.inbox');

    Route::get('/sent', function () {
        return view('user.messages.sent');
    })->name('messages.sent');
    Route::get('/show', function () {
        return view('user.messages.show');
    })->name('messages.show');
});


// Route::get('/user/show/{id}', function () {
//     return view('user.messages.show');
// })->name('messages.show');
