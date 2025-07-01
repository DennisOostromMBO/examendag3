@extends('layouts.main')

@section('title', 'Overzicht gezinnen met allergieën')

@section('content')
@php
    $allergies = $allergies ?? collect();
    $families = $families ?? collect();
    $selectedAllergy = $selectedAllergy ?? '';
@endphp
<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-12">
            <a href="#" class="fw-bold text-success" style="text-decoration: underline; font-size: 1.2rem;">Overzicht gezinnen met allergieën</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <form method="GET" class="d-flex">
                <select name="allergy_id" class="form-select w-auto me-2" aria-label="Selecteer Allergie">
                    <option value="">Selecteer Allergie</option>
                    @foreach($allergies as $allergy)
                        <option value="{{ $allergy->id }}" {{ ($selectedAllergy == $allergy->id) ? 'selected' : '' }}>
                            {{ $allergy->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-dark">Toon Gezinnen</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{-- Debug output --}}
            <div>
                <strong>Count:</strong> {{ count($families) }}
                @if(count($families))
                    <pre>{{ print_r($families[0], true) }}</pre>
                @endif
            </div>
            @if(config('app.debug'))
                <pre style="background:#f8f9fa; color:#333; border:1px solid #ccc; padding:10px;">
families: {{ var_export($families, true) }}
                </pre>
            @endif
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Naam</th>
                        <th>Omschrijving</th>
                        <th>Volwassenen</th>
                        <th>Kinderen</th>
                        <th>Babys</th>
                        <th>Vertegenwoordiger</th>
                        <th>Allergie Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($families as $family)
                    <tr>
                        <td>{{ $family->familie_naam }}</td>
                        <td>{{ $family->familie_omschrijving }}</td>
                        <td>{{ $family->volwassenen }}</td>
                        <td>{{ $family->kinderen }}</td>
                        <td>{{ $family->babys }}</td>
                        <td>{{ $family->vertegenwoordiger }}</td>
                        <td class="text-center">
                            <a href="#" title="Details" data-bs-toggle="tooltip" data-bs-placement="top" 
                               data-allergy="{{ $family->allergie_naam }}" 
                               data-description="{{ $family->allergie_omschrijving }}">
                                <span class="bi bi-info-circle"></span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Geen gezinnen gevonden.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
        </div>
    </div>
</div>
@endsection

