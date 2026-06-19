@extends('layouts.app-public')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Hero Content -->
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Trouvez votre Bien Immobilier Idéal
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Découvrez nos propriétés disponibles à la vente et la location au Burkina Faso
                </p>
            </div>

            <!-- Search Bar - EF-B1 -->
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <!-- Filter Tabs -->
                <div class="flex gap-4 mb-6 border-b">
                    <button class="search-tab active pb-3 font-semibold text-blue-600 border-b-2 border-blue-600" data-option="vente">
                        À Vendre
                    </button>
                    <button class="search-tab pb-3 font-semibold text-gray-600 hover:text-blue-600" data-option="location">
                        À Louer
                    </button>
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('home') }}" class="space-y-4">
                    <input type="hidden" name="option" id="searchOption" value="vente">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Location Search - EF-B1 -->
                        <div>
                            <input type="text" name="location" placeholder="Zone géographique" 
                                   value="{{ request('location') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Type - EF-B1 -->
                        <div>
                            <select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Type de propriété --</option>
                                <option value="terrain">Terrain</option>
                                <option value="batiment">Bâtiment</option>
                                <option value="appartement">Appartement</option>
                                <option value="villa">Villa</option>
                                <option value="commerce">Commerce</option>
                            </select>
                        </div>

                        <!-- Usage - EF-B1 -->
                        <div>
                            <select name="usage" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Usage --</option>
                                <option value="residence">Résidence</option>
                                <option value="bureau">Bureau</option>
                                <option value="commerce">Commerce</option>
                                <option value="agriculture">Agriculture</option>
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <select name="price_range" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Prix Maximum</option>
                                <option value="10000000">Jusqu'à 10M</option>
                                <option value="50000000">Jusqu'à 50M</option>
                                <option value="100000000">Jusqu'à 100M</option>
                                <option value="500000000">Jusqu'à 500M</option>
                                <option value="999999999">Tout Prix</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-lg">
                        Rechercher
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Properties Grid - EF-E1 -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold mb-8">Propriétés Disponibles</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @forelse($properties as $property)
                @include('components.property-card')
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucune propriété trouvée. Modifiez vos critères de recherche.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($properties->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $properties->links() }}
            </div>
        @endif
    </section>

    <!-- Featured Properties Section - EF-E1 -->
    <section class="bg-gray-50 py-16 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8">Dernières Annonces Publiées</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $latestProperties = \App\Models\Property::where('status', 'publiee')->latest()->limit(3)->get();
                @endphp
                @forelse($latestProperties as $property)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                        @if ($property->photos && $property->photos->first())
                            <img src="{{ asset('storage/' . $property->photos->first()->photo_url) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $property->title }}</h3>
                            <p class="text-blue-600 font-bold text-xl mb-2">${{ number_format($property->price, 0) }}</p>
                            <p class="text-sm text-gray-600 mb-4">{{ $property->location }}</p>
                            <a href="{{ route('property.show', $property) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                Voir Détails
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Aucune propriété récente</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Vous êtes Propriétaire?
                </h2>
                <p class="text-xl text-blue-100 mb-6">
                    Publiez votre bien immobilier et trouvez les meilleurs clients
                </p>
                @auth
                    <a href="{{ route('bailleur.dashboard') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-semibold">
                        Déposer une Annonce
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-semibold">
                        S'inscrire comme Bailleur
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <script>
        // Search tab switching
        document.querySelectorAll('.search-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.search-tab').forEach(t => {
                    t.classList.remove('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
                    t.classList.add('text-gray-600');
                });
                this.classList.add('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
                this.classList.remove('text-gray-600');
                document.getElementById('searchOption').value = this.dataset.option;
            });
        });
    </script>
@endsection