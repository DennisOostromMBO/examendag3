{{-- filepath: c:\Users\denni\Herd\examendag3\resources\views\suppliers\products.blade.php --}}
@extends('layouts.main')

@section('title', 'Overzicht producten leverancier')

@section('content')
{{-- Navbar bovenaan --}}
<div class="w-full bg-gray-100 py-4 mb-8">
</div>
<div class="max-w-screen-lg mx-auto mt-2">
    <h2 class="text-xl font-bold text-green-700 underline mb-4">
        Overzicht producten
    </h2>
    <div class="mb-6">
        <table class="min-w-[400px] border border-gray-300">
            <tr>
                <td class="border px-4 py-2 font-semibold">Naam:</td>
                <td class="border px-4 py-2">{{ $supplier->name ?? '~~~' }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Leveranciernummer:</td>
                <td class="border px-4 py-2">{{ $supplier->supplier_number ?? '~~~' }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Leveranciertype:</td>
                <td class="border px-4 py-2">{{ $supplier->supplier_type ?? '~~~' }}</td>
            </tr>
        </table>
    </div>
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">Naam</th>
                    <th class="px-4 py-2 text-left font-semibold">Soort Allergie</th>
                    <th class="px-4 py-2 text-left font-semibold">Barcode</th>
                    <th class="px-4 py-2 text-left font-semibold">Houdbaarheidsdatum</th>
                    <th class="px-4 py-2 text-center font-semibold">Wijzig Product</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="px-4 py-2">{{ $product->name ?? '~~~' }}</td>
                        <td class="px-4 py-2">{{ $product->allergy_type ?? '~~~' }}</td>
                        <td class="px-4 py-2">{{ $product->barcode ?? '~~~' }}</td>
                        <td class="px-4 py-2">{{ $product->expiration_date ?? '~~~' }}</td>
                       <td class="px-4 py-2 text-center">
    <a href="{{ route('products.edit', ['product' => $product->id, 'supplier_id' => $supplier->id]) }}" class="text-blue-600 hover:text-blue-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h6m2 2a2 2 0 11-4 0 2 2 0 014 0zm-2-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h6a2 2 0 002-2z" />
        </svg>
    </a>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Geen producten gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-end gap-2 mt-4">
         <a href="{{ route('suppliers.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">terug</a>
    </div>
</div>
@endsection