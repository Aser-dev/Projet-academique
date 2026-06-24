@extends('layouts.app-public')

@section('content')
    <!-- 🎨 HERO SECTION - Premium Modern Design -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen flex items-center">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-purple-500 rounded-full opacity-20 blur-3xl"></div>
        </div>

        <div class="relative z-10 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <!-- Hero Content -->
                <div class="max-w-3xl mx-auto text-center mb-12">
                    <div class="inline-block mb-6">
                        <span class="px-4 py-2 rounded-full bg-blue-500/20 text-blue-300 text-sm font-semibold backdrop-blur-sm border border-blue-500/30">✨ Trouvez votre propriété idéale</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-6 leading-tight">
                        Votre Futur
                        <span class="bg-gradient-to-r from-blue-400 via-blue-300 to-cyan-300 bg-clip-text text-transparent">Immobilier</span>
                        <br>
                        Commence Ici
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed">
                        Explorez les meilleures propriétés au Burkina Faso. Vente, location, investissement — tout en un endroit
                    </p>
                </div>

                <!-- 🔍 Modern Search Bar -->
                <div class="max-w-5xl mx-auto">
                    <!-- Filter Tabs - Modern Style -->
                    <div class="flex gap-3 mb-8 justify-center">
                        <button class="search-tab active px-6 py-2 font-semibold text-gray-900 bg-white rounded-full transition hover:shadow-lg" data-option="vente">
                            <span class="inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                À Vendre
                            </span>
                        </button>
                        <button class="search-tab px-6 py-2 font-semibold text-gray-400 hover:text-white transition" data-option="location">
                            <span class="inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/></svg>
                                À Louer
                            </span>
                        </button>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('home') }}" class="space-y-4">
                        <input type="hidden" name="option" id="searchOption" value="vente">
                        
                        <!-- Search Grid -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 md:p-8 border border-white/20 shadow-2xl">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                                <!-- Location Search -->
                                <div class="lg:col-span-2">
                                    <input type="text" name="location" placeholder="Localisation..." 
                                           value="{{ request('location') }}"
                                           class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 placeholder-gray-500 border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
                                </div>

                                <!-- Type -->
                                <div>
                                    <select name="type" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                                        <option value="">Type</option>
                                        <option value="terrain">Terrain</option>
                                        <option value="batiment">Bâtiment</option>
                                        <option value="appartement">Appartement</option>
                                        <option value="villa">Villa</option>
                                        <option value="commerce">Commerce</option>
                                    </select>
                                </div>

                                <!-- Usage -->
                                <div>
                                    <select name="usage" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                                        <option value="">Usage</option>
                                        <option value="residence">Résidence</option>
                                        <option value="bureau">Bureau</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="agriculture">Agriculture</option>
                                    </select>
                                </div>

                                <!-- Price Range -->
                                <div>
                                    <select name="price_range" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                                        <option value="">Prix Max</option>
                                        <option value="10000000">Jusqu'à 10M</option>
                                        <option value="50000000">Jusqu'à 50M</option>
                                        <option value="100000000">Jusqu'à 100M</option>
                                        <option value="500000000">Jusqu'à 500M</option>
                                        <option value="999999999">Tout Prix</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="mt-4">
                                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:shadow-xl hover:shadow-blue-500/50 transition font-bold text-lg flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                                    Rechercher les Propriétés
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- 📍 PROPERTIES GRID - Modern Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <!-- Section Header -->
        <div class="mb-12">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Découvrez nos Propriétés</span>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">
                Trouvez Votre Propriété
                <span class="text-transparent bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text">Idéale</span>
            </h2>
            <p class="text-gray-600 text-lg mt-4 max-w-2xl">Sélection exclusive de biens immobiliers triés sur le volet pour répondre à vos besoins</p>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($properties as $property)
                @include('components.property-card-modern')
            @empty
                <div class="col-span-full">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300 p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 008.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune propriété trouvée</h3>
                        <p class="text-gray-600">Modifiez vos critères de recherche pour voir les résultats</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination - Modern Style -->
        @if($properties->hasPages())
            <div class="mt-16 flex justify-center">
                <div class="flex items-center gap-2">
                    {{ $properties->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </section>

    <!-- ⭐ FEATURED PROPERTIES - Premium Showcase -->
    <section class="relative bg-gradient-to-b from-white to-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-12">
                <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Exclusivités</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">
                    Dernières
                    <span class="text-transparent bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text">Annonces</span>
                </h2>
                <p class="text-gray-600 text-lg mt-4">Les propriétés les plus récemment publiées de notre plateforme</p>
            </div>

            <!-- Featured Cards Grid (utilise le composant moderne) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $latestProperties = \App\Models\Property::where('status', 'publiee')->latest()->limit(3)->get();
                @endphp
                @forelse($latestProperties as $property)
                    @include('components.property-card-modern')
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 text-lg">Aucune propriété récente disponible</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 💼 CTA SECTION - Call to Action Premium -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-20">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-0 w-96 h-96 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full opacity-20 blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Eyebrow -->
            <span class="inline-block px-4 py-2 rounded-full bg-blue-500/20 text-blue-300 text-sm font-semibold backdrop-blur-sm border border-blue-500/30 mb-6">
                🎯 Rejoignez Notre Plateforme
            </span>

            <!-- Main Headline -->
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
                Vous Êtes
                <span class="bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-300 bg-clip-text text-transparent">Propriétaire?</span>
            </h2>

            <!-- Description -->
            <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed max-w-2xl mx-auto">
                Publiez votre bien immobilier en quelques minutes et connectez-vous avec des acheteurs et locataires sérieux
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('bailleur.dashboard') }}" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:shadow-2xl hover:shadow-blue-500/50 transition font-bold text-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V9.5M10.5 1.5v4m0-4L16 7m-5.5-5.5h4m-4 9.5h6"/></svg>
                        Déposer une Annonce
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:shadow-2xl hover:shadow-blue-500/50 transition font-bold text-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                        S'inscrire comme Bailleur
                    </a>
                @endauth

                <a href="{{ route('home') }}" class="px-8 py-4 bg-white/10 text-white border border-white/30 rounded-xl hover:bg-white/20 transition font-bold text-lg backdrop-blur-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Continuer la Recherche
                </a>
            </div>

            <!-- Trust indicators -->
            <div class="mt-12 pt-12 border-t border-white/20">
                <p class="text-gray-400 text-sm mb-6">Rejoignez des milliers d'utilisateurs satisfaits</p>
                <div class="flex justify-center items-center gap-8 flex-wrap">
                    <div class="text-center">
                        <p class="text-3xl font-black text-white">2.5K+</p>
                        <p class="text-sm text-gray-400">Propriétés</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-white">5K+</p>
                        <p class="text-sm text-gray-400">Utilisateurs</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-white">98%</p>
                        <p class="text-sm text-gray-400">Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script for Search Tabs -->
    <script>
        // Search tab switching with smooth animation
        document.querySelectorAll('.search-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active state from all tabs
                document.querySelectorAll('.search-tab').forEach(t => {
                    t.classList.remove('bg-white', 'text-gray-900', 'shadow-lg');
                    t.classList.add('text-gray-400');
                });
                
                // Add active state to clicked tab
                this.classList.add('bg-white', 'text-gray-900', 'shadow-lg');
                this.classList.remove('text-gray-400');
                
                // Update hidden input
                document.getElementById('searchOption').value = this.dataset.option;
            });
        });

        // Favorite toggle function
        function toggleFavorite(propertyId) {
            const btn = document.querySelector(`.favorite-btn-${propertyId}`);
            if (!btn) return;

            fetch(`/property/${propertyId}/toggle-favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const svg = btn.querySelector('svg');
                    if (data.is_favorite) {
                        svg.classList.remove('text-gray-400');
                        svg.classList.add('text-red-500', 'animate-bounce');
                    } else {
                        svg.classList.remove('text-red-500', 'animate-bounce');
                        svg.classList.add('text-gray-400');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection