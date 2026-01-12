<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUrlController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
    Route::get('/url/create', [UrlController::class, 'create'])->name('url.create');
    Route::post('/url/store', [UrlController::class, 'store'])->name('url.store');
    Route::get('/url', [UrlController::class, 'url'])->name('url');
    Route::delete('/url/{id}/delete', [UrlController::class, 'delete'])->name('url.delete');

    Route::middleware(IsAdmin::class)->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/url', [AdminUrlController::class, 'url'])->name('admin.url');
        Route::delete('/admin/url/{id}/delete', [AdminUrlController::class, 'delete'])->name('admin.url.delete');
    });
    

});

require __DIR__.'/auth.php';

Route::get('/{code}', [UrlController::class, 'fastRedirect']) //fastRedirect,slowRedirect
    ->where('code', '[a-zA-Z0-9]{6}')
    ->name('url.redirect');
