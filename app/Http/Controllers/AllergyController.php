<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AllergyController extends Controller
{
    public function index(Request $request): View
    {
        $allergyId = $request->input('allergy_id');
        $families = Allergy::getFamiliesWithAllergies($allergyId, 5);
        $allergies = Allergy::all();

        return view('allergies.index', [
            'families' => $families,
            'allergies' => $allergies,
            'selectedAllergy' => $allergyId,
        ]);
    }
}
   
