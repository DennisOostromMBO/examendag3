@extends('layouts.main')

@section('title', 'Overzicht gezinnen met allergieën')

@section('content')
<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-12">
            <a href="#" class="fw-bold text-success" style="text-decoration: underline; font-size: 1.2rem;">Overzicht gezinnen met allergieën</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <select class="form-select w-auto me-2" aria-label="Selecteer Allergie">
                <option selected>Selecteer Allergie</option>
                <option value="1">Gluten</option>
                <option value="2">Lactose</option>
                <option value="3">Noten</option>
            </select>
            <button class="btn btn-dark">Toon Gezinnen</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
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
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>~~~~~</td>
                        <td>~~~~~</td>
                        <td>~~~~~</td>
                        <td>~~~~~</td>
                        <td>~~~~~</td>
                        <td>~~~~~</td>
                        <td class="text-center">
                            <a href="#" title="Details"><span class="bi bi-info-circle"></span></a>
                        </td>
                    </tr>
                    @endfor
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
