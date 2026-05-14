<?php

use App\Http\Controllers\WebinarController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebinarController::class, 'index']);
Route::get('/webinars/{webinar}', [WebinarController::class, 'show'])->name('webinars.show');

// Route untuk peserta (harus login)
Route::middleware('auth')->group(function () {
    Route::post('/webinars/{webinar}/register', [RegistrationController::class, 'store'])->name('webinars.register');
    Route::post('/webinars/{webinar}/certificate', [RegistrationController::class, 'generateCertificate'])->name('certificate.generate');
    Route::get('/webinars/{webinar}/certificate', [RegistrationController::class, 'downloadCertificate'])->name('certificate.download');
    Route::get('/dashboard', [RegistrationController::class, 'dashboard'])->name('dashboard');
    Route::post('/webinars/{webinar}/survey', [\App\Http\Controllers\SurveyController::class, 'upload'])->name('survey.upload');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Route Admin
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/webinars', \App\Http\Controllers\Admin\AdminWebinarController::class);
    Route::get('/webinars/{webinar}/participants', [\App\Http\Controllers\Admin\AdminWebinarController::class, 'participants'])->name('webinars.participants');
    Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [\App\Http\Controllers\Admin\AdminUserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');
});

// Google OAuth
Route::get('/auth/google',          [\App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'callback'])->name('auth.google.callback');

Route::get(‘/foo’, function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});

require __DIR__.'/auth.php';