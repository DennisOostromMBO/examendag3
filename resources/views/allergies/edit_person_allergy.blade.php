@extends('layouts.main')

@section('title', 'Wijzig Allergie')

@section('content')
<div class="max-w-lg mx-auto mt-10 shadow p-6 bg-white rounded">
    <h2 class="text-green-700 font-bold underline text-xl mb-6">Wijzig allergie</h2>
    {{-- Pinda warning and confirmation --}}
    @if(isset($show_pinda_warning) && $show_pinda_warning)
        <form method="POST" action="{{ route('allergies.person.update', ['personId' => $person->id]) }}">
            @csrf
            <input type="hidden" name="confirm" value="1">
            <div class="mb-6">
                <select name="allergy_id" id="allergy_id" required class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                    <option value="" disabled selected>Kies een allergie</option>
                    @foreach($allergies as $allergy)
                        <option value="{{ $allergy->id }}"
                            {{ (isset($selected_allergy_id) ? $selected_allergy_id : old('allergy_id', $currentAllergyId)) == $allergy->id ? 'selected' : '' }}>
                            {{ $allergy->name }}
                        </option>
                    @endforeach
                </select>
                {{-- Pinda warning below dropdown --}}
                <div class="mt-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                    Voor het wijzigen van deze allergie wordt geadviseerd eerst een arts te raadplegen vanwege een hoog risico op een anafylactisch shock
                </div>
                {{-- Success message --}}
                @if(session('success'))
                    <div class="mt-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                        @if(session('delay') && session('familyId'))
                            <script>
                                setTimeout(function() {
                                    window.location.href = "{{ route('allergies.family', ['familyId' => session('familyId')]) }}";
                                }, {{ session('delay') * 1000 }});
                            </script>
                        @endif
                    </div>
                @endif
                {{-- Error message --}}
                @if(session('error'))
                    <div class="mt-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
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
    @else
        <form method="POST" action="{{ route('allergies.person.update', ['personId' => $person->id]) }}">
            @csrf
            <div class="mb-6">
                <select name="allergy_id" id="allergy_id" required class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                    <option value="" disabled selected>Kies een allergie</option>
                    @foreach($allergies as $allergy)
                        <option value="{{ $allergy->id }}"
                            {{ (old('allergy_id', $currentAllergyId) == $allergy->id) ? 'selected' : '' }}>
                            {{ $allergy->name }}
                        </option>
                    @endforeach
                </select>
                {{-- Success message --}}
                @if(session('success'))
                    <div class="mt-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                        @if(session('delay') && session('familyId'))
                            <script>
                                setTimeout(function() {
                                    window.location.href = "{{ route('allergies.family', ['familyId' => session('familyId')]) }}";
                                }, {{ session('delay') * 1000 }});
                            </script>
                        @endif
                    </div>
                @endif
                {{-- Error message --}}
                @if(session('error'))
                    <div class="mt-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
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
    @endif
</div>
@endsection



