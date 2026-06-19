<div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300 group">
    <!-- Image Container -->
    <div class="relative overflow-hidden h-64 bg-gray-200">
        @if ($property->photos && $property->photos->first())
            <img src="{{ asset('storage/' . $property->photos->first()->photo_url) }}" 
                 alt="{{ $property->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
        @else
            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        
        <!-- Badge -->
        <div class="absolute top-3 left-3">
            @if ($property->status === 'new')
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">New</span>
            @elseif ($property->status === 'coming_soon')
                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Coming Soon</span>
            @else
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Available</span>
            @endif
        </div>

        <!-- Favorite Button -->
        <div class="absolute top-3 right-3">
            @auth
                <button onclick="toggleFavorite({{ $property->id }})" 
                        class="favorite-btn-{{ $property->id }} bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition">
                    @if (auth()->check() && auth()->user()->favorites()->where('property_id', $property->id)->exists())
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    @endif
                </button>
            @endauth
        </div>
    </div>

    <!-- Content -->
    <div class="p-4">
        <!-- Price -->
        <div class="mb-2">
            <p class="text-2xl font-bold text-gray-900">${{ number_format($property->price, 0) }}</p>
        </div>

        <!-- Address -->
        <a href="{{ route('property.show', $property) }}" class="hover:text-blue-600 transition">
            <h3 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-2">{{ $property->address }}</h3>
        </a>

        <!-- Details -->
        <div class="flex gap-3 text-sm text-gray-600 mb-4">
            @if ($property->bedrooms)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h2v8H3zm4-8h10V3H7zm12 8h2v8h-2z"></path>
                    </svg>
                    <span>{{ $property->bedrooms }} Bed{{ $property->bedrooms != 1 ? 's' : '' }}</span>
                </div>
            @endif
            @if ($property->bathrooms)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 14c1.66 0 3-1.34 3-3 0-1.65-1.34-3-3-3s-3 1.35-3 3c0 1.66 1.34 3 3 3zm13.71-9.71L12 2.41 2.29 12.12A4 4 0 002 15.5V22h4v-6h4v6h4v-2.5c0-.95.3-1.85.85-2.64z"></path>
                    </svg>
                    <span>{{ $property->bathrooms }} Bath{{ $property->bathrooms != 1 ? 's' : '' }}</span>
                </div>
            @endif
            @if ($property->square_feet)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2v2H3zm2 4h2V5h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm4-16h2V3h-2zm2 4h2V5h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm4-16h2V3h-2zm2 4h2V5h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm4-16h2V3h-2zm2 4h2V5h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zm0 4h2v-2h-2z"></path>
                    </svg>
                    <span>{{ number_format($property->square_feet, 0) }} sqft</span>
                </div>
            @endif
        </div>

        <!-- Location -->
        <p class="text-sm text-gray-500 mb-4">{{ $property->city }}, {{ $property->state }}</p>

        <!-- Action Button -->
        <div class="flex gap-2">
            <a href="{{ route('property.show', $property) }}" 
               class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center text-sm font-semibold">
                View Details
            </a>
            @auth
                <button onclick="requestVisit({{ $property->id }})"
                        class="flex-1 px-4 py-2 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition text-sm font-semibold">
                    Schedule Tour
                </button>
            @endauth
        </div>
    </div>
</div>

<script>
function toggleFavorite(propertyId) {
    @auth
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
            if (data.favorited) {
                btn.innerHTML = '<svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
            } else {
                btn.innerHTML = '<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
            }
        });
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}

function requestVisit(propertyId) {
    @auth
        // You can implement modal or form for scheduling tour
        alert('Schedule tour feature coming soon!');
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}
</script>
