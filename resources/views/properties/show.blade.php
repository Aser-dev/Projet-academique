@extends('layouts.app')
@section('title', $property->title)

@section('content')
@php
    $isFavorited = auth()->check()
        && auth()->user()->role === 'client'
        && auth()->user()->favorites()->where('property_id', $property->id)->exists();
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors font-medium">Annonces</a>
        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-400 capitalize">{{ $property->type }}</span>
        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-800 font-semibold truncate max-w-xs">{{ $property->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ── Colonne principale ── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Galerie photos --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100" x-data="{ main: '{{ $property->photos->first() ? $property->photos->first()->url : '' }}' }">
                <div class="relative overflow-hidden bg-gray-100" style="height:420px">
                    @if($property->photos->first())
                        <img :src="main" alt="{{ $property->title }}"
                             class="w-full h-full object-cover transition-opacity duration-300">
                        {{-- Badge --}}
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold tracking-wide text-white
                                {{ $property->option === 'vente' ? 'bg-blue-600' : 'bg-emerald-500' }}">
                                {{ strtoupper($property->option) }}
                            </span>
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-black/40 text-white backdrop-blur" style="backdrop-filter:blur(4px)">
                                {{ ucfirst($property->type) }}
                            </span>
                        </div>
                        {{-- Actions image --}}
                        <div class="absolute top-4 right-4 flex items-center gap-2">
                            @auth
                            @if(auth()->user()->role === 'client')
                            <button type="button"
                                    data-favorite-property="{{ $property->id }}"
                                    data-favorite-url="{{ route('favorite.toggle', $property) }}"
                                    data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
                                    onclick="togglePropertyFavorite(event, this)"
                                    aria-label="{{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
                                    aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-white/95 shadow-lg transition hover:bg-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-300">
                                <svg class="w-5 h-5 {{ $isFavorited ? 'text-red-500' : 'text-gray-500' }}" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                            @endif
                            @endauth
                            <span class="flex items-center gap-1 px-2.5 py-1 rounded-full text-xs text-white font-medium"
                                  style="background:rgba(0,0,0,0.35); backdrop-filter:blur(4px)">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ $property->views_count }} vues
                            </span>
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-3 bg-gray-50">
                            <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                            <p class="text-sm text-gray-400">Aucune photo disponible</p>
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($property->photos->count() > 1)
                <div class="flex gap-2 p-3">
                    @foreach($property->photos->take(5) as $photo)
                    <button @click="main='{{ $photo->url }}'"
                            class="flex-shrink-0 rounded-xl overflow-hidden border-2 transition-all hover:border-blue-500"
                            :class="main==='{{ $photo->url }}' ? 'border-blue-500' : 'border-transparent'"
                            style="width:80px; height:60px">
                        <img src="{{ $photo->url }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Titre & description --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div class="flex-1">
                        <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">{{ ucfirst($property->type) }} · {{ ucfirst($property->option) }}</p>
                        <h1 class="text-2xl font-extrabold text-gray-900 leading-tight mb-2" style="letter-spacing:-0.01em">
                            {{ $property->title }}
                        </h1>
                        <div class="flex items-center gap-1.5 text-sm text-gray-500">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="font-medium">{{ $property->location }}</span>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-3xl font-extrabold text-blue-700">{{ number_format($property->price, 0, ',', ' ') }}</p>
                        <p class="text-sm text-gray-400 font-medium">FCFA{{ $property->option === 'location' ? ' / mois' : '' }}</p>
                    </div>
                </div>

                {{-- Specs en ligne --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-5 border-y border-gray-100">
                    @if($property->rooms)
                    <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <p class="text-lg font-bold text-gray-900">{{ $property->rooms }}</p>
                        <p class="text-xs text-gray-500">Chambres</p>
                    </div>
                    @endif
                    @if($property->superficie)
                    <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                        <p class="text-lg font-bold text-gray-900">{{ $property->superficie }}</p>
                        <p class="text-xs text-gray-500">m²</p>
                    </div>
                    @endif
                    @if($property->floor !== null)
                    <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                        <p class="text-lg font-bold text-gray-900">{{ $property->floor === 0 ? 'RDC' : $property->floor }}</p>
                        <p class="text-xs text-gray-500">Étage</p>
                    </div>
                    @endif
                    <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 {{ $property->furnished ? 'text-emerald-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <p class="text-sm font-bold text-gray-900">{{ $property->furnished ? 'Oui' : 'Non' }}</p>
                        <p class="text-xs text-gray-500">Meublé</p>
                    </div>
                </div>

                {{-- Description --}}
                @if($property->description)
                <div class="mt-5">
                    <h2 class="text-base font-bold text-gray-900 mb-3">Description</h2>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $property->description }}</p>
                </div>
                @endif

                {{-- Usages --}}
                @if($property->usages->count())
                <div class="mt-5">
                    <h2 class="text-base font-bold text-gray-900 mb-3">Usage(s)</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($property->usages as $u)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 capitalize">{{ $u->usage }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Sidebar ── --}}
        <div class="space-y-5">

            {{-- Prix & CTA --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-24">
                <div class="mb-5 pb-5 border-b border-gray-100">
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-widest mb-1">Prix</p>
                    <p class="text-3xl font-extrabold text-gray-900">{{ number_format($property->price, 0, ',', ' ') }}</p>
                    <p class="text-sm text-gray-400 mt-0.5">FCFA{{ $property->option === 'location' ? ' / mois' : '' }}</p>
                </div>

                @auth
                    @if(auth()->user()->role === 'client')
                    <button onclick="document.getElementById('visitModal').classList.remove('hidden')"
                            class="w-full flex items-center justify-center gap-2 py-3 text-white text-sm font-bold rounded-xl mb-3 transition-all hover:-translate-y-0.5"
                            style="background:linear-gradient(135deg,#2563eb,#1e3a8a); box-shadow:0 4px 14px rgba(37,99,235,0.35)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Demander une visite
                    </button>
                    <form method="POST" action="{{ route('favorite.toggle', $property) }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-3 text-sm font-bold rounded-xl border-2 transition-all
                                    {{ $isFavorited
                                        ? 'border-red-200 bg-red-50 text-red-600 hover:bg-red-100'
                                        : 'border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-700 hover:bg-blue-50' }}">
                            <svg class="w-4 h-4" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                        </button>
                    </form>
                    @endif
                @else
                <a href="{{ route('login') }}"
                   class="w-full flex items-center justify-center gap-2 py-3 text-white text-sm font-bold rounded-xl mb-3 transition-all"
                   style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
                    Se connecter pour contacter
                </a>
                <a href="{{ route('register') }}"
                   class="w-full flex items-center justify-center gap-2 py-3 text-sm font-bold rounded-xl border-2 border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-700 transition-all">
                    Créer un compte
                </a>
                @endauth

                {{-- Détails résumé --}}
                <div class="mt-5 space-y-3">
                    @foreach([['Référence','#'.str_pad($property->id,4,'0',STR_PAD_LEFT)],['Type',ucfirst($property->type)],['Transaction',ucfirst($property->option)],['Superficie',($property->superficie ?? '—').' m²'],['Publié le',$property->created_at->format('d/m/Y')]] as [$k,$v])
                    <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                        <span class="text-xs text-gray-500">{{ $k }}</span>
                        <span class="text-xs font-semibold text-gray-800">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal visite --}}
@auth
@if(auth()->user()->role === 'client')
<div id="visitModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px)">
    <div class="bg-white rounded-2xl p-7 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Demander une visite</h3>
                <p class="text-xs text-gray-400 mt-0.5">{{ $property->title }}</p>
            </div>
            <button onclick="document.getElementById('visitModal').classList.add('hidden')"
                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('visit.request', $property) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date souhaitée</label>
                <input type="date" name="visit_date" required
                       min="{{ now()->addDay()->format('Y-m-d') }}"
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-100">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Heure souhaitée</label>
                <input type="time" name="visit_time" required
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-100">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="document.getElementById('visitModal').classList.add('hidden')"
                        class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-colors">
                    Annuler
                </button>
                <button type="submit"
                        class="flex-1 py-3 text-white font-bold rounded-xl text-sm transition-all hover:-translate-y-0.5"
                        style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
                    Confirmer la visite
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endauth

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
