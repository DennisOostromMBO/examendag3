<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Include module routes
require __DIR__.'/allergie.php';
require __DIR__.'/leverancier.php';
require __DIR__.'/voorraad.php';
require __DIR__.'/voedselpakket.php';
