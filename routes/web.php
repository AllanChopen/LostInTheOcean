<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::post('/contact', [ContactController::class, 'send']);

// Admin panel (no auth yet)
Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
