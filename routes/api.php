<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/tugas', function () {
    return Task::latest()->get();
});
