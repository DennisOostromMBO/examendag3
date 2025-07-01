<?php

use Illuminate\Support\Facades\Route;

Route::get('/leveranciers', function () {
    return view('suppliers.index');
})->name('suppliers.index');
