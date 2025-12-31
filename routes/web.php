<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin panel (protected)
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.panel');

// Contact form submission
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Temporary DB test route (remove after debugging)
Route::get('/db-test', function () {
    try {
        $res = DB::select('select 1 as ok');
        return response()->json($res);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

require __DIR__.'/auth.php';
