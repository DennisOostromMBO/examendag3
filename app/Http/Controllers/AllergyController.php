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
        $families = Allergy::getFamiliesWithAllergies($allergyId, 3);
        $allergies = Allergy::all();

        // Fix: Only filter the collection by familie_id, then update paginator items
        // Also, make sure to use the familie_id as string for unique, as sometimes it can be int/object
        $uniqueFamilies = $families->getCollection()
            ->unique(function($item) { return (string) $item->familie_id; })
            ->values();
        $families->setCollection($uniqueFamilies);

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

        // Only show warning if current allergy is "Pinda's" and confirm is NOT set
        if ($currentAllergy && strtolower($currentAllergy->name) === "pinda's" && !request()->has('confirm')) {
            return view('allergies.edit_person_allergy', [
                'person' => $person,
                'allergies' => $allergies,
                'currentAllergyId' => $currentAllergyId,
                'show_pinda_warning' => true,
            ]);
        }

        // If confirm is set, show the edit form as normal
        return view('allergies.edit_person_allergy', compact('person', 'allergies', 'currentAllergyId'));
    }

    // Update a person's allergy
    public function updatePersonAllergy(Request $request, $personId)
    {
        $request->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);

        $allergies = \App\Models\Allergy::all();
        $currentAllergyId = DB::table('allergy_person')->where('person_id', $personId)->pluck('allergy_id')->first();
        $currentAllergy = $allergies->firstWhere('id', $currentAllergyId);

        // If current allergy is "Pinda's" and not confirmed, show warning before updating
        if ($currentAllergy && strtolower($currentAllergy->name) === "pinda's" && !$request->has('confirm')) {
            return redirect()
                ->route('allergies.person.edit', ['personId' => $personId, 'confirm' => 1])
                ->withInput()
                ->with([
                    'show_pinda_warning' => true,
                    'selected_allergy_id' => $request->allergy_id,
                ]);
        }

        try {
            \App\Models\Allergy::updatePersonAllergySP($personId, $request->allergy_id);

            return redirect()
                ->route('allergies.person.edit', ['personId' => $personId])
                ->with('success', 'De wijziging is doorgevoerd')
                ->with('delay', 3)
                ->with('familyId', \App\Models\Person::find($personId)->family_id);
        } catch (\Exception $e) {
            return redirect()
                ->route('allergies.person.edit', ['personId' => $personId])
                ->with('error', 'Er is een fout opgetreden bij het opslaan: ' . $e->getMessage());
        }
    }
}






