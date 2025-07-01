<?php

use Illuminate\Support\Facades\Route;

Route::get('/voedselpakketten', function () {
    return view('food-packages.index');
})->name('food-packages.index');
