<?php

use Illuminate\Support\Facades\Route;

Route::get('/allergies', function () {
    return view('allergies.index');
})->name('allergies.index');
