<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobs'])->name('jobs.index');
Route::get('/jobs/{slug}', [HomeController::class, 'show'])->name('jobs.show');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
