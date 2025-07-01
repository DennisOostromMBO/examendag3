@extends('layouts.main')

@section('title', 'Wijzig Allergie')

@section('content')
<div class="max-w-lg mx-auto mt-10 shadow p-6 bg-white rounded">
    <h2 class="text-green-700 font-bold underline text-xl mb-6">Wijzig allergie</h2>
    @if(session('show_pinda_warning'))
        <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
            Voor het wijzigen van deze allergie wordt geadviseerd eerst een arts te raadplegen vanwege een hoog risico op een anafylactisch shock
        </div>
    @endif
    <form method="POST" action="{{ route('allergies.person.update', ['personId' => $person->id]) }}">
        @csrf
        @if(session('show_pinda_warning'))
            <input type="hidden" name="confirm" value="1">
            <input type="hidden" name="allergy_id" value="{{ session('selected_allergy_id') }}">
        @endif
        <div class="mb-6">
            <select name="allergy_id" id="allergy_id" class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" @if(session('show_pinda_warning')) disabled @endif>
                @foreach($allergies as $allergy)
                    <option value="{{ $allergy->id }}"
                        @if(session('show_pinda_warning'))
                            {{ session('selected_allergy_id') == $allergy->id ? 'selected' : '' }}
                        @else
                            {{ (old('allergy_id', $currentAllergyId) == $allergy->id) ? 'selected' : '' }}
                        @endif
                    >
                        {{ $allergy->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-between">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                Wijzig Allergie
            </button>
            <div class="space-x-2">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Terug</a>
                <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Home</a>
            </div>
        </div>
    </form>
</div>
@endsection

