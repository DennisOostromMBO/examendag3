@extends('layouts.main')

@section('title', 'Voedselpakketten - Voedselbank Maaskantje')

@section('content')
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
            <select class="form-select">
                <option selected>Selecteer Eetwens</option>
                <option value="1">Omnivoor</option>
                <option value="2">Vegentarisch</option>
                <option value="3">Veganistisch</option>
                <option value="4">GeenVarken</option>
            </select>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-secondary">Toon Gezinnen</button>
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
                        <th>Voedselpakket Details</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                        <tr>
                            <td>~~~~</td>
                            <td>~~~~</td>
                            <td>~~~~</td>
                            <td>~~~~</td>
                            <td>~~~~</td>
                            <td>~~~~</td>
                            <td class="text-center">
                                <i class="bi bi-box"></i>
                            </td>
                        </tr>
                    @endfor
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
