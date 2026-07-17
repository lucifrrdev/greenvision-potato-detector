<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Statis
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/company-profile', function () {
    return view('company-profile');
})->name('company-profile');

Route::get('/project', function () {
    return view('project');
})->name('project');

// Deteksi Penyakit (Input Gambar)
Route::get('/input', [DetectionController::class, 'showInput'])->name('input');
Route::post('/predict', [DetectionController::class, 'predict'])->name('predict');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']); // Menambahkan fallback get logout agar memudahkan demo/logout instan
    
    // Riwayat Deteksi (Hasil Tanaman)
    Route::get('/history', [DetectionController::class, 'showHistory'])->name('history');
    Route::get('/history/{id}', [DetectionController::class, 'showDetail'])->name('history.detail');
    Route::delete('/history/{id}', [DetectionController::class, 'destroy'])->name('history.destroy');

    // Profil Akun
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile']);
});

// Admin Route Group
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', \App\Http\Controllers\AdminUserController::class)->except(['show']);
    Route::get('/detections', [\App\Http\Controllers\AdminDetectionController::class, 'index'])->name('detections.index');
    Route::get('/detections/{id}', [\App\Http\Controllers\AdminDetectionController::class, 'show'])->name('detections.show');
    Route::delete('/detections/{id}', [\App\Http\Controllers\AdminDetectionController::class, 'destroy'])->name('detections.destroy');
});

