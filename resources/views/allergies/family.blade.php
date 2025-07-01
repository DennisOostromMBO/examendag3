@extends('layouts.main')

@section('title', 'Allergieën in het gezin')

@section('content')
<div class="container mt-4">
    <h2>Allergieën in het gezin: {{ $family->name }}</h2>
    @if(session('success'))
        <div class="alert alert-success">
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
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Allergie</th>
                <th>Wijzig Allergie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($persons as $person)
            <tr>
                <td>{{ $person->first_name }} {{ $person->insertion }} {{ $person->last_name }}</td>
                <td>
                    @php
                        $allergy = $allergies->firstWhere('id', $personAllergies[$person->id] ?? null);
                    @endphp
                    {{ $allergy ? $allergy->name : 'Geen' }}
                </td>
                <td>
                    <a href="{{ route('allergies.person.edit', ['personId' => $person->id]) }}" title="Wijzig Allergie" class="inline-block text-yellow-600 hover:text-yellow-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('allergies.index') }}" class="btn btn-primary">Terug</a>
</div>
@endsection
