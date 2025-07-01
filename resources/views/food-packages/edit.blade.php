@extends('layouts.main')

@section('title', 'Status wijzigen')

@section('content')
<div class="container mt-4">
    <h4>Status wijzigen voor pakket {{ $pakket->Pakketnummer }}</h4>

    @if($disabled)
        <div class="alert alert-warning">
            Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket worden uitgereikt
        </div>
    @endif

    <form method="POST" action="{{ route('food-packages.update', $pakket->Pakketnummer) }}">
        @csrf
        <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select name="Status" id="Status" class="form-select" required {{ $disabled ? 'disabled' : '' }}>
                @foreach($statusOptions as $option)
                    <option value="{{ $option }}" {{ $pakket->Status == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success" {{ $disabled ? 'disabled' : '' }}>Wijzig status voedselpakket</button>
        <a href="{{ route('food-packages.show', $pakket->Pakketnummer) }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
