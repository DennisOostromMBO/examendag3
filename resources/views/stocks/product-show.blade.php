@extends('layouts.main')

@section('title', 'Product Details - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Product Details {{ $product->name ?? 'Aardappel' }}</h2>
        </div>
    </div>

    <!-- Product Details Display -->
    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Productnaam</strong></td>
                    <td>{{ $product->name ?? '~' }}</td>
                </tr>
                <tr>
                    <td><strong>Houdbaarheidsdatum</strong></td>
                    <td>{{ $product->expiration_date ?? '~' }}</td>
                </tr>
                <tr>
                    <td><strong>Barcode</strong></td>
                    <td>{{ $product->barcode ?? '~' }}</td>
                </tr>
                <tr>
                    <td><strong>Magazijn Locatie</strong></td>
                    <td>{{ $stockInfo['warehouse_name'] ?? 'Benicum' }}</td>
                </tr>
                <tr>
                    <td><strong>Ontvangstdatum</strong></td>
                    <td>{{ $stockInfo['received_date'] ? date('d-m-Y', strtotime($stockInfo['received_date'])) : date('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Aantal uitgeleverde producten:</strong></td>
                    <td>{{ $stockInfo['delivered_quantity'] ?? 0 }}</td>
                </tr>
                <tr>
                    <td><strong>Uitleveringsdatum</strong></td>
                    <td>{{ $stockInfo['delivery_date'] ? date('d-m-Y', strtotime($stockInfo['delivery_date'])) : '~' }}</td>
                </tr>
                <tr>
                    <td><strong>Aantal op voorraad</strong></td>
                    <td>{{ $stockInfo['current_stock'] ?? '~' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12 d-flex gap-2">
            <a href="{{ route('stocks.product.edit', $product->id ?? 1) }}" class="btn btn-primary">Wijzig</a>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Terug</button>
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
        </div>
    </div>
</div>
@endsection
