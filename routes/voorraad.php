<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Stock/Voorraad routes (no auth required)
Route::get('/voorraad', [StockController::class, 'index'])->name('stocks.index');
Route::get('/overzicht-productvoorraden', [StockController::class, 'index'])->name('stocks.overview');
