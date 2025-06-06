<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DspController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf/digital-maturity-results', function () {
    return view('pdf.digital-maturity-results');
})->name('digital-maturity-results');

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dma', function () {
    return view('dma');
})->name('dma');

Route::get('/definitions', function () {
    return view('definitions');
})->name('definitions');

// Admin routes (role_id = 1)
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':1'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/manage-users', [DashboardController::class, 'manageUsers'])->name('manage-users');
    Route::get('/assessments', [DashboardController::class, 'assessments'])->name('assessments');
});

// DSP routes (role_id = 2)
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':2'])->group(function () {
    Route::get('/dsp', [DspController::class, 'index'])->name('dsp');
    Route::get('/new-assessments', [DspController::class, 'newAssessments'])->name('new-assessments');
    Route::get('/dsp-assessments', [DspController::class, 'dspAssessments'])->name('dsp-assessments');
});

// Profile Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});



