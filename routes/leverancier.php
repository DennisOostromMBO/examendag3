<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/leveranciers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/leveranciers/{id}/producten', [SupplierController::class, 'show'])->name('suppliers.products');

