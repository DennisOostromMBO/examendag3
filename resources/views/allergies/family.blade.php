@extends('layouts.main')

@section('title', 'Allergieën in het gezin')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
    <div class="mb-4">
        <a href="#" class="font-bold text-green-600 underline text-lg">Allergieën in het gezin</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
            @if(session('delay'))
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('allergies.family', ['familyId' => $family->id]) }}";
                    }, {{ session('delay') * 1000 }});
                </script>
            @endif
        </div>
    @endif

    <!-- Family summary table -->
    <div class="mb-6">
        <table class="min-w-[300px] bg-white border border-gray-200 text-sm">
            <tr>
                <td class="font-semibold px-3 py-2 border-b border-r w-48">Gezinsnaam:</td>
                <td class="px-3 py-2 border-b">{{ $family->name }}</td>
            </tr>
            <tr>
                <td class="font-semibold px-3 py-2 border-b border-r">Omschrijving:</td>
                <td class="px-3 py-2 border-b">{{ $family->description }}</td>
            </tr>
            <tr>
                <td class="font-semibold px-3 py-2 border-r">Totaal aantal Personen:</td>
                <td class="px-3 py-2">{{ $family->total_persons }}</td>
            </tr>
        </table>
    </div>

    <!-- Persons and allergies table -->
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">Naam</th>
                    <th class="px-4 py-2 border-b">Type Persoon</th>
                    <th class="px-4 py-2 border-b">Gezinsrol</th>
                    <th class="px-4 py-2 border-b">Allergie</th>
                    <th class="px-4 py-2 border-b">Wijzig Allergie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persons as $person)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">
                        {{ $person->first_name }} {{ $person->insertion }} {{ $person->last_name }}
                    </td>
                    <td class="px-4 py-2 border-b">
                        {{ ucfirst($person->person_type) }}
                    </td>
                    <td class="px-4 py-2 border-b">
                        {{ $person->is_representative ? 'Vertegenwoordiger' : 'Gezinslid' }}
                    </td>
                    <td class="px-4 py-2 border-b">
                        @php
                            $allergy = $allergies->firstWhere('id', $personAllergies[$person->id] ?? null);
                        @endphp
                        {{ $allergy ? $allergy->name : 'Geen' }}
                    </td>
                    <td class="px-4 py-2 border-b text-center">
                        <a href="{{ route('allergies.person.edit', ['personId' => $person->id]) }}" title="Wijzig Allergie" class="inline-block text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-end space-x-2 mt-4">
        <a href="{{ route('allergies.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">terug</a>
        <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">home</a>
    </div>
</div>
@endsection
