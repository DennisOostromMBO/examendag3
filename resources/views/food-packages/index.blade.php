@extends('layouts.main')

@section('title', 'Voedselpakketten - Voedselbank Maaskantje')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h4>
                <a href="#" class="text-success text-decoration-none">
                    Overzicht gezinnen met voedselpakketten
                </a>
            </h4>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('food-packages.index') }}">
                <select class="form-select" name="eetwens" onchange="this.form.submit()">
                    <option value="all" {{ empty($eetwens) || $eetwens == 'all' ? 'selected' : '' }}>Selecteer Eetwens
                    </option>
                    <option value="Omnivoor" {{ (isset($eetwens) && $eetwens == 'Omnivoor') ? 'selected' : '' }}>
                        Omnivoor
                    </option>
                    <option value="Vegentarisch" {{ (isset($eetwens) && $eetwens == 'Vegentarisch') ? 'selected' : '' }}>
                        Vegentarisch
                    </option>
                    <option value="Veganistisch" {{ (isset($eetwens) && $eetwens == 'Veganistisch') ? 'selected' : '' }}>
                        Veganistisch
                    </option>
                    <option value="GeenVarken" {{ (isset($eetwens) && $eetwens == 'GeenVarken') ? 'selected' : '' }}>
                        GeenVarken
                    </option>
                </select>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <!-- Optional: Remove the button, as the form submits on change -->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Gezinsnaam</th>
                        <th>Omschrijving</th>
                        <th>Volwassenen</th>
                        <th>Kinderen</th>
                        <th>Babys</th>
                        <th>Vertegenwoordiger</th>
                        <th>VoedselPakket Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foodParcels as $parcel)
                        <tr>
                            <td>{{ $parcel->Gezinsnaam }}</td>
                            <td>{{ $parcel->Omschrijving }}</td>
                            <td>{{ $parcel->Volwassenen }}</td>
                            <td>{{ $parcel->Kinderen }}</td>
                            <td>{{ $parcel->Babys }}</td>
                            <td>{{ $parcel->Vertegenwoordiger }}</td>
                            <td>
                                @if(!empty($parcel->Pakketnummer))
                                    <a href="{{ route('food-packages.show', $parcel->Pakketnummer) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-box"></i>
                                    </a>
                                @else
                                    <span class="text-muted">Geen pakket</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">
                                @if(request('eetwens') && request('eetwens') !== 'all')
                                    <div class="alert alert-warning m-0">
                                        Er zijn geen gezinnen bekent die de geselecteerde eetwens hebben
                                    </div>
                                @else
                                    <div class="alert alert-warning m-0">
                                        Geen voedselpakketten gevonden.
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-end">
            <a href="{{ route('home') }}" class="btn btn-primary">home</a>
        </div>
    </div>
</div>
@endsection
