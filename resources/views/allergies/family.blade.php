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
                    <a href="{{ route('allergies.person.edit', ['personId' => $person->id]) }}" title="Wijzig Allergie">
                        <span class="bi bi-pencil"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('allergies.index') }}" class="btn btn-primary">Terug</a>
</div>
@endsection
