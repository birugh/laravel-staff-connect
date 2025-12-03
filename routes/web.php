<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


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
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

// Reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.store');

// ADMIN SPACE
Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    // ! DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // ! USER
    Route::resource('/user', UserController::class)->except('show');
    // ! USER-PROFILE
    Route::resource('/user-profile', UserProfileController::class)->except('show');
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.show');
    // ! MESSAGES
    Route::resource('messages', MessageController::class)->except('show');
    Route::get('/message/detail/{id}', [MessageController::class, 'show'])->name('messages.show');
    // ! REPLIES
    Route::resource('replies', MessageReplyController::class)->except('show');

});

// USER SPACE
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/user/inbox', function () {
    return view('user.messages.inbox');
})->name('messages.inbox');

Route::get('/user/sent', function () {
    return view('user.messages.sent');
})->name('messages.sent');

Route::get('/user/show', function () {
    return view('user.messages.show');
})->name('messages.show');

// Route::get('/user/show/{id}', function () {
//     return view('user.messages.show');
// })->name('messages.show');
