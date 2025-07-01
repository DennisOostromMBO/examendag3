<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/leveranciers', [SupplierController::class, 'index'])->name('suppliers.index');

