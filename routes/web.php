<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage', function () {
    return view('manage');
})->middleware(['web', 'auth'])->name('manage');

Route::get('/me', [ProfileController::class, 'show'])
    ->middleware(['web', 'auth'])
    ->name('me.show');
