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
        $families = Allergy::getFamiliesWithAllergies($allergyId);
        $allergies = Allergy::all();

        // Debug: dump the families variable
        // Remove this after debugging
        // dd($families);

        return view('allergies.index', [
            'families' => $families,
            'allergies' => $allergies,
            'selectedAllergy' => $allergyId,
        ]);
    }
}

