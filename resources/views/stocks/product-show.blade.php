{{--
/**
 * Product Details View (Product Details)
 *
 * Read-only display of comprehensive product and stock information.
 * Provides detailed view of individual products including current stock levels,
 * warehouse locations, delivery tracking, and expiry information.
 *
 * Features:
 * - Complete product information display
 * - Current stock levels and calculations
 * - Delivery tracking and dates
 * - Warehouse location information
 * - Navigation to edit form
 * - Success/error message handling
 *
 * Data Sources:
 * - $product: Product model with basic product information
 * - $stockInfo: Array containing current stock calculations and warehouse data
 *
 * User Permissions: Read access to stock information
 *
 * Navigation Paths:
 * - From: Stock overview, edit form (after updates)
 * - To: Edit form, stock overview, home
 *
 * Business Rules:
 * - Shows real-time stock calculations
 * - Displays all relevant dates in DD-MM-YYYY format
 * - Uses tilde (~) for missing/null values
 *
 * @extends layouts.main
 * @author Voedselbank Maaskantje Development Team
 * @version 1.0
 */
--}}

@extends('layouts.main')

@section('title', 'Product Details - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    {{-- Page Header Section --}}
    <div class="row mb-4">
        <div class="col-12">
            {{-- Dynamic page title showing current product name --}}
            <h2>Product Details {{ $product->name ?? 'Aardappel' }}</h2>
        </div>
    </div>

    {{-- Success Message Section --}}
    {{-- Displays when returning from successful product update --}}
    {{-- Shows confirmation message as per Wireframe-05 --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- Auto-redirect script after successful update --}}
        {{-- Gives user 3 seconds to read success message before returning to stock overview --}}
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('stocks.overview') }}";
            }, 3000);
        </script>
    @endif

    {{-- Error Message Section --}}
    {{-- Displays any error messages if needed --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Comprehensive Product Information Display --}}
    {{-- Table format for clear data presentation --}}
    <div class="row mb-4">
        <div class="col-12">
            {{-- Bootstrap table with borders for structured data display --}}
            <table class="table table-bordered">
                {{-- Basic Product Information --}}
                <tr>
                    <td><strong>Productnaam</strong></td>
                    <td>{{ $product->name ?? '~' }}</td>
                </tr>
                {{-- Expiry Date - Critical for food safety management --}}
                <tr>
                    <td><strong>Houdbaarheidsdatum</strong></td>
                    <td>{{ $product->expiration_date ?? '~' }}</td>
                </tr>
                {{-- Barcode - For inventory tracking and scanning --}}
                <tr>
                    <td><strong>Barcode</strong></td>
                    <td>{{ $product->barcode ?? '~' }}</td>
                </tr>
                {{-- Physical Storage Location --}}
                <tr>
                    <td><strong>Magazijn Locatie</strong></td>
                    <td>{{ $stockInfo['warehouse_name'] ?? 'Benicum' }}</td>
                </tr>
                {{-- Stock Received Date - When inventory was received --}}
                <tr>
                    <td><strong>Ontvangstdatum</strong></td>
                    <td>{{ $stockInfo['received_date'] ? date('d-m-Y', strtotime($stockInfo['received_date'])) : date('d-m-Y') }}</td>
                </tr>
                {{-- Delivered Quantity - How much has been distributed --}}
                <tr>
                    <td><strong>Aantal uitgeleverde producten:</strong></td>
                    <td>{{ $stockInfo['delivered_quantity'] ?? 0 }}</td>
                </tr>
                {{-- Delivery Date - When products were distributed --}}
                <tr>
                    <td><strong>Uitleveringsdatum</strong></td>
                    <td>{{ $stockInfo['delivery_date'] ? date('d-m-Y', strtotime($stockInfo['delivery_date'])) : '~' }}</td>
                </tr>
                {{-- Current Stock Level - Real-time calculation --}}
                <tr>
                    <td><strong>Aantal op voorraad</strong></td>
                    <td>{{ $stockInfo['current_stock'] ?? '~' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Action Buttons Section --}}
    {{-- Navigation and action options for users --}}
    <div class="row">
        <div class="col-12 d-flex gap-2">
            {{-- Edit Button - Navigate to edit form --}}
            {{-- Allows authorized users to modify product stock information --}}
            <a href="{{ route('stocks.product.edit', $product->id ?? 1) }}" class="btn btn-primary">Wijzig</a>
            {{-- Back Button - Return to previous page using browser history --}}
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Terug</button>
            {{-- Home Button - Quick navigation to main dashboard --}}
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
        </div>
    </div>
</div>
@endsection
