{{-- filepath: c:\Users\denni\Herd\examendag3\resources\views\suppliers\index.blade.php --}}
@extends('layouts.main')

@section('title', 'Leveranciers - Voedselbank Maaskantje')

@section('content')
<div class="max-w-screen-xl mx-auto mt-8">
    {{-- Navbar bovenaan --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Home</a>
    </div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-green-700 underline mb-1">Overzicht Leveranciers</h2>
            <p class="text-gray-500 text-sm">
                <a href="{{ route('home') }}" class="hover:underline">Homepage voedselbank maaskantje</a>
            </p>
        </div>
        <div class="flex items-center gap-2 mt-4 md:mt-0">
            <select class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 min-w-[220px]">
                <option selected>Selecteer Leveranciertype</option>
                {{-- Opties dynamisch toevoegen indien nodig --}}
            </select>
            <button type="button" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition min-w-[180px]">Toon Leveranciers</button>
        </div>
    </div>
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200 table-fixed">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-48">Naam</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-48">Contactpersoon</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-64">Email</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-48">Mobiel</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-48">Leveranciersnummer</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-48">LeverancierType</th>
                    <th class="px-4 py-2 text-center font-semibold text-gray-700 w-32">Product Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($suppliers as $supplier)
                    <tr>
                        <td class="px-4 py-2 truncate">{{ $supplier->name }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier->contact_person }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier->email }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier->mobile }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier->supplier_number }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier->supplier_type }}</td>
                        <td class="px-4 py-2 text-center">
                            <button type="button" class="text-gray-600 hover:text-green-600 transition" title="Product details">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2v-6a2 2 0 00-2-2h-6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">Geen leveranciers gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection