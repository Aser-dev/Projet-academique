@extends('layouts.app')
@section('title', 'Annonces immobilières au Burkina')

@section('content')

<!-- ══════════════════════════════════════
     HERO SECTION
══════════════════════════════════════ -->
<section class="relative h-auto min-h-[600px] md:min-h-[520px] md:h-[580px]">
    <!-- Image de fond -->
    <div class="absolute inset-0 overflow-hidden">
        <img src="{{ asset('images/heroproperties.jpg') }}"
             alt="Immobilier" class="object-cover object-center w-full h-full">
        <div class="absolute inset-0" style="background:linear-gradient(to right, rgba(15,23,42,0.82) 0%, rgba(15,23,42,0.55) 55%, rgba(15,23,42,0.3) 100%)"></div>
    </div>

    <!-- Contenu Hero -->
    <div class="relative z-10 flex items-center h-full pt-24 pb-8">
        <div class="w-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl">
                <!-- Tag -->
                <div class="inline-flex items-center gap-2 mb-5 px-3 py-1.5 rounded-full text-xs font-semibold text-white"
                     style="background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); backdrop-filter:blur(8px)">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Plus de {{ $properties->total() }} annonces disponibles
                </div>

                <h1 class="mb-4 text-4xl font-extrabold leading-tight text-white md:text-5xl" style="letter-spacing:-0.02em">
                    Trouvez le bien<br>
                    <span style="background:linear-gradient(90deg,#60a5fa,#818cf8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text">
                        qui vous correspond
                    </span>
                </h1>
                <p class="mb-8 text-lg text-slate-300">
                    Villas, appartements, terrains — des annonces vérifiées partout au Burkina.
                </p>

<!-- Barre de recherche -->
                <form method="GET" action="{{ route('home') }}"

                      class="flex flex-col gap-2 p-2 bg-white shadow-2xl rounded-2xl sm:flex-row"
                      style="box-shadow:0 25px 60px rgba(0,0,0,0.4)">

                    <!-- Recherche texte -->
                    <div class="flex items-center gap-2 flex-1 px-4 py-2.5 bg-gray-50 rounded-xl">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Ville, quartier, titre..."
                               class="flex-1 text-sm text-gray-800 placeholder-gray-400 bg-transparent outline-none">
                    </div>

                    <!-- Type -->
                    <select name="type" class="px-4 py-2.5 bg-gray-50 rounded-xl text-sm text-gray-700 outline-none border-0 cursor-pointer sm:w-40">
                        <option value="">Tous les types</option>
                        <option value="villa" {{ request('type')=='villa'?'selected':'' }}>🏡 Villa</option>
                        <option value="appartement" {{ request('type')=='appartement'?'selected':'' }}>🏢 Appartement</option>
                        <option value="terrain" {{ request('type')=='terrain'?'selected':'' }}>📐 Terrain</option>
                        <option value="commerce" {{ request('type')=='commerce'?'selected':'' }}>🏪 Commerce</option>
                        <option value="batiment" {{ request('type')=='batiment'?'selected':'' }}>🏗 Bâtiment</option>
                    </select>

                    <!-- Transaction -->
                    <select name="option" class="px-4 py-2.5 bg-gray-50 rounded-xl text-sm text-gray-700 outline-none border-0 cursor-pointer sm:w-36">
                        <option value="">Vente & Location</option>
                        <option value="vente" {{ request('option')=='vente'?'selected':'' }}>Vente</option>
                        <option value="location" {{ request('option')=='location'?'selected':'' }}>Location</option>
                    </select>

                    <!-- Prix min -->
                    <input type="number"
                           name="price_min"
                           value="{{ request('price_min') }}"
                           placeholder="Prix min (FCFA)"
                           class="px-4 py-2.5 bg-gray-50 rounded-xl text-sm text-gray-700 outline-none border-0 sm:w-36"
                           min="0">

                    <!-- Prix max -->
                    <input type="number"
                           name="price_max"
                           value="{{ request('price_max') }}"
                           placeholder="Prix max (FCFA)"
                           class="px-4 py-2.5 bg-gray-50 rounded-xl text-sm text-gray-700 outline-none border-0 sm:w-36"
                           min="0">


                    <!-- Bouton -->
                    <button type="submit"
                            class="flex items-center justify-center gap-2 px-6 py-2.5 text-white text-sm font-bold rounded-xl whitespace-nowrap transition-all hover:-translate-y-0.5"
                            style="background:linear-gradient(135deg,#2563eb,#1e3a8a); box-shadow:0 4px 14px rgba(37,99,235,0.4)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Rechercher
                    </button>
                </form>

                <!-- Recherches rapides -->
                <div class="flex flex-wrap items-center gap-2 mt-4">
                    <span class="text-xs text-slate-400">Populaires :</span>
                    @foreach(['Ouagadougou','Bobo-Dioulasso','Koudougou','Banfora','Villa','Appartement'] as $tag)
                    <a href="{{ route('home') }}?search={{ urlencode($tag) }}"
                       class="px-3 py-1 text-xs font-medium text-white transition-all rounded-full hover:text-white"
                       style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.18); backdrop-filter:blur(4px)">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════
     STATS BAR
