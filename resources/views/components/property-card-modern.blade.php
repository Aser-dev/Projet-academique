<!-- 🏡 Modern Property Card Component (PRO MAX) -->
<div class="group overflow-hidden rounded-2xl bg-white border border-gray-200 hover:border-blue-400 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
    <!-- Image Container -->
    <div class="relative overflow-hidden h-72 bg-gradient-to-br from-gray-200 to-gray-300">
        @if ($property->photos && $property->photos->first())
            <img
                src="{{ $property->photos->first()->url }}"
                alt="{{ $property->title }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                loading="lazy"
            >
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif

        <!-- Status Badge -->
        <div class="absolute top-4 left-4">
            @if (($property->status ?? null) === 'publiee')
                <span class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    Disponible
                </span>
            @elseif (($property->status ?? null) === 'en_attente')
                <span class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                    <span class="w-2 h-2 bg-white"></span>
                    En attente
                </span>
            @else
                <span class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-600 to-slate-700 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                    <span class="w-2 h-2 bg-white/90 rounded-full"></span>
                    {{ ucfirst($property->status ?? '—') }}
                </span>
            @endif
        </div>

        <!-- Favorite Button -->
        <div class="absolute top-4 right-4">
            @auth
                @if(auth()->user()->role === 'client')
                    <button
                        type="button"
                        onclick="toggleFavorite({{ $property->id }})"
                        class="favorite-btn-{{ $property->id }} bg-white/95 backdrop-blur-sm rounded-full p-2.5 shadow-lg hover:bg-white hover:shadow-xl transition-all duration-300 hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400"
                        aria-label="Ajouter aux favoris"
                    >
                        <svg class="w-6 h-6 text-gray-400 transition-colors group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                @else
                    <span class="inline-flex items-center justify-center w-11 h-11 bg-white/95 backdrop-blur-sm rounded-full shadow-lg" aria-hidden="true">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </span>
                @endif
            @else
                <a
                    href="{{ route('login') }}"
                    class="bg-white/95 backdrop-blur-sm rounded-full p-2.5 shadow-lg hover:bg-white hover:shadow-xl transition-all duration-300 hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 inline-flex items-center justify-center"
                    aria-label="Connexion pour ajouter aux favoris"
                >
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </a>
            @endauth
        </div>

        <!-- Type Badge -->
        <div class="absolute bottom-4 left-4">
            <span class="inline-block px-3 py-1 rounded-lg text-xs font-bold text-white bg-black/40 backdrop-blur-sm shadow-sm">
                {{ ucfirst($property->type ?? '—') }}
            </span>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-6">
        <!-- Title -->
        <h3 class="font-bold text-xl text-gray-900 mb-2 transition group-hover:text-blue-600 line-clamp-2">
            {{ $property->title }}
        </h3>

        <!-- Location -->
        <div class="flex items-start gap-2 mb-4">
            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm text-gray-600 line-clamp-1">{{ $property->location ?? '—' }}</p>
        </div>

        <div class="border-b border-gray-200 mb-4"></div>

        <!-- Price Section -->
        <div class="mb-5">
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Prix</p>
            <p class="text-3xl font-black bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                {{ number_format($property->price ?? 0, 0, ',', ' ') }}
                <span class="text-xs text-gray-600">FCFA</span>
            </p>
        </div>

        <!-- Property Features -->
        <div class="grid grid-cols-3 gap-3 mb-6 p-3 bg-gray-50 rounded-xl border border-gray-100">
            <div class="text-center">
                <div class="flex items-center justify-center w-8 h-8 mx-auto mb-1 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V9.5m-8-8v4m0-4L16 7"/>
                    </svg>
                </div>
                <p class="text-lg font-bold text-gray-900">{{ $property->bedrooms ?? '-' }}</p>
                <p class="text-xs text-gray-600">Chambres</p>
            </div>

            <div class="text-center">
                <div class="flex items-center justify-center w-8 h-8 mx-auto mb-1 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M4.5 4a1.5 1.5 0 110 3 1.5 1.5 0 010-3M4.5 10a1.5 1.5 0 110 3 1.5 1.5 0 010-3M10 4a1.5 1.5 0 110 3 1.5 1.5 0 010-3"/>
                    </svg>
                </div>
                <p class="text-lg font-bold text-gray-900">{{ $property->bathrooms ?? '-' }}</p>
                <p class="text-xs text-gray-600">Salles d'eau</p>
            </div>

            <div class="text-center">
                <div class="flex items-center justify-center w-8 h-8 mx-auto mb-1 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-lg font-bold text-gray-900">{{ $property->surface ?? '-' }}</p>
                <p class="text-xs text-gray-600">m²</p>
            </div>
        </div>

        <!-- Usage Tag -->
        <div class="mb-5">
            <span class="inline-block px-2.5 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                {{ ucfirst(str_replace('_', ' ', $property->usage ?? 'Non spécifié')) }}
            </span>
        </div>

        <!-- CTA Button -->
        <a
            href="{{ route('property.show', $property) }}"
            class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/50 transition font-semibold gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400"
        >
            <span>Voir Détails</span>
            <svg class="w-4 h-4 transition-transform" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
