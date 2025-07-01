@extends('layouts.main')

@section('title', 'Voedselpakketten - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Voedselpakketten</h2>
            <p class="text-muted small">
                <a href="{{ route('home') }}" class="text-decoration-none">Homepage voedselbank maaskantje</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <p>Voedselpakketten beheer functionaliteit komt binnenkort beschikbaar.</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('home') }}" class="btn btn-primary">home</a>
        </div>
    </div>
</div>
@endsection