══════════════════════════════════════ -->
<section class="bg-white border-b border-gray-200 shadow-sm">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 divide-x divide-gray-200 md:grid-cols-4">
            @foreach([[$properties->total().' +','Annonces actives','text-blue-600'],['5','Villes couvertes','text-blue-600'],['100%','Annonces vérifiées','text-green-600'],['24/7','Support client','text-blue-600']] as [$v,$l,$c])
            <div class="flex items-center gap-4 px-8 py-5">
                <p class="text-2xl font-extrabold {{ $c }}">{{ $v }}</p>
                <p class="text-sm font-medium leading-tight text-gray-500">{{ $l }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════
     FILTRES CATÉGORIES
══════════════════════════════════════ -->
<section class="px-4 mx-auto mt-10 max-w-7xl sm:px-6 lg:px-8">
    <div class="flex items-center gap-3 pb-1 overflow-x-auto" style="scrollbar-width:none">
        @php
        $types = [
            [null,       'Tous',         'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['villa',    'Villas',       'M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z'],
            ['appartement','Appartements','M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['terrain',  'Terrains',     'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'],
            ['commerce', 'Commerces',    'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
            ['batiment', 'Bâtiments',    'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4'],
        ];
        @endphp
        @foreach($types as [$val, $label, $path])
        @php $active = request('type') === $val || (!request('type') && $val === null); @endphp
        <a href="{{ route('home') }}{{ $val ? '?type='.$val : '' }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold whitespace-nowrap transition-all flex-shrink-0 {{ $active ? 'text-white shadow-lg' : 'text-gray-600 bg-white border border-gray-200 hover:border-blue-400 hover:text-blue-700' }}"
           style="{{ $active ? 'background:linear-gradient(135deg,#2563eb,#1e3a8a); box-shadow:0 4px 14px rgba(37,99,235,0.35)' : '' }}">
            <svg class="flex-shrink-0 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $path }}"/>
            </svg>
            {{ $label }}
        </a>
        @endforeach
    </div>
</section>

<!-- SECTION PROMOTIONS -->
<section class="px-4 mx-auto mt-10 max-w-7xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <span class="text-xs font-extrabold tracking-widest text-blue-700 uppercase">
            À ne pas manquer
        </span>
        <h2 class="mt-1 text-2xl font-extrabold text-slate-900">
            Nos Recommandations
        </h2>
    </div>

    <!-- Carousel -->
    <div class="relative overflow-hidden">
        <div id="promo-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            @foreach($promotions as $promo)
            <div class="flex-shrink-0 overflow-hidden bg-white border border-gray-100 shadow-sm w-72 rounded-2xl">
                <div class="relative h-44 bg-slate-100">
                    @if($promo->photos->first())
                    <img src="{{ $promo->photos->first()->url }}" 
                         alt="{{ $promo->title }}"
                         class="object-cover w-full h-full">
                    @else
                    <div class="flex items-center justify-center w-full h-full text-gray-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                        </svg>
                    </div>
                    @endif
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-bold text-white
                        {{ $promo->option === 'vente' ? 'bg-blue-600' : 'bg-emerald-500' }}">
                        {{ strtoupper($promo->option) }}
                    </span>
                </div>
                <div class="p-4">
                    <p class="mb-1 text-xs font-bold text-blue-600 uppercase">{{ ucfirst($promo->type) }}</p>
                    <h3 class="mb-2 text-sm font-semibold text-gray-900 line-clamp-2">{{ $promo->title }}</h3>
                    <p class="text-base font-bold text-slate-900">
                        {{ number_format($promo->price, 0, ',', ' ') }}
                        <span class="text-xs font-normal text-gray-400">
                            FCFA{{ $promo->option === 'location' ? '/mois' : '' }}
                        </span>
                    </p>
                   
                </div>
            </div>
            @endforeach
        </div>

        <!-- Boutons navigation -->
        <button onclick="promoSlide(-1)"
                class="absolute left-0 flex items-center justify-center w-10 h-10 transition -translate-y-1/2 bg-white rounded-full shadow-lg top-1/2 hover:bg-gray-50">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button onclick="promoSlide(1)"
                class="absolute right-0 flex items-center justify-center w-10 h-10 transition -translate-y-1/2 bg-white rounded-full shadow-lg top-1/2 hover:bg-gray-50">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</section>

@push('scripts')
<script>
let promoIndex = 0;
function promoSlide(dir) {
    const track = document.getElementById('promo-track');
    const cards = track.children;
    const cardWidth = cards[0].offsetWidth + 16;
    const maxIndex = Math.max(0, cards.length - 3);
    promoIndex = Math.min(Math.max(promoIndex + dir, 0), maxIndex);
    track.style.transform = `translateX(-${promoIndex * cardWidth}px)`;
}
// Auto-scroll toutes les 4 secondes (dynamique uniquement côté UI)
function promoTick() {
    const track = document.getElementById('promo-track');
    if (!track) return;

    const cards = track.children;
    if (!cards || !cards.length) return;

    const maxIndex = Math.max(0, cards.length - 3);
    promoIndex = promoIndex >= maxIndex ? 0 : promoIndex + 1;

    // recalcul à chaque tick pour gérer les changements de layout/resize
    const first = cards[0];
    const cardWidth = first ? (first.offsetWidth + 16) : 0;

    track.style.transform = `translateX(-${promoIndex * cardWidth}px)`;
}

setInterval(promoTick, 4000);
</script>
@endpush

<!-- ══════════════════════════════════════
     GRILLE ANNONCES
══════════════════════════════════════ -->
<section class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

    @php
        $favoritePropertyIds = auth()->check() && auth()->user()->role === 'client'
            ? auth()->user()->favorites()->whereIn('property_id', $properties->pluck('id'))->pluck('property_id')->all()
            : [];
    @endphp

    <!-- En-tête section -->
    <div class="flex items-center justify-between mb-7">
        <div>
            <h2 class="text-xl font-bold text-gray-900">
                @if(request()->hasAny(['search','type','option']))
                    Résultats de recherche
                @else
                    Annonces récentes
                @endif
            </h2>
            <p class="text-sm text-gray-500 mt-0.5">
                <span class="font-semibold text-gray-700">{{ $properties->total() }}</span> bien(s) trouvé(s)
                @if(request('search'))— "<em>{{ request('search') }}</em>"@endif
            </p>
        </div>
        @if(request()->hasAny(['search','type','option']))
        <a href="{{ route('home') }}"
           class="flex items-center gap-1.5 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-medium transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Effacer les filtres
        </a>
        @endif
    </div>

    @if($properties->count() > 0)
    <!-- Grille -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($properties as $property)
        @php $isFavorited = in_array($property->id, $favoritePropertyIds); @endphp
        <article class="overflow-hidden bg-white border border-gray-100 card group rounded-2xl"
                 style="box-shadow:0 1px 6px rgba(0,0,0,0.07)">

            <!-- Image -->
            <div class="relative overflow-hidden h-[160px] sm:h-[190px] md:h-[200px]" style="background:#e2e8f0">
                <a href="{{ route('property.show', $property) }}" class="block w-full h-full">
                @if($property->photos->first())
                <img src="{{ $property->photos->first()->url }}"
                     alt="{{ $property->title }}"
                     class="object-cover w-full h-full card-img">
                @else
                <div class="flex flex-col items-center justify-center w-full h-full gap-2">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    </svg>
                    <p class="text-xs text-gray-400">Pas de photo</p>
                </div>
                @endif
                </a>

                <!-- Gradient overlay -->
                <div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 55%)"></div>

                <!-- Badge transaction -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide
                        {{ $property->option === 'vente' ? 'bg-blue-600 text-white' : 'bg-emerald-500 text-white' }}">
                        {{ strtoupper($property->option) }}
                    </span>
                </div>

                <!-- Actions image -->
                <div class="absolute flex items-center gap-2 top-3 right-3">
@php
$canFavorite = auth()->check() && auth()->user()->role === 'client';
                @endphp
                @if($canFavorite)
                    <button type="button"
                            data-favorite-property="{{ $property->id }}"
                            data-favorite-url="{{ route('favorite.toggle', $property) }}"
                            data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
                            data-favorite-property-id="{{ $property->id }}"
                            onclick="togglePropertyFavorite(event, this)"
                            aria-label="{{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
                            aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                            class="flex items-center justify-center transition rounded-full shadow-lg w-9 h-9 bg-white/95 hover:bg-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <svg class="w-5 h-5 {{ $isFavorited ? 'text-red-500' : 'text-gray-500' }}" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    @endif
                    <span class="flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-medium text-white"
                          style="background:rgba(0,0,0,0.35); backdrop-filter:blur(4px)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ $property->views_count }}
                    </span>
                </div>

                <!-- Prix -->
                <div class="absolute bottom-3 left-3 right-3">
                    <p class="text-lg font-bold leading-none text-white">
                        {{ number_format($property->price, 0, ',', ' ') }}
                        <span class="text-xs font-normal text-white/70">
                            FCFA{{ $property->option === 'location' ? '/mois' : '' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Contenu card -->
            <div class="p-4">
                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1">
                    {{ ucfirst($property->type) }}
                </p>
                <a href="{{ route('property.show', $property) }}" class="block">
                    <h3 class="mb-2 text-sm font-semibold leading-snug text-gray-900 transition-colors line-clamp-2 group-hover:text-blue-700" style="min-height:2.5rem">
                        {{ $property->title }}
                    </h3>
                </a>

                <!-- Localisation -->
                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-3">
                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="font-medium truncate">{{ $property->location }}</span>
                </div>

                <!-- Caractéristiques -->
                <div class="flex items-center gap-3 pt-3 text-xs text-gray-500 border-t border-gray-100">
                    @if($property->rooms)
                    <span class="flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        {{ $property->rooms }} ch.
                    </span>
                    @endif
                    @if($property->superficie)
                    <span class="flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                        {{ $property->superficie }} m²
                    </span>
                    @endif
                    @if($property->furnished)
                    <span class="ml-auto font-semibold text-emerald-600">Meublé</span>
                    @endif
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $properties->appends(request()->query())->links() }}
    </div>

    @else
    <!-- Empty state -->
    <div class="text-center py-28">
        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-5 bg-gray-100 rounded-3xl">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <h3 class="mb-2 text-xl font-bold text-gray-800">Aucun résultat</h3>
        <p class="mb-8 text-gray-400">Modifiez vos critères pour trouver votre bien.</p>
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all rounded-xl"
           style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
            Voir toutes les annonces
        </a>
    </div>
    @endif
</section>
@auth
<!-- ══════════════════════════════════════
     PLATFORM EXPERTS (Experts locaux)
══════════════════════════════════════ -->
@if(isset($platformExperts) && $platformExperts->flatten()->isNotEmpty() && !request()->hasAny(['search','type','option']))
<section class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-end gap-8 border-b border-slate-200 pb-10 lg:grid-cols-[1fr_auto]">
            <div class="max-w-3xl">
                <span class="text-xs font-extrabold tracking-widest text-blue-700 uppercase">Experts locaux</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950 md:text-5xl">
                    Des conseillers immobiliers prêts à vous guider
                </h2>
                <p class="max-w-2xl mt-4 text-base leading-7 text-slate-600">
                    Une sélection de managers, agents et bailleurs partenaires pour vérifier les annonces, organiser les visites et simplifier vos décisions.
                </p>
            </div>

            <div class="p-4 border rounded-lg border-slate-200 bg-slate-50">
                <div class="flex -space-x-3">
                    @php
                        $allExperts = $platformExperts->flatten();
                        $featuredExperts = $allExperts->take(3)->values();
                    @endphp

                    @foreach($featuredExperts as $expert)
                        @php
                            $fallbackPhotos = [
                                asset('storage/propriete/avatars/AVATAR5.png'),
                                asset('storage/propriete/avatars/AVATAR2.jpeg'),
                                asset('storage/propriete/avatars/AVATAR_3.PNG'),
                            ];

                            $defaultAvatar = asset('images/avatardefault.webp');

                            $expertPhoto = $expert->avatar
                                ? asset('storage/'.$expert->avatar)
                                : ($fallbackPhotos[$loop->index] ?? $fallbackPhotos[0] ?? $defaultAvatar);
                        @endphp
                        <img src="{{ $expertPhoto }}" alt="{{ $expert->name }}" class="object-cover w-12 h-12 border-2 border-white rounded-full shadow-sm">
                    @endforeach
                </div>
                <p class="mt-3 text-sm font-bold text-slate-900">{{ $allExperts->count() }} experts disponibles</p>
                <p class="text-xs text-slate-500">Profils vérifiés par ImmoSN</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mt-8">
            @if($platformExperts->has('manager'))
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-indigo-700 border border-indigo-100 rounded-full bg-indigo-50">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                    {{ $platformExperts['manager']->count() }} Managers
                </span>
            @endif
            @if($platformExperts->has('agent'))
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-blue-700 border border-blue-100 rounded-full bg-blue-50">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    {{ $platformExperts['agent']->count() }} Agents
                </span>
            @endif
            @if($platformExperts->has('bailleur'))
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold border rounded-full border-emerald-100 bg-emerald-50 text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    {{ $platformExperts['bailleur']->count() }} Bailleurs
                </span>
            @endif
        </div>

        @php
            $roleSections = [
                'manager' => ['title' => 'Direction & supervision', 'subtitle' => 'Coordination de la plateforme et qualité des annonces'],
                'agent' => ['title' => 'Agents immobiliers', 'subtitle' => 'Validation, visites et accompagnement personnalisé'],
                'bailleur' => ['title' => 'Bailleurs partenaires', 'subtitle' => 'Propriétaires actifs avec des biens vérifiés'],
            ];
        @endphp

        <div class="mt-12 space-y-14">
            @foreach($roleSections as $roleKey => $section)
                @if($platformExperts->has($roleKey) && $platformExperts[$roleKey]->isNotEmpty())
                    <div>
                        <div class="flex flex-col justify-between gap-2 mb-6 sm:flex-row sm:items-end">
                            <div>
                                <h3 class="text-xl font-extrabold text-slate-950">{{ $section['title'] }}</h3>
                                <p class="mt-1 text-sm text-slate-500">{{ $section['subtitle'] }}</p>
                            </div>
                            <span class="text-sm font-bold text-slate-400">{{ $platformExperts[$roleKey]->count() }} profil(s)</span>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($platformExperts[$roleKey] as $expert)
                                @include('components.expert-card', ['expert' => $expert])
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="pt-10 mt-16 border-t border-slate-200">
            <div class="grid grid-cols-1 gap-4 text-center md:grid-cols-3">
                @foreach([
                    ['100%', 'Annonces vérifiées', 'Chaque bien est contrôlé par nos agents'],
                    ['Sous 24h', 'Réponse rapide', 'Prise en charge de vos demandes de visite'],
                    ['De A à Z', 'Accompagnement', 'De la recherche à la signature'],
                ] as [$value, $label, $desc])
                    <div class="p-6 border rounded-lg border-slate-200 bg-slate-50">
                        <p class="mb-1 text-2xl font-extrabold text-slate-950">{{ $value }}</p>
                        <p class="mb-1 text-sm font-bold text-blue-700">{{ $label }}</p>
                        <p class="text-xs text-slate-500">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- ══════════════════════════════════════
     PLATFORM EXPERTS (Experts locaux)
══════════════════════════════════════ -->
@guest
<section class="px-4 mx-auto mb-16 max-w-7xl sm:px-6 lg:px-8">
    <div class="relative px-8 overflow-hidden text-white rounded-3xl py-14 md:px-16"
         style="background:linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%)">
        <!-- Décorations -->
        <div class="absolute top-0 right-0 rounded-full w-72 h-72 opacity-10" style="background:white; transform:translate(30%,-30%)"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full opacity-10" style="background:white; transform:translate(-30%,30%)"></div>

        <div class="relative z-10 flex flex-col items-center justify-between gap-8 md:flex-row">
            <div class="max-w-lg">
                <p class="mb-3 text-sm font-semibold tracking-widest text-blue-200 uppercase">Pour les bailleurs</p>
                <h3 class="mb-3 text-3xl font-extrabold" style="letter-spacing:-0.02em">
                    Vendez ou louez<br>votre bien rapidement
                </h3>
                <p class="text-base text-blue-200">
                    Publiez gratuitement et touchez des milliers d'acheteurs et locataires potentiels dès aujourd'hui.
                </p>
            </div>
            <div class="flex items-center flex-shrink-0 gap-3">
                <a href="{{ route('login') }}"
                   class="px-6 py-3 text-sm font-semibold text-white transition border-2 rounded-xl border-white/30 hover:bg-white/10">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 text-sm font-bold transition bg-white shadow-xl rounded-xl hover:bg-blue-50"
                   style="color:#1d4ed8">
                    Créer un compte →
                </a>
            </div>
        </div>
    </div>
</section>
@endguest
@endauth
@push('scripts')
<script>
function favoriteHeartIcon(favorited) {
    const fill = favorited ? 'currentColor' : 'none';
    const color = favorited ? 'text-red-500' : 'text-gray-500';

    return `<svg class="w-5 h-5 ${color}" fill="${fill}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`;
}

function applyFavoriteState(propertyId, favorited) {
    // Synchronise globalement tous les coeurs de ce propertyId
    document.querySelectorAll(`[data-favorite-property-id="${propertyId}"]`).forEach((btn) => {
        btn.dataset.favorited = favorited ? 'true' : 'false';
        btn.setAttribute('aria-pressed', favorited ? 'true' : 'false');
        btn.setAttribute('aria-label', favorited ? 'Retirer des favoris' : 'Ajouter aux favoris');
        btn.innerHTML = favoriteHeartIcon(favorited);
    });
}

function syncButton(button, favorited) {
    // Synchronise immédiatement le bouton cliqué
    button.dataset.favorited = favorited ? 'true' : 'false';
    button.setAttribute('aria-pressed', favorited ? 'true' : 'false');
    button.setAttribute('aria-label', favorited ? 'Retirer des favoris' : 'Ajouter aux favoris');
    button.innerHTML = favoriteHeartIcon(favorited);
}

function togglePropertyFavorite(event, button) {
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();

    if (button.disabled) return;

    button.disabled = true;

    fetch(button.dataset.favoriteUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
    .then((response) => {
        if (!response.ok) throw new Error('favorite-toggle-failed');
        return response.json();
    })
    .then((data) => {
        const propertyId = button.dataset.favoritePropertyId ?? button.dataset.favoriteProperty;
        // Sync immédiat sur le bouton cliqué
        syncButton(button, data.favorited);
        // Sync global (tous les coeurs du même bien)
        applyFavoriteState(propertyId, data.favorited);
        button.dataset.favorited = data.favorited ? 'true' : 'false';
    })
    .finally(() => {
        button.disabled = false;
    });
}
</script>
@endpush

@endsection
