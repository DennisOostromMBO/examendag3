<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllergyController;

Route::get('/allergies', [AllergyController::class, 'index'])->name('allergies.index');

