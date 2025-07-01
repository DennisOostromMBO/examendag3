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
        <button type="submit" class="btn btn-success">Wijzig Allergie</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuleer</a>
    </form>
</div>
@endsection
