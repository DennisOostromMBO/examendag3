@extends('layouts.main')

@section('title', 'Wijzig Allergie')

@section('content')
<div class="max-w-lg mx-auto mt-10 shadow p-6 bg-white rounded">
    <h2 class="text-green-700 font-bold underline text-xl mb-6">Wijzig allergie</h2>
    <form method="POST" action="{{ route('allergies.person.update', ['personId' => $person->id]) }}">
        @csrf
        <div class="mb-6">
            <select name="allergy_id" id="allergy_id" class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                @foreach($allergies as $allergy)
                    <option value="{{ $allergy->id }}" {{ $currentAllergyId == $allergy->id ? 'selected' : '' }}>
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

