@extends('layouts.app')
@section('title', 'Mes favoris')
@section('content')
<h2>Mes biens favoris</h2>
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @foreach($favorites as $fav)
        @php
            $property = $fav->property;
            $isFavorited = auth()->check() && auth()->user()->favorites()->where('property_id', $property->id)->exists();
        @endphp

        <a href="{{ route('property.show', $property) }}"
           class="block overflow-hidden bg-white border border-gray-100 card group rounded-2xl"
           style="box-shadow:0 1px 6px rgba(0,0,0,0.07)">

            <!-- Image -->
            <div class="relative overflow-hidden" style="height:200px; background:#e2e8f0">
                @if($property->photos && $property->photos->first())
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

                <!-- Gradient overlay -->
                <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 55%)"></div>

                <!-- Favorite Button -->
                <div class="absolute top-3 right-3">
                    <button
                        type="button"
onclick="toggleFavorite(event, {{ $property->id }})"
                        class="favorite-btn-{{ $property->id }} bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition">

                        @if($isFavorited)
                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        @endif
                    </button>
                </div>

                <!-- Badge option -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide
                        {{ $property->option === 'vente' ? 'bg-blue-600 text-white' : 'bg-emerald-500 text-white' }}">
                        {{ strtoupper($property->option) }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1">{{ ucfirst($property->type) }}</p>
                <h3 class="mb-2 text-sm font-semibold leading-snug text-gray-900 transition-colors line-clamp-2 group-hover:text-blue-700" style="min-height:2.5rem">
                    {{ $property->title }}
                </h3>

                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-3">
                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="font-medium truncate">{{ $property->location }}</span>
                </div>
            </div>
        </a>
    @endforeach
</div>

<script>
function toggleFavorite(event, propertyId) {
    // Ne pas suivre le lien <a> parent
    event.stopPropagation();

    fetch(`/favorite/${propertyId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const btn = document.querySelector(`.favorite-btn-${propertyId}`);
        if (!btn) return;
        if (data.favorited) {
            btn.innerHTML = '<svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
        } else {
            btn.innerHTML = '<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
        }
    });
}
</script>
@endsection