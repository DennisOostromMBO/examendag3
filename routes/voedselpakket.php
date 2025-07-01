<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodParcelController;

Route::get('/voedselpakketten', [FoodParcelController::class, 'index'])->name('food-packages.index');
