@extends('layouts.main')

@section('title', 'Overzicht Productvoorraden - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="text-success">Overzicht Productvoorraden</h2>
        </div>
        <div class="col-md-4 text-end">
            <form method="GET" action="{{ route('stocks.overview') }}" class="d-flex align-items-center justify-content-end gap-2">
                <select name="category" id="category" class="form-select" style="max-width: 200px;">
                    <option value="all" {{ !$categoryFilter || $categoryFilter === 'all' ? 'selected' : '' }}>
                        Selecteer Categorie
                    </option>
                    @foreach($categories as $code => $name)
                        <option value="{{ $code }}" {{ $categoryFilter === $code ? 'selected' : '' }}>
                            {{ $code }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary">Toon Voorraad</button>
            </form>
        </div>
    </div>

    <!-- Results Table -->
    @if(count($stocks) > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Productnaam</th>
                        <th>Categorie</th>
                        <th>Eenheid</th>
                        <th>Aantal</th>
                        <th>Houdbaarheidsdatum</th>
                        <th>Magazijn</th>
                        <th>Voorraad Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>
                                <a href="{{ route('stocks.product.show', $stock['product_id']) }}" class="text-decoration-none">
                                    {{ $stock['item_name'] ?? '~' }}
                                </a>
                            </td>
                            <td>{{ $stock['category'] ?? '~' }}</td>
                            <td>{{ $stock['unit'] ?? '~' }}</td>
                            <td>{{ $stock['quantity'] ?? '~' }}</td>
                            <td>{{ $stock['expiry_date'] ?? '~' }}</td>
                            <td>{{ $stock['supplier'] ?? '~' }}</td>
                            <td class="text-center">
                                <a href="{{ route('stocks.product.show', $stock['product_id']) }}" class="text-decoration-none">📋</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            @if($categoryFilter && $categoryFilter !== 'all')
                <div class="alert alert-warning d-inline-block">
                    Er zijn geen producten bekend die behoren bij de geselecteerde productcategorie
                </div>
            @else
                <div class="alert alert-light d-inline-block">
                    Geen voorraadproducten gevonden.
                </div>
            @endif
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
            <a href="{{ route('home') }}" class="btn btn-primary">home</a>
        </div>
    </div>
</div>
@endsection
