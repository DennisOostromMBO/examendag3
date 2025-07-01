@extends('layouts.main')

@section('title', 'Product Details - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Product Details</h2>
            <p class="text-muted small">
                <a href="{{ route('home') }}" class="text-decoration-none">Homepage voedselbank maaskantje</a> > 
                <a href="{{ route('stocks.overview') }}" class="text-decoration-none">Voorraad</a> > 
                Product {{ $product->name }}
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Product Edit Form -->
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('stocks.product.update', $product->id) }}">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        <h4>Product Bewerken</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Productnaam</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $product->name) }}" required>
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Categorie</label>
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
