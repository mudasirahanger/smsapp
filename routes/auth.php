<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
//custom route
use App\Http\Controllers\SendSMSController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
   
    Route::get('/SendSMS', [SendSMSController::class, 'create'])->name('SendSMS');

    Route::get('/SendWhatsapp', [SendSMSController::class, 'whatsapp'])->name('SendWhatsapp');

    Route::get('/Customer', [SendSMSController::class, 'customer'])->name('Customer');
    Route::post('/addCustomer',[SendSMSController::class, 'addCustomer'])->name('addCustomer');

    Route::get('/Settings', [SendSMSController::class, 'settings'])->name('Settings');

    Route::post('/send', [SendSMSController::class, 'send'])->name('send');

    Route::get('/getDashboardAjax',[SendSMSController::class,'getDashboardAjax'])->name('getDashboardAjax');
    Route::post('/AddSettings',[SendSMSController::class,'AddSettings'])->name('AddSettings');
    Route::post('/getsettingsAjaxSMS',[SendSMSController::class,'getsettingsAjaxSMS'])->name('getsettingsAjaxSMS');
    Route::post('/deleteSettings',[SendSMSController::class,'deleteSettings'])->name('deleteSettings');
    Route::get('/customerGroups',[SendSMSController::class,'customerGroups'])->name('customerGroups');
    Route::post('/AddcustomerGroup',[SendSMSController::class,'AddcustomerGroup'])->name('AddcustomerGroup');
    Route::get('/SMS_API_JOB',[SendSMSController::class,'SMS_API_JOB'])->name('SMS_API_JOB');
    
});

