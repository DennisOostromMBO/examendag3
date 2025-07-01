<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodParcelController;

Route::get('/voedselpakketten', [FoodParcelController::class, 'index'])->name('food-packages.index');
Route::get('/voedselpakketten/{pakketnummer}', [FoodParcelController::class, 'show'])->name('food-packages.show');
Route::get('/voedselpakketten/{pakketnummer}/edit', [FoodParcelController::class, 'edit'])->name('food-packages.edit');
Route::post('/voedselpakketten/{pakketnummer}', [FoodParcelController::class, 'update'])->name('food-packages.update');
