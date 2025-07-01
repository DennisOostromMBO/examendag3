@extends('layouts.main')

@section('title', 'Status wijzigen')

@section('content')
<div class="container mt-4">
    <h4>Status wijzigen voor pakket {{ $pakket->Pakketnummer }}</h4>
    <form method="POST" action="{{ route('food-packages.update', $pakket->Pakketnummer) }}">
        @csrf
        <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select name="Status" id="Status" class="form-select" required>
                @foreach($statusOptions as $option)
                    <option value="{{ $option }}" {{ $pakket->Status == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Opslaan</button>
        <a href="{{ route('food-packages.show', $pakket->Pakketnummer) }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
