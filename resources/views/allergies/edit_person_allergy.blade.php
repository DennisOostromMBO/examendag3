@extends('layouts.main')

@section('title', 'Wijzig Allergie')

@section('content')
<div class="container mt-4">
    <h2>Wijzig allergie voor: {{ $person->first_name }} {{ $person->insertion }} {{ $person->last_name }}</h2>
    <form method="POST" action="{{ route('allergies.person.update', ['personId' => $person->id]) }}">
        @csrf
        <div class="mb-3">
            <label for="allergy_id" class="form-label">Allergie</label>
            <select name="allergy_id" id="allergy_id" class="form-select">
                @foreach($allergies as $allergy)
                    <option value="{{ $allergy->id }}" {{ $currentAllergyId == $allergy->id ? 'selected' : '' }}>
                        {{ $allergy->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
            </svg>
            Wijzig Allergie
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuleer</a>
    </form>
</div>
@endsection
