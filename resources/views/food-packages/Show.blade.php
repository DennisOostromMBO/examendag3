@extends('layouts.main')

@section('title', 'Voedselpakket Details')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<div class="container mt-4">
    <h4>
        <a href="{{ route('food-packages.index') }}" class="text-success text-decoration-none">
            Overzicht Voedselpakketten
        </a>
    </h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('food-packages.index') }}";
            }, 3000);
        </script>
    @endif

    <table class="table table-bordered w-auto mb-4">
        <tr>
            <th>Naam:</th>
            <td>{{ $parcel->Gezinsnaam }}</td>
        </tr>
        <tr>
            <th>Omschrijving:</th>
            <td>{{ $parcel->Omschrijving }}</td>
        </tr>
        <tr>
            <th>Totaal aantal Personen:</th>
            <td>{{ $parcel->Volwassenen + $parcel->Kinderen + $parcel->Babys }}</td>
        </tr>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pakketnummer</th>
                <th>Datum samenstelling</th>
                <th>Datum uitgifte</th>
                <th>Status</th>
                <th>Aantal producten</th>
                <th>Wijzig Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pakketten as $pakket)
                <tr>
                    <td>{{ $pakket->Pakketnummer }}</td>
                    <td>{{ $pakket->DatumSamenstelling }}</td>
                    <td>{{ $pakket->DatumUitgifte }}</td>
                    <td>{{ $pakket->Status }}</td>
                    <td>{{ $pakket->AantalProducten }}</td>
                    <td class="text-center">
                        <a href="{{ route('food-packages.edit', $pakket->Pakketnummer) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('food-packages.index') }}" class="btn btn-primary">terug</a>
        <a href="{{ route('home') }}" class="btn btn-primary">home</a>
    </div>
</div>
@endsection
