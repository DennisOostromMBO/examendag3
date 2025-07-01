@extends('layouts.main')

@section('title', 'Product Details - Voedselbank Maaskantje')

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
                    <td>
                        <select class="form-select" disabled>
                            <option>Benicum</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Ontvangstdatum</strong></td>
                    <td>{{ date('d-m-Y') }}</td>
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
                    <label for="quantity" class="form-label"><strong>Aantal aangeleverde producten:</strong></label>
                    <input type="number" class="form-control" id="quantity" name="quantity" 
                           value="{{ old('quantity', $currentQuantity ?? 0) }}" required min="0">
                    @error('quantity')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="delivery_date" class="form-label"><strong>Uitleveringsdatum</strong></label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date" 
                           value="{{ old('delivery_date', $warehouse->delivery_date ?? date('Y-m-d')) }}">
                    @error('delivery_date')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label"><strong>Aantal op voorraad</strong></label>
                    <input type="text" class="form-control" value="{{ $stockQuantity ?? '~' }}" readonly>
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
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        @foreach($categories as $categoryName => $categoryId)
                                            <option value="{{ $categoryId }}" 
                                                {{ old('category_id', $product->category_id) == $categoryId ? 'selected' : '' }}>
                                                {{ $categoryName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode" 
                                           value="{{ old('barcode', $product->barcode) }}" required>
                                    @error('barcode')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expiration_date" class="form-label">Vervaldatum</label>
                                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" 
                                           value="{{ old('expiration_date', $product->expiration_date) }}" required>
                                    @error('expiration_date')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="allergy_type" class="form-label">Allergie Type</label>
                                    <input type="text" class="form-control" id="allergy_type" name="allergy_type" 
                                           value="{{ old('allergy_type', $product->allergy_type) }}">
                                    @error('allergy_type')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="beschikbaar" {{ old('status', $product->status) == 'beschikbaar' ? 'selected' : '' }}>Beschikbaar</option>
                                        <option value="uitverkocht" {{ old('status', $product->status) == 'uitverkocht' ? 'selected' : '' }}>Uitverkocht</option>
                                        <option value="vervallen" {{ old('status', $product->status) == 'vervallen' ? 'selected' : '' }}>Vervallen</option>
                                    </select>
                                    @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Beschrijving</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Notities</label>
                            <textarea class="form-control" id="note" name="note" rows="2">{{ old('note', $product->note) }}</textarea>
                            @error('note')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Actief</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Product Bijwerken</button>
                        <a href="{{ route('stocks.overview') }}" class="btn btn-secondary">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('stocks.overview') }}" class="btn btn-primary">Terug naar Voorraad</a>
        </div>
    </div>
</div>
@endsection
