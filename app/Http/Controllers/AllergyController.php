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
        $family = \App\Models\Family::findOrFail($familyId);
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

        return view('allergies.edit_person_allergy', compact('person', 'allergies', 'currentAllergyId'));
    }

    // Update a person's allergy
    public function updatePersonAllergy(Request $request, $personId)
    {
        $request->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);

        // Remove old allergy and add new one (assuming one allergy per person)
        DB::table('allergy_person')->where('person_id', $personId)->delete();
        DB::table('allergy_person')->insert([
            'person_id' => $personId,
            'allergy_id' => $request->allergy_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Feedback and redirect after 3 seconds
        return redirect()
            ->route('allergies.family', ['familyId' => Person::find($personId)->family_id])
            ->with('success', 'De wijziging is doorgevoerd')
            ->with('delay', 3);
    }
}

