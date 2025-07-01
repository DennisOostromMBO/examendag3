{{-- filepath: c:\Users\denni\Herd\examendag3\resources\views\suppliers\edit.blade.php --}}
@extends('layouts.main')

@section('title', 'Wijzig houdbaarheidsdatum')

@section('content')
{{-- Navbar bovenaan --}}
<div class="w-full bg-gray-100 py-4 mb-8">
</div>
<div class="max-w-lg mx-auto mt-2 bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-green-700 underline mb-4">Wijzig houdbaarheidsdatum</h2>
    @if(session('success'))
        <div id="success-message" class="mb-4 p-3 bg-green-100 text-green-800 rounded text-center font-semibold">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('suppliers.products', $supplierId) }}";
            }, 2000);
        </script>
    @endif
    @if(session('error'))
        <div id="error-message" class="mb-4 p-3 bg-red-100 text-red-800 rounded text-center font-semibold">
            De houdbaarheidsdatum is niet gewijzigd.
        </div>
    @endif
    <form method="POST" action="{{ route('products.update_expiration', $product->id) }}">
        @csrf
        <input type="hidden" name="supplier_id" value="{{ $supplierId }}">
        <div class="mb-4">
            <label class="block font-semibold mb-2" for="expiration_date">Houdbaarheidsdatum:</label>
            <input type="date" id="expiration_date" name="expiration_date"
                   value="{{ old('expiration_date', $product->expiration_date ? \Carbon\Carbon::parse($product->expiration_date)->format('Y-m-d') : '') }}"
                   class="border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('expiration_date')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            @if(session('error'))
                <div class="mt-1 text-red-600 text-xs font-semibold">
                    De houdbaarheidsdatum mag met maximaal 7 dagen<br>worden verlengd
                </div>
            @endif
        </div>
        <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition mb-4">
            Wijzig Houdbaarheidsdatum
        </button>
        <div class="flex justify-end gap-2 mt-2">
            <a href="{{ route('suppliers.products', $supplierId) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Terug</a>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Home</a>
         </div>
    </form>
</div>
@endsection