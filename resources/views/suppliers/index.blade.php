{{-- filepath: c:\Users\denni\Herd\examendag3\resources\views\suppliers\index.blade.php --}}
@extends('layouts.main')

@section('title', 'Leveranciers - Voedselbank Maaskantje')

@section('content')
{{-- Navbar bovenaan --}}
<div class="w-full bg-gray-100 py-4 mb-8"></div>
<div class="max-w-screen-xl mx-auto mt-2">
    <form method="get" action="{{ route('suppliers.index') }}">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-green-700 underline mb-1">Overzicht Leveranciers</h2>
                <p class="text-gray-500 text-sm">
                    <a href="{{ route('home') }}" class="hover:underline">Homepage voedselbank maaskantje</a>
                </p>
            </div>
            <div class="flex items-center gap-2 mt-4 md:mt-0">
                <select name="supplier_type" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 min-w-[220px]">
                    <option value="">Selecteer Leveranciertype</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @if($selectedType == $type) selected @endif>{{ $type }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition min-w-[180px]">Toon Leveranciers</button>
            </div>
        </div>
    </form>
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
                        <td class="px-4 py-2 truncate">{{ $supplier['name'] ?? '' }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier['contact_person'] ?? '' }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier['email'] ?? '' }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier['mobile'] ?? '' }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier['supplier_number'] ?? '' }}</td>
                        <td class="px-4 py-2 truncate">{{ $supplier['supplier_type'] ?? '' }}</td>
                        <td class="px-4 py-2 text-center">
                            @if(isset($supplier['id']))
                                <a href="{{ route('suppliers.products', $supplier['id']) }}" class="text-green-700 hover:text-green-900 transition" title="Product details">
                                    {{-- Gebruik een "eye" icoon voor zichtbaarheid --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-9 9s-9-4-9-9 7-9 9-9 9 4 9 9z" />
                                    </svg>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center bg-yellow-100 text-yellow-800 rounded">
                            Er zijn geen leveranciers bekend van het geselecteerde leverancierstype
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-4">
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Home</a>
    </div>
</div>
@endsection