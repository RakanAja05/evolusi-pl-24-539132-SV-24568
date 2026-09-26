<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', [ProfileController::class, 'show'])
    ->name('profile.show');

Route::resource('tasks', TaskController::class)
    ->except(['show']);
