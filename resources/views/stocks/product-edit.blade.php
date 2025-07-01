@extends('layouts.main')

@section('title', 'Wijzig Product Details - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Wijzig Product Details {{ $product->name ?? 'Aardappel' }}</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('stocks.product.show', $product->id ?? 1) }}";
            }, 3000);
        </script>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

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
            </table>
        </div>
    </div>

    <!-- Product Edit Form -->
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('stocks.product.update', $product->id ?? 1) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="delivered_quantity" class="form-label"><strong>Aantal aangeleverde producten:</strong></label>
                    <input type="number" class="form-control" id="delivered_quantity" name="delivered_quantity"
                           value="{{ old('delivered_quantity', $stockInfo['delivered_quantity'] ?? 0) }}" required min="0">
                    @error('delivered_quantity')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="delivery_date" class="form-label"><strong>Uitleveringsdatum</strong></label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                           value="{{ old('delivery_date', $stockInfo['delivery_date'] ?? date('Y-m-d')) }}">
                    @error('delivery_date')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="stock_quantity" class="form-label"><strong>Aantal op voorraad</strong></label>
                    <input type="text" class="form-control" id="stock_quantity" value="{{ $stockInfo['current_stock'] ?? '~' }}" readonly>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Wijzig Product Details</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Terug</button>
                    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
