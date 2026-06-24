@extends('layouts.app')

@section('title', 'Validation des Annonces')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Annonces en Attente de Validation</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @forelse($properties as $property)
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Property Image -->
                    <div>
                        @if ($property->photos && $property->photos->first())
                            <img src="{{ $property->photos->first()?->url ?? asset('images/no-image.png') }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-48 object-cover rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Property Details -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $property->title }}</h3>
                        <p class="text-blue-600 font-bold text-2xl mb-3">${{ number_format($property->price, 0) }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Type :</strong> {{ ucfirst($property->type) }}</p>
                            <p><strong>Option :</strong> {{ ucfirst($property->option) }}</p>
                            <p><strong>Location :</strong> {{ $property->location }}</p>
                            <p><strong>Superficie :</strong> {{ $property->superficie }} m²</p>
                            <p><strong>Pièces :</strong> {{ $property->rooms ?? 'N/A' }}</p>
                            <p><strong>Bailleur :</strong> {{ $property->user->name }}</p>
                        </div>
                    </div>

                    <!-- Description and Actions -->
                    <div>
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Description</h4>
                            <p class="text-gray-600 text-sm">{{ Str::limit($property->description, 200) }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-3">
                            <!-- Validate Button -->
                            <form method="POST" action="{{ route('agent.validate', $property) }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                                    ✓ Valider & Publier
                                </button>
                            </form>

                            <!-- Reject Modal Trigger -->
                            <button onclick="openRejectModal({{ $property->id }})" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                                ✗ Refuser
                            </button>

                            <!-- View Details -->
                            <a href="{{ route('property.show', $property) }}" class="block text-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Voir Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reject Modal - EF-D1 -->
            <div id="reject-modal-{{ $property->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                    <h3 class="text-xl font-bold mb-4">Motif du Refus</h3>
                    <form method="POST" action="{{ route('agent.reject', $property) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Raison du refus *</label>
                            <textarea name="reason" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('reason') border-red-500 @enderror" required placeholder="Expliquez pourquoi cette annonce est refusée..."></textarea>
                            @error('reason')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Refuser
                            </button>
                            <button type="button" onclick="closeRejectModal({{ $property->id }})" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white shadow-sm rounded-lg p-12 text-center">
                <p class="text-gray-500 text-lg">Aucune annonce en attente de validation</p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $properties->links() }}
        </div>
    </div>
</div>

<script>
    function openRejectModal(propertyId) {
        document.getElementById(`reject-modal-${propertyId}`).classList.remove('hidden');
    }

    function closeRejectModal(propertyId) {
        document.getElementById(`reject-modal-${propertyId}`).classList.add('hidden');
    }
</script>
@endsection