<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Newsletter Routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/newsletter/unsubscribe/success', [NewsletterController::class, 'unsubscribeSuccess'])->name('newsletter.unsubscribe.success');
Route::get('/newsletter/unsubscribe/error', [NewsletterController::class, 'unsubscribeError'])->name('newsletter.unsubscribe.error');
Route::get('/newsletter/manage', [NewsletterController::class, 'manage'])->name('newsletter.manage');

Auth::routes();

// Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Property Actions (Protected by Auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::post('/properties/{property}/favorite', [PropertyController::class, 'favorite'])->name('properties.favorite');
    Route::delete('/properties/{property}/unfavorite', [PropertyController::class, 'unfavorite'])->name('properties.unfavorite');
});

// Dashboard Routes (Protected by Auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/profile', [UserDashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [UserDashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::get('/dashboard/change-password', [UserDashboardController::class, 'changePasswordForm'])->name('dashboard.password.change');
    Route::post('/dashboard/change-password', [UserDashboardController::class, 'updatePassword'])->name('dashboard.password.update');
    Route::get('/dashboard/my-properties', [UserDashboardController::class, 'myProperties'])->name('dashboard.properties.my');
    Route::get('/dashboard/favorite-properties', [UserDashboardController::class, 'favoriteProperties'])->name('dashboard.properties.favorite');
    Route::get('/dashboard/submit-property', [UserDashboardController::class, 'submitPropertyForm'])->name('dashboard.properties.submit');
    Route::post('/dashboard/submit-property', [UserDashboardController::class, 'storeProperty'])->name('dashboard.properties.store');
    Route::get('/dashboard/edit-property/{property}', [UserDashboardController::class, 'editPropertyForm'])->name('dashboard.properties.edit');
    Route::put('/dashboard/update-property/{property}', [UserDashboardController::class, 'updateProperty'])->name('dashboard.properties.update');
    Route::delete('/dashboard/delete-property/{property}', [UserDashboardController::class, 'deleteProperty'])->name('dashboard.properties.destroy');
});

// Test route for admin access
Route::get('/test-admin', function () {
    if (Auth::check() && Auth::user()->hasRole('admin')) {
        return 'Admin access confirmed! You can access /admin';
    }
    return 'Not an admin user';
})->middleware('auth');

Route::get('/about-us', [AboutController::class, 'index'])->name('about-us');

// Contact routes
Route::get('/contact-us', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'storeContactMessage'])->name('contact.store');
