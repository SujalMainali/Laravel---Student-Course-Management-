<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage', function () {
    return view('manage');
})->name('manage');
