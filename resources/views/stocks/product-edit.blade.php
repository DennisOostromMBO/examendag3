{{--
/**
 * Product Edit View (Wijzig Product Details)
 *
 * Form interface for editing product stock information and quantities.
 * Allows authorized users to modify delivery quantities, dates, and track
 * stock movements within the Voedselbank inventory system.
 *
 * Features:
 * - Read-only product information display
 * - Editable delivery quantity and date fields
 * - Real-time stock calculation display
 * - Form validation with error handling
 * - Success message with auto-redirect
 * - Responsive design for all devices
 *
 * Data Sources:
 * - $product: Product model with basic information
 * - $stockInfo: Array with current stock levels and warehouse data
 * - $categories: Available product categories (for reference)
 *
 * User Permissions: Requires stock management permissions
 *
 * Form Security:
 * - CSRF protection enabled
 * - Server-side validation
 * - Business logic validation (sufficient stock checks)
 *
 * Navigation Paths:
 * - From: Product details view, stock overview
 * - To: Product details view (after success), previous page (on error)
 *
 * @extends layouts.main
 * @author Voedselbank Maaskantje Development Team
 * @version 1.0
 */
--}}

@extends('layouts.main')

@section('title', 'Wijzig Product Details - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    {{-- Page Header Section --}}
    <div class="row mb-4">
        <div class="col-12">
            {{-- Dynamic page title with product name --}}
            {{-- Shows current product being edited for user context --}}
            <h2>Wijzig Product Details {{ $product->name ?? 'Aardappel' }}</h2>
        </div>
    </div>

    {{-- Success Message Section --}}
    {{-- Displays when product update is successful --}}
    {{-- Auto-dismissible alert with fade animation --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message Section --}}
    {{-- Displays validation errors or business logic failures --}}
    {{-- Pink background matching Wireframe 7 design --}}
    @if(session('error') || $errors->any())
        <div class="alert alert-danger" style="background-color: #f8d7da; border-color: #f5c6cb; color: #721c24;">
            <i class="fas fa-exclamation-triangle me-2"></i>
            @if(session('error'))
                De productgegevens kunnen niet worden gewijzigd
            @endif
            @if($errors->any())
                <div class="mt-2">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Product Information Display Section --}}
    {{-- Read-only table showing current product details --}}
    {{-- Provides context for users before making edits --}}
    <div class="row mb-4">
        <div class="col-12">
            {{-- Bootstrap table with borders for clear data separation --}}
            <table class="table table-bordered">
                {{-- Product Name Row --}}
                <tr>
                    <td><strong>Productnaam</strong></td>
                    <td>{{ $product->name ?? '~' }}</td>
                </tr>
                {{-- Expiry Date Row - Critical for food safety --}}
                <tr>
                    <td><strong>Houdbaarheidsdatum</strong></td>
                    <td>{{ $product->expiration_date ?? '~' }}</td>
                </tr>
                {{-- Barcode Row - For inventory tracking --}}
                <tr>
                    <td><strong>Barcode</strong></td>
                    <td>{{ $product->barcode ?? '~' }}</td>
                </tr>
                {{-- Warehouse Location Row - Physical location tracking --}}
                <tr>
                    <td><strong>Magazijn Locatie</strong></td>
                    <td>{{ $stockInfo['warehouse_name'] ?? 'Benicum' }}</td>
                </tr>
                {{-- Received Date Row - When stock was received --}}
                <tr>
                    <td><strong>Ontvangstdatum</strong></td>
                    <td>{{ $stockInfo['received_date'] ? date('d-m-Y', strtotime($stockInfo['received_date'])) : date('d-m-Y') }}</td>
                </tr>
                {{-- Delivery Date Row - When stock was delivered --}}
                <tr>
                    <td><strong>Uitleveringsdatum</strong></td>
                    <td>{{ $stockInfo['delivery_date'] ? date('d-m-Y', strtotime($stockInfo['delivery_date'])) : date('d-m-Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Product Edit Form Section --}}
    {{-- Main form for updating stock quantities and delivery information --}}
    <div class="row">
        <div class="col-12">
            {{-- Form with CSRF protection and PUT method --}}
            {{-- Submits to updateProduct controller method --}}
            <form method="POST" action="{{ route('stocks.product.update', $product->id ?? 1) }}">
                @csrf
                @method('PUT')

                {{-- Delivered Quantity Field --}}
                {{-- Main editable field for updating stock quantities --}}
                <div class="mb-3">
                    <label for="delivered_quantity" class="form-label"><strong>Aantal uitgeleverde producten:</strong></label>
                    <input type="number" class="form-control @if(session('error') || $errors->has('delivered_quantity')) is-invalid @endif"
                           id="delivered_quantity" name="delivered_quantity"
                           value="{{ old('delivered_quantity', $stockInfo['delivered_quantity'] ?? 0) }}"
                           required min="0">

                    {{-- Error messages specifically for this field matching Wireframe 7 --}}
                    @if(session('error') && str_contains(session('error'), 'meer producten uitgeleverd'))
                        <div class="text-danger mt-1" style="font-size: 0.875rem;">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Er worden meer producten uitgeleverd dan er in voorraad zijn
                        </div>
                    @endif

                    {{-- Display other validation errors for this field --}}
                    @error('delivered_quantity')
                        <div class="text-danger mt-1" style="font-size: 0.875rem;">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Hidden field to maintain current delivery date --}}
                <input type="hidden" name="delivery_date" value="{{ $stockInfo['delivery_date'] ?? date('Y-m-d') }}">

                {{-- Current Stock Display Field --}}
                {{-- Read-only field showing calculated current stock levels --}}
                <div class="mb-3">
                    <label for="stock_quantity" class="form-label"><strong>Aantal op voorraad</strong></label>
                    <input type="text" class="form-control" id="stock_quantity"
                           value="{{ $stockInfo['current_stock'] ?? '~' }}" readonly>
                </div>

                {{-- Form Action Buttons --}}
                {{-- Navigation and submission options --}}
                <div class="d-flex gap-2">
                    {{-- Submit button for saving changes --}}
                    <button type="submit" class="btn btn-primary">Wijzig Product Details</button>
                    {{-- Back button using browser history --}}
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Terug</button>
                    {{-- Home button for quick navigation --}}
                    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
