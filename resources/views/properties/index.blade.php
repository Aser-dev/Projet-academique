@extends('layouts.app')
@section('title', 'Annonces immobilières au Burkina')

@section('content')

<!-- ══════════════════════════════════════
     HERO SECTION
══════════════════════════════════════ -->
<section class="relative" style="height:580px; min-height:480px;">
    <!-- Image de fond -->
    <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1600&q=85"
             alt="Immobilier" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0" style="background:linear-gradient(to right, rgba(15,23,42,0.82) 0%, rgba(15,23,42,0.55) 55%, rgba(15,23,42,0.3) 100%)"></div>
    </div>

    <!-- Contenu Hero -->
    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-xl">
                <!-- Tag -->
                <div class="inline-flex items-center gap-2 mb-5 px-3 py-1.5 rounded-full text-xs font-semibold text-white"
                     style="background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); backdrop-filter:blur(8px)">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Plus de {{ $properties->total() }} annonces disponibles
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-4" style="letter-spacing:-0.02em">
                    Trouvez le bien<br>
                    <span style="background:linear-gradient(90deg,#60a5fa,#818cf8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text">
                        qui vous correspond
                    </span>
                </h1>
                <p class="text-lg text-slate-300 mb-8">
                    Villas, appartements, terrains — des annonces vérifiées partout au Burkina.
                </p>

                <!-- Barre de recherche -->
                <form method="GET" action="{{ route('home') }}"
                      class="bg-white rounded-2xl p-2 shadow-2xl flex flex-col sm:flex-row gap-2"
                      style="box-shadow:0 25px 60px rgba(0,0,0,0.4)">

                    <!-- Recherche texte -->
                    <div class="flex items-center gap-2 flex-1 px-4 py-2.5 bg-gray-50 rounded-xl">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Ville, quartier, titre..."
                               class="flex-1 bg-transparent text-sm text-gray-800 placeholder-gray-400 outline-none">
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
                       class="px-3 py-1 rounded-full text-xs font-medium text-white hover:text-white transition-all"
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
            @foreach([[$properties->total().' +','Annonces actives','text-blue-600'],['5','Villes couvertes','text-blue-600'],['100%','Annonces vérifiées','text-green-600'],['24/7','Support client','text-blue-600']] as [$v,$l,$c])
            <div class="flex items-center gap-4 px-8 py-5">
                <p class="text-2xl font-extrabold {{ $c }}">{{ $v }}</p>
                <p class="text-sm text-gray-500 font-medium leading-tight">{{ $l }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════
     FILTRES CATÉGORIES
══════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="flex items-center gap-3 overflow-x-auto pb-1" style="scrollbar-width:none">
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
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $path }}"/>
            </svg>
            {{ $label }}
        </a>
        @endforeach
    </div>
</section>

<!-- ══════════════════════════════════════
     GRILLE ANNONCES
══════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($properties as $property)
        @php $isFavorited = in_array($property->id, $favoritePropertyIds); @endphp
        <article class="card group bg-white rounded-2xl overflow-hidden border border-gray-100"
                 style="box-shadow:0 1px 6px rgba(0,0,0,0.07)">

            <!-- Image -->
            <div class="relative overflow-hidden" style="height:200px; background:#e2e8f0">
                <a href="{{ route('property.show', $property) }}" class="block w-full h-full">
                @if($property->photos->first())
                <img src="{{ $property->photos->first()->url }}"
                     alt="{{ $property->title }}"
                     class="card-img w-full h-full object-cover">
                @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-2">
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
                <div class="absolute top-3 right-3 flex items-center gap-2">
                    @auth
                    @if(auth()->user()->role === 'client')
                    <button type="button"
                            data-favorite-property="{{ $property->id }}"
                            data-favorite-url="{{ route('favorite.toggle', $property) }}"
                            data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
                            onclick="togglePropertyFavorite(event, this)"
                            aria-label="{{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
                            aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-white/95 shadow-lg transition hover:bg-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <svg class="w-5 h-5 {{ $isFavorited ? 'text-red-500' : 'text-gray-500' }}" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    @endif
                    @endauth
                    <span class="flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-medium text-white"
                          style="background:rgba(0,0,0,0.35); backdrop-filter:blur(4px)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ $property->views_count }}
                    </span>
                </div>

                <!-- Prix -->
                <div class="absolute bottom-3 left-3 right-3">
                    <p class="text-white font-bold text-lg leading-none">
                        {{ number_format($property->price, 0, ',', ' ') }}
                        <span class="text-white/70 text-xs font-normal">
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
                    <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-700 transition-colors mb-2" style="min-height:2.5rem">
                        {{ $property->title }}
                    </h3>
                </a>

                <!-- Localisation -->
                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-3">
                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate font-medium">{{ $property->location }}</span>
                </div>

                <!-- Caractéristiques -->
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
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
                    <span class="text-emerald-600 font-semibold ml-auto">Meublé</span>
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
        <div class="w-20 h-20 rounded-3xl bg-gray-100 flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun résultat</h3>
        <p class="text-gray-400 mb-8">Modifiez vos critères pour trouver votre bien.</p>
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-xl transition-all"
           style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
            Voir toutes les annonces
        </a>
    </div>
    @endif
</section>

<!-- ══════════════════════════════════════
     SECTION CTA
══════════════════════════════════════ -->
@guest
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <div class="relative overflow-hidden rounded-3xl px-8 py-14 md:px-16 text-white"
         style="background:linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%)">
        <!-- Décorations -->
        <div class="absolute top-0 right-0 w-72 h-72 rounded-full opacity-10" style="background:white; transform:translate(30%,-30%)"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full opacity-10" style="background:white; transform:translate(-30%,30%)"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-lg">
                <p class="text-blue-200 text-sm font-semibold uppercase tracking-widest mb-3">Pour les bailleurs</p>
                <h3 class="text-3xl font-extrabold mb-3" style="letter-spacing:-0.02em">
                    Vendez ou louez<br>votre bien rapidement
                </h3>
                <p class="text-blue-200 text-base">
                    Publiez gratuitement et touchez des milliers d'acheteurs et locataires potentiels dès aujourd'hui.
                </p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-xl border-2 border-white/30 text-white font-semibold hover:bg-white/10 transition text-sm">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 rounded-xl bg-white font-bold hover:bg-blue-50 transition shadow-xl text-sm"
                   style="color:#1d4ed8">
                    Créer un compte →
                </a>
            </div>
        </div>
    </div>
</section>
@endguest

@push('scripts')
<script>
function favoriteHeartIcon(favorited) {
    const fill = favorited ? 'currentColor' : 'none';
    const color = favorited ? 'text-red-500' : 'text-gray-500';

    return `<svg class="w-5 h-5 ${color}" fill="${fill}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`;
}

function applyFavoriteState(propertyId, favorited) {
    document.querySelectorAll(`[data-favorite-property="${propertyId}"]`).forEach((button) => {
        button.dataset.favorited = favorited ? 'true' : 'false';
        button.setAttribute('aria-pressed', favorited ? 'true' : 'false');
        button.setAttribute('aria-label', favorited ? 'Retirer des favoris' : 'Ajouter aux favoris');
        button.innerHTML = favoriteHeartIcon(favorited);
    });
}

function togglePropertyFavorite(event, button) {
    event.preventDefault();
    event.stopPropagation();

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
    .then((data) => applyFavoriteState(button.dataset.favoriteProperty, data.favorited))
    .finally(() => {
        button.disabled = false;
    });
}
</script>
@endpush

@endsection
