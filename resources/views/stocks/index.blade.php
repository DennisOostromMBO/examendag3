{{--
/**
 * Stock Index View (Overzicht Productvoorraden)
 *
 * Main dashboard for viewing and managing product stock/inventory.
 * This view provides a comprehensive overview of all products in stock
 * with filtering capabilities and direct links to detailed views.
 *
 * Features:
 * - Category-based filtering dropdown
 * - Responsive data table with product information
 * - Direct links to product detail pages
 * - Empty state handling with warning messages
 * - Navigation buttons for easy workflow
 *
 * Data Sources:
 * - $stocks: Array of stock records from ProductStockService
 * - $categories: Available product categories for filtering
 * - $categoryFilter: Currently selected category filter
 *
 * User Permissions: No authentication required (public view)
 *
 * Navigation Paths:
 * - From: Main menu, product management workflows
 * - To: Product details, edit forms, home dashboard
 *
 * @extends layouts.main
 * @author Voedselbank Maaskantje Development Team
 * @version 1.0
 */
--}}

@extends('layouts.main')

@section('title', 'Overzicht Productvoorraden - Voedselbank Maaskantje')

@section('content')
<div class="container mt-4">
    {{-- Page Header Section --}}
    {{-- Contains the main title and category filter form --}}
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- Main page title with green styling to match Voedselbank branding --}}
            <h2 class="text-success">Overzicht Productvoorraden</h2>
        </div>
        <div class="col-md-4 text-end">
            {{-- Category Filter Form --}}
            {{-- Allows users to filter stock by product category --}}
            {{-- Submits GET request to maintain URL state for bookmarking/sharing --}}
            <form method="GET" action="{{ route('stocks.overview') }}" class="d-flex align-items-center justify-content-end gap-2">
                {{-- Category Selection Dropdown --}}
                {{-- Pre-selects current filter value to maintain state --}}
                <select name="category" id="category" class="form-select" style="max-width: 200px;">
                    {{-- Default "All Categories" option --}}
                    <option value="all" {{ !$categoryFilter || $categoryFilter === 'all' ? 'selected' : '' }}>
                        Selecteer Categorie
                    </option>
                    {{-- Dynamic category options from database --}}
                    {{-- Loop through available categories with selection state --}}
                    @foreach($categories as $categoryName => $categoryId)
                        <option value="{{ $categoryName }}" {{ $categoryFilter === $categoryName ? 'selected' : '' }}>
                            {{ $categoryName }}
                        </option>
                    @endforeach
                </select>
                {{-- Filter submit button --}}
                <button type="submit" class="btn btn-secondary">Toon Voorraad</button>
            </form>
        </div>
    </div>

    {{-- Stock Data Table Section --}}
    {{-- Displays stock information if data is available --}}
    {{-- Conditional rendering based on stock availability --}}
    @if(count($stocks) > 0)
        {{-- Responsive table wrapper for mobile compatibility --}}
        <div class="table-responsive">
            {{-- Main stock data table --}}
            {{-- Bootstrap styled table with borders for clear data separation --}}
            <table class="table table-bordered">
                {{-- Table header with light background --}}
                <thead class="table-light">
                    <tr>
                        {{-- Column headers in Dutch for Voedselbank users --}}
                        {{-- Each column represents key stock information --}}
                        <th>Productnaam</th>              {{-- Product name --}}
                        <th>Categorie</th>                {{-- Product category --}}
                        <th>Eenheid</th>                  {{-- Package unit (piece, box, kg) --}}
                        <th>Aantal</th>                   {{-- Quantity in stock --}}
                        <th>Houdbaarheidsdatum</th>       {{-- Expiry date --}}
                        <th>Magazijn</th>                 {{-- Warehouse/supplier info --}}
                        <th>Voorraad Details</th>         {{-- Link to detailed view --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop through each stock item --}}
                    {{-- Each row represents one stock entry with all relevant info --}}
                    @foreach($stocks as $stock)
                        <tr>
                            {{-- Product name with link to detailed view --}}
                            {{-- Clicking name navigates to product details page --}}
                            <td>
                                <a href="{{ route('stocks.product.show', $stock['product_id']) }}" class="text-decoration-none">
                                    {{ $stock['item_name'] ?? '~' }}
                                </a>
                            </td>
                            {{-- Product category --}}
                            {{-- Shows tilde (~) if no category data available --}}
                            <td>{{ $stock['category'] ?? '~' }}</td>
                            {{-- Package unit type --}}
                            <td>{{ $stock['unit'] ?? '~' }}</td>
                            {{-- Quantity in stock --}}
                            <td>{{ $stock['quantity'] ?? '~' }}</td>
                            {{-- Expiry date for food safety tracking --}}
                            <td>{{ $stock['expiry_date'] ?? '~' }}</td>
                            {{-- Warehouse or supplier information --}}
                            <td>{{ $stock['supplier'] ?? '~' }}</td>
                            {{-- Action column with emoji icon for details --}}
                            {{-- Quick access to detailed product view --}}
                            <td class="text-center">
                                <a href="{{ route('stocks.product.show', $stock['product_id']) }}" class="text-decoration-none">📋</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        {{-- Empty State Section --}}
        {{-- Displayed when no stock data is available --}}
        {{-- Shows user-friendly warning message in Dutch --}}
        <div class="text-center py-5">
            {{-- Yellow warning alert with consistent styling --}}
            {{-- Icon and message provide clear feedback to users --}}
            <div class="alert alert-warning d-inline-block">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Er zijn geen producten bekend die behoren bij de geselecteerde categorieen
            </div>
        </div>
    @endif

    {{-- Pagination Section --}}
    {{-- Custom pagination controls for stock data --}}
    @if(count($stocks) > 0 && isset($pagination) && $pagination['last_page'] > 1)
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Stock pagination">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if($pagination['current_page'] > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1]) }}">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Vorige</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @endif

                        {{-- Page Number Links --}}
                        @for($page = 1; $page <= $pagination['last_page']; $page++)
                            @if($page == $pagination['current_page'])
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $page]) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if($pagination['current_page'] < $pagination['last_page'])
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1]) }}">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Volgende</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>

                {{-- Pagination Info --}}
                <div class="text-center text-muted mt-2">
                    Toont {{ $pagination['from'] }} tot {{ $pagination['to'] }} van {{ $pagination['total'] }} resultaten
                </div>
            </div>
        </div>
    @endif

    {{-- Navigation Actions Section --}}
    {{-- Provides quick navigation options for users --}}
    <div class="row mt-4">
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
            {{-- Home button for quick return to main dashboard --}}
            <a href="{{ route('home') }}" class="btn btn-primary">home</a>
        </div>
    </div>
</div>
@endsection
