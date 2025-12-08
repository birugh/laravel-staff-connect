<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminEmailSendingController;
use App\Http\Controllers\AdminEmailTemplateController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AdminMessageReplyController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminUserProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserEmailSendingController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\UserMessageReplyController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.inbox');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(Auth::user()->role === 'admin' ? '/admin/dashboard' : 'user/dashboard')->with('status', 'Email verified!');
})->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');



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
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // ! USER
    Route::resource('/user', AdminUserController::class)->except('show');
    // ! USER-PROFILE
    Route::resource('/user-profile', AdminUserProfileController::class)->except('show');
    Route::get('/user/detail/{id}', [AdminUserController::class, 'show'])->name('user.show');
    // ! MESSAGES
    Route::resource('/messages', AdminMessageController::class)->except('show');
    Route::get('/message/detail/{id}', [AdminMessageController::class, 'show'])->name('messages.show');
    // ! REPLIES
    Route::resource('replies', AdminMessageReplyController::class)->except('show');
    // ! EMAIL TEMPLATE
    Route::resource('email-templates', AdminEmailTemplateController::class);
    // ! EMAIL SENDING
    Route::get('/messages/templates', [AdminEmailSendingController::class, 'create'])->name('messages.templates.create');
    Route::post('/messages/templates/fill', [AdminEmailSendingController::class, 'fillForm'])->name('messages.templates.fill');
    Route::post('/messages/templates/send', [AdminEmailSendingController::class, 'send'])->name('messages.templates.send');
});

// USER SPACE
Route::middleware('auth')->prefix('/user')->name('user.')->group(function () {
    // ! DASHBOARD
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // ! MESSAGES
    Route::resource('/messages', UserMessageController::class)->except('show')->middleware('verified');
    Route::get('/inbox', [UserMessageController::class, 'index'])->name('messages.inbox');
    Route::post('/reply', [UserMessageReplyController::class, 'store'])->name('messages.reply');
    Route::get('/sent', [UserMessageController::class, 'sent'])->name('messages.sent');
    Route::get('/show/{id}', [UserMessageController::class, 'show'])->name('messages.show');
    // ! PROFILE
    Route::resource('/user-profile', UserProfileController::class)->except('show');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    // ! EMAIL TEMPLATE SENDING
    Route::middleware('verified')->group(function () {
        Route::get('/messages/templates', [UserEmailSendingController::class, 'create'])->name('messages.templates.create');
        Route::post('/messages/templates/fill', [UserEmailSendingController::class, 'fillForm'])->name('messages.templates.fill');
        Route::post('/messages/templates/send', [UserEmailSendingController::class, 'send'])->name('messages.templates.send');
    });
});

Route::get('/email', function () {

    return view('email.custom', ['subject' => 'Kantor sedang bermasalah, kantor akan libur sampai minggu depan', 'receiverEmail' => 'biru@gmail.com', 'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti, unde modi architecto temporibus sit dignissimos vel fuga facilis eaque dolore voluptate repellat vero placeat recusandae totam rem et consequuntur culpa blanditiis possimus. Similique praesentium obcaecati, dicta minus numquam quam culpa quod, ex quaerat dignissimos iure minima sequi magni? Praesentium, eveniet.']);
});
