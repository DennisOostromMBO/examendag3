<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Voedselbank Maaskantje')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-lg">VB</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h1 class="text-xl font-semibold text-gray-900">Voedselbank Maaskantje</h1>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('stocks.overview') }}" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('stocks.*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                        Voorraad
                    </a>
                    <a href="{{ route('allergies.index') }}" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('allergies.*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                        Allergieën
                    </a>
                    <a href="{{ route('food-packages.index') }}" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('food-packages.*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                        Voedselpakketten
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('suppliers.*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                        Leveranciers
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden hidden pb-3">
                <div class="space-y-1">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-green-600 {{ request()->routeIs('home') ? 'text-green-600' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('stocks.overview') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-green-600 {{ request()->routeIs('stocks.*') ? 'text-green-600' : '' }}">
                        Voorraad
                    </a>
                    <a href="{{ route('allergies.index') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-green-600 {{ request()->routeIs('allergies.*') ? 'text-green-600' : '' }}">
                        Allergieën
                    </a>
                    <a href="{{ route('food-packages.index') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-green-600 {{ request()->routeIs('food-packages.*') ? 'text-green-600' : '' }}">
                        Voedselpakketten
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-green-600 {{ request()->routeIs('suppliers.*') ? 'text-green-600' : '' }}">
                        Leveranciers
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    © {{ date('Y') }} Voedselbank Maaskantje. Samen tegen voedselverspilling.
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
