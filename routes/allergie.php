<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllergyController;

Route::get('/allergies', [AllergyController::class, 'index'])->name('allergies.index');
Route::get('/allergies/family/{familyId}', [AllergyController::class, 'familyAllergies'])->name('allergies.family');
Route::get('/allergies/person/{personId}/edit', [AllergyController::class, 'editPersonAllergy'])->name('allergies.person.edit');
Route::post('/allergies/person/{personId}/update', [AllergyController::class, 'updatePersonAllergy'])->name('allergies.person.update');

