<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Stock/Voorraad routes (no auth required)
Route::get('/voorraad', [StockController::class, 'index'])->name('stocks.index');
Route::get('/overzicht-productvoorraden', [StockController::class, 'index'])->name('stocks.overview');

// Product management routes
Route::get('/product/{id}', [StockController::class, 'showProduct'])->name('stocks.product.show');
Route::put('/product/{id}', [StockController::class, 'updateProduct'])->name('stocks.product.update');

// Warehouse management routes
Route::get('/warehouse/{id}', [StockController::class, 'showWarehouse'])->name('stocks.warehouse.show');
Route::put('/warehouse/{id}', [StockController::class, 'updateWarehouse'])->name('stocks.warehouse.update');
