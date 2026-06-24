@php
    $isFavorited = $isFavorited ?? (
        auth()->check()
        && auth()->user()->role === 'client'
        && auth()->user()->favorites()->where('property_id', $property->id)->exists()
    );
@endphp

<article class="property-card group overflow-hidden rounded-2xl bg-white border border-slate-200/80 hover:border-blue-300/60">
    {{-- Image --}}
    <div class="relative overflow-hidden h-60 bg-gradient-to-br from-slate-200 to-slate-300">
        <a href="{{ route('property.show', $property) }}" class="block w-full h-full" tabindex="-1" aria-hidden="true">
            @if ($property->photos && $property->photos->first())
                <img
                    src="{{ $property->photos->first()->url }}"
                    alt="{{ $property->title }}"
                    class="property-card-img w-full h-full object-cover"
                    loading="lazy"
                >
            @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-2 bg-gradient-to-br from-slate-100 to-slate-200">
                    <svg class="w-14 h-14 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    </svg>
                    <span class="text-xs text-slate-400 font-medium">Pas de photo</span>
                </div>
            @endif
        </a>

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/5 to-transparent pointer-events-none"></div>

        {{-- Badges top-left --}}
        <div class="absolute top-3 left-3 flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide text-white shadow-lg {{ ($property->option ?? '') === 'location' ? 'badge-location' : 'badge-vente' }}">
                {{ strtoupper($property->option ?? 'vente') }}
            </span>
            @if (($property->status ?? null) === 'publiee')
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold text-white badge-status shadow-lg">
                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                    Disponible
                </span>
            @endif
        </div>

        {{-- Actions top-right --}}
        <div class="absolute top-3 right-3 flex items-center gap-2">
            @auth
                @if(auth()->user()->role === 'client')
                    <button
                        type="button"
                        data-favorite-property="{{ $property->id }}"
                        data-favorite-url="{{ route('favorite.toggle', $property) }}"
                        data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
                        onclick="togglePropertyFavorite(event, this)"
                        aria-label="{{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
                        aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white/95 backdrop-blur-sm shadow-lg transition-all hover:bg-white hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-300"
                    >
                        <svg class="w-5 h-5 {{ $isFavorited ? 'text-red-500' : 'text-slate-500' }}" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                @endif
            @else
                <a
                    href="{{ route('login') }}"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-white/95 backdrop-blur-sm shadow-lg transition-all hover:bg-white hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400"
                    aria-label="Connexion pour ajouter aux favoris"
                >
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </a>
            @endauth

            @if(($property->views_count ?? 0) > 0)
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-semibold text-white bg-black/40 backdrop-blur-sm">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    {{ $property->views_count }}
                </span>
            @endif
        </div>

        {{-- Type badge bottom --}}
        <div class="absolute bottom-3 left-3">
            <span class="inline-block px-2.5 py-1 rounded-lg text-[11px] font-bold text-white bg-black/45 backdrop-blur-sm capitalize">
                {{ $property->type ?? '—' }}
            </span>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5">
        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1.5">
            {{ ucfirst($property->type ?? '') }} · {{ ucfirst($property->option ?? '') }}
        </p>

        <a href="{{ route('property.show', $property) }}" class="block group/title">
            <h3 class="font-bold text-lg text-slate-900 mb-2 line-clamp-2 leading-snug group-hover/title:text-blue-700 transition-colors">
                {{ $property->title }}
            </h3>
        </a>

        <div class="flex items-start gap-1.5 mb-4">
            <svg class="w-4 h-4 text-slate-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm text-slate-500 line-clamp-1">{{ $property->location ?? '—' }}</p>
        </div>

        {{-- Price --}}
        <div class="mb-4 pb-4 border-b border-slate-100">
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-0.5">Prix</p>
            <p class="text-2xl font-extrabold text-gradient leading-none">
                {{ number_format($property->price ?? 0, 0, ',', ' ') }}
                <span class="text-sm font-semibold text-slate-500">FCFA{{ ($property->option ?? '') === 'location' ? '/mois' : '' }}</span>
            </p>
        </div>

        {{-- Features --}}
        <div class="grid grid-cols-3 gap-2 mb-5">
            <div class="stat-tile flex flex-col items-center gap-1 p-2.5 rounded-xl">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <p class="text-base font-bold text-slate-900">{{ $property->rooms ?? '—' }}</p>
                <p class="text-[10px] text-slate-500 font-medium">Chambres</p>
            </div>
            <div class="stat-tile flex flex-col items-center gap-1 p-2.5 rounded-xl">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4"/></svg>
                <p class="text-base font-bold text-slate-900">{{ $property->bathrooms ?? '—' }}</p>
                <p class="text-[10px] text-slate-500 font-medium">Sdb</p>
            </div>
            <div class="stat-tile flex flex-col items-center gap-1 p-2.5 rounded-xl">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <p class="text-base font-bold text-slate-900">{{ $property->superficie ?? '—' }}</p>
                <p class="text-[10px] text-slate-500 font-medium">m²</p>
            </div>
        </div>

        @if($property->furnished)
            <span class="inline-block mb-4 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-full border border-emerald-200">
                Meublé
            </span>
        @endif

        {{-- CTA --}}
        <a
            href="{{ route('property.show', $property) }}"
            class="btn-primary w-full inline-flex items-center justify-center gap-2 px-4 py-3 text-white rounded-xl font-bold text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 focus-visible:ring-offset-2"
        >
            <span>Voir les détails</span>
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
