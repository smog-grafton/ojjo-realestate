<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Newsletter Routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/newsletter/unsubscribe/success', [NewsletterController::class, 'unsubscribeSuccess'])->name('newsletter.unsubscribe.success');
Route::get('/newsletter/unsubscribe/error', [NewsletterController::class, 'unsubscribeError'])->name('newsletter.unsubscribe.error');
Route::get('/newsletter/manage', [NewsletterController::class, 'manage'])->name('newsletter.manage');
