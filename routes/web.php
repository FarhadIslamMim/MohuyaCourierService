<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Superadmin
Route::get('/admin', [AuthController::class, 'loginPage'])->name('superadmin.login');
Route::post('/auth-check', [AuthController::class, 'AuthCheck'])->name('superadmin.auth.check');

// Frontend
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/parcel-tracking', [FrontendController::class, 'trackParcel'])->name('home.parcel.tracking');
Route::get('/parcel-tracking/{id}', [FrontendController::class, 'trackParcel'])->name('home.parcel.tracking.id');
Route::get('/privacy-policy', [FrontendController::class, 'privacyPOlicy'])->name('home.privacy');

// merchant register
Route::get('/merchant/register', [FrontendController::class, 'merchantRegistration'])->name('merchant.register.page');
Route::post('/auth/merchant/register', [FrontendController::class, 'merchantRegister'])->name('merchant.register');
Route::get('/signin', [FrontendController::class, 'signin'])->name('signin');

// frontend Merchant
Route::post('/login-check', [FrontendAuthController::class, 'authCheck'])->name('frontend.auth.check');
Route::get('/signout', [FrontendAuthController::class, 'signout'])->name('signout');

// language
Route::get('/language/{lang}', [LanguageController::class, 'lang']);
Route::get('/lang-change', [LanguageController::class, 'langChange'])->name('lang.change');


Route::get('/shamim', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return "done";
});

