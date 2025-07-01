@extends('layouts.main')

@section('title', 'Waarschuwing bij wijzigen allergie')

@section('content')
<div class="max-w-lg mx-auto mt-10 shadow p-6 bg-white rounded">
    <div class="mb-6 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
        Voor het wijzigen van deze allergie wordt geadviseerd eerst een arts te raadplegen vanwege een hoog risico op een anafylactisch shock
    </div>
    <div class="flex justify-end space-x-2">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Terug</a>
        <a href="{{ route('allergies.person.edit', ['personId' => $person->id, 'confirm' => 1]) }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            Verder met wijzigen
        </a>
    </div>
</div>
@endsection
