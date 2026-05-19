<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobs'])->name('jobs.index');
Route::get('/latest-jobs', [HomeController::class, 'latestJobs'])->name('jobs.latest');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories.index');
Route::get('/qualification', [HomeController::class, 'qualificationsPage'])->name('qualifications.index');
Route::get('/jobs/{slug}', [HomeController::class, 'show'])->name('jobs.show');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

// Informational & Legal Pages
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-us', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
