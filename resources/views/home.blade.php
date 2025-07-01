@extends('layouts.main')

@section('title', 'Homepage - Voedselbank Maaskantje')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-green-600 to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Welkom bij<br>
                <span class="text-green-200">Voedselbank Maaskantje</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-green-100 max-w-3xl mx-auto">
                Samen zorgen we ervoor dat geen enkele maaltijd verloren gaat en iedereen toegang heeft tot gezonde voeding.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('stocks.overview') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                    Bekijk Voorraad
                </a>
                <a href="#info" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-700 transition-colors">
                    Meer Informatie
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">1.250+</div>
                <div class="text-gray-600">Geholpen gezinnen</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">15.000kg</div>
                <div class="text-gray-600">Voedsel gered</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">50+</div>
                <div class="text-gray-600">Vrijwilligers</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">24/7</div>
                <div class="text-gray-600">Toegankelijk systeem</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="info" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Onze Diensten</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Voedselbank Maaskantje biedt verschillende diensten om voedselverspilling tegen te gaan en mensen in nood te helpen.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Voedsel Verdeling</h3>
                <p class="text-gray-600">
                    Wij verdelen dagelijks verse en haltbare producten onder gezinnen die ondersteuning nodig hebben.
                </p>
                <a href="{{ route('stocks.overview') }}" class="inline-flex items-center mt-4 text-green-600 hover:text-green-700 font-medium">
                    Bekijk voorraad
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Service 2 -->
            <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Vrijwilligerswerk</h3>
                <p class="text-gray-600">
                    Samen met onze vrijwilligers sorteren en verdelen we voedsel en bieden we persoonlijke ondersteuning.
                </p>
                <a href="#" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700 font-medium">
                    Word vrijwilliger
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Service 3 -->
            <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Educatie & Bewustwording</h3>
                <p class="text-gray-600">
                    We educeren de gemeenschap over duurzaamheid en het verminderen van voedselverspilling.
                </p>
                <a href="#" class="inline-flex items-center mt-4 text-purple-600 hover:text-purple-700 font-medium">
                    Lees meer
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Actions Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Snelle Acties</h2>
            <p class="text-lg text-gray-600">Veelgebruikte functies voor medewerkers en vrijwilligers</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('stocks.overview') }}" class="group bg-green-50 hover:bg-green-100 p-6 rounded-lg transition-colors">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-green-700 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Voorraad Bekijken</h3>
                    <p class="text-sm text-gray-600">Overzicht van alle beschikbare producten</p>
                </div>
            </a>

            <div class="group bg-blue-50 hover:bg-blue-100 p-6 rounded-lg transition-colors cursor-pointer">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Klanten Beheren</h3>
                    <p class="text-sm text-gray-600">Klantgegevens en allergieën bijhouden</p>
                </div>
            </div>

            <div class="group bg-purple-50 hover:bg-purple-100 p-6 rounded-lg transition-colors cursor-pointer">
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-700 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Leveranciers</h3>
                    <p class="text-sm text-gray-600">Beheer leveranciers en bestellingen</p>
                </div>
            </div>

            <div class="group bg-orange-50 hover:bg-orange-100 p-6 rounded-lg transition-colors cursor-pointer">
                <div class="text-center">
                    <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-700 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Voedselpakketten</h3>
                    <p class="text-sm text-gray-600">Samenstellen en uitdelen van pakketten</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement -->
<section class="py-16 bg-green-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-6">Onze Missie</h2>
        <p class="text-xl leading-relaxed text-green-100">
            "Bij Voedselbank Maaskantje geloven we dat iedereen recht heeft op gezonde voeding.
            Wij zetten ons in om voedselverspilling te verminderen door overtollige producten
            te verzamelen en te verdelen onder mensen die ondersteuning nodig hebben.
            Samen bouwen we aan een duurzamere en solidaire gemeenschap."
        </p>
    </div>
</section>
@endsection
