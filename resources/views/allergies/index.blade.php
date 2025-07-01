@extends('layouts.main')

@section('title', 'Overzicht gezinnen met allergieën')

@section('content')
@php
    $allergies = $allergies ?? collect();
    $families = $families ?? collect();
    $selectedAllergy = $selectedAllergy ?? '';
@endphp
<div class="max-w-6xl mx-auto mt-8">
    <div class="mb-4">
        <a href="#" class="font-bold text-green-600 underline text-xl">Overzicht gezinnen met allergieën</a>
    </div>
    <div class="mb-6 flex justify-end items-center">
        <form method="GET" class="flex space-x-2">
            <select name="allergy_id" class="block w-auto px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" aria-label="Selecteer Allergie">
                <option value="">Selecteer Allergie</option>
                @foreach($allergies as $allergy)
                    <option value="{{ $allergy->id }}" {{ ($selectedAllergy == $allergy->id) ? 'selected' : '' }}>
                        {{ $allergy->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition">Toon Gezinnen</button>
        </form>
    </div>
    <div>
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">Naam</th>
                        <th class="px-4 py-2 border-b">Omschrijving</th>
                        <th class="px-4 py-2 border-b">Volwassenen</th>
                        <th class="px-4 py-2 border-b">Kinderen</th>
                        <th class="px-4 py-2 border-b">Babys</th>
                        <th class="px-4 py-2 border-b">Vertegenwoordiger</th>
                        <th class="px-4 py-2 border-b">Allergie Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($families as $family)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $family->familie_naam }}</td>
                        <td class="px-4 py-2 border-b">{{ $family->familie_omschrijving }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $family->volwassenen }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $family->kinderen }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $family->babys }}</td>
                        <td class="px-4 py-2 border-b">{{ $family->vertegenwoordiger }}</td>
                        <td class="px-4 py-2 border-b text-center">
                            <a href="{{ route('allergies.family', ['familyId' => $family->familie_id]) }}" title="Details" aria-label="Details" class="inline-block text-blue-600 hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                                </svg>
                            </a>
                            <a href="{{ route('allergies.family', ['familyId' => $family->familie_id]) }}" title="Wijzig Allergieën" aria-label="Wijzig Allergieën" class="inline-block text-yellow-600 hover:text-yellow-800 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                        @if($selectedAllergy)
                        <tr>
                            <td colspan="7" class="text-center text-red-600 py-4">
                                Er zijn geen gezinnen bekent die de geselecteerde allergie hebben
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="7" class="text-center py-4">Geen gezinnen gevonden.</td>
                        </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination links --}}
        <div class="flex justify-center mt-4">
            {{ $families->links() }}
        </div>
    </div>
    <div class="flex justify-end mt-6">
        <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Home</a>
    </div>
</div>
@endsection


