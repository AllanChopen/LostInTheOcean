<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'send']);
