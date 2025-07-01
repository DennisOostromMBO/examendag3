<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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

    // Show all allergies for a family
    public function familyAllergies($familyId)
    {
        $family = DB::table('families')->where('id', $familyId)->first();
        if (!$family) {
            abort(404);
        }
        $persons = Person::where('family_id', $familyId)->get();
        $allergies = \App\Models\Allergy::all();

        // Get each person's allergy (assuming one allergy per person for simplicity)
        $personAllergies = [];
        foreach ($persons as $person) {
            $personAllergies[$person->id] = DB::table('allergy_person')
                ->where('person_id', $person->id)
                ->pluck('allergy_id')
                ->first();
        }

        return view('allergies.family', compact('family', 'persons', 'allergies', 'personAllergies'));
    }

    // Show edit form for a person's allergy
    public function editPersonAllergy($personId)
    {
        $person = Person::findOrFail($personId);
        $allergies = \App\Models\Allergy::all();
        $currentAllergyId = DB::table('allergy_person')->where('person_id', $personId)->pluck('allergy_id')->first();
        $currentAllergy = $allergies->firstWhere('id', $currentAllergyId);

        // No more separate warning view, always show edit page
        return view('allergies.edit_person_allergy', compact('person', 'allergies', 'currentAllergyId'));
    }

    // Update a person's allergy
    public function updatePersonAllergy(Request $request, $personId)
    {
        $request->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);

        $selectedAllergy = \App\Models\Allergy::find($request->allergy_id);

        // If selected allergy is "Pinda's" and not confirmed, show warning before updating
        if ($selectedAllergy && strtolower($selectedAllergy->name) === "pinda's" && !$request->has('confirm')) {
            // Show warning, keep selected allergy in the form
            return back()
                ->withInput()
                ->with([
                    'show_pinda_warning' => true,
                    'selected_allergy_id' => $selectedAllergy->id,
                ]);
        }

        try {
            // Use stored procedure via model
            \App\Models\Allergy::updatePersonAllergySP($personId, $request->allergy_id);

            // Redirect back to the edit page with success message
            return redirect()
                ->route('allergies.person.edit', ['personId' => $personId])
                ->with('success', 'De wijziging is doorgevoerd');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()
                ->route('allergies.person.edit', ['personId' => $personId])
                ->with('error', 'Er is een fout opgetreden bij het opslaan: ' . $e->getMessage());
        }
    }
}






