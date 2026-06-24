@extends('layouts.app')

@section('title', 'Tableau de bord Agent')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-8 text-3xl font-bold">Tableau de Bord Agent</h1>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-sm font-medium text-gray-500">Validations en Attente</h3>
                <p id="agent-pending-validations" class="mt-2 text-3xl font-bold text-yellow-600">{{ $pendingValidations }}</p>
                <a href="{{ route('agent.validations') }}" class="mt-2 text-sm text-blue-600 hover:underline">Voir les annonces →</a>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-sm font-medium text-gray-500">Demandes de Visite</h3>
                <p id="agent-pending-visits" class="mt-2 text-3xl font-bold text-blue-600">{{ $pendingVisits }}</p>
                <a href="{{ route('agent.visits') }}" class="mt-2 text-sm text-blue-600 hover:underline">Voir les demandes →</a>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-sm font-medium text-gray-500">Propriétés</h3>
                <p id="agent-properties-count" class="mt-2 text-3xl font-bold text-green-600">{{ \App\Models\Property::where('user_id', auth()->id())->count() }}</p>
                <a href="{{ route('agent.properties') }}" class="mt-2 text-sm text-blue-600 hover:underline">Voir mes propriétés →</a>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <a href="{{ route('agent.validations') }}" class="p-6 text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
                <h3 class="font-semibold">Valider Annonces</h3>
                <p class="mt-1 text-sm">{{ $pendingValidations }} en attente</p>
            </a>
            <a href="{{ route('agent.visits') }}" class="p-6 text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                <h3 class="font-semibold">Gérer Demandes de Visite</h3>
                <p class="mt-1 text-sm">{{ $pendingVisits }} demandes</p>
            </a>
            <a href="{{ route('agent.properties.create') }}" class="p-6 text-center text-white bg-green-600 rounded-lg hover:bg-green-700">
                <h3 class="font-semibold">+ Nouvelle Annonce</h3>
                <p class="mt-1 text-sm">Annonce d'agence</p>
            </a>
        </div>
    </div>
</div>


@push('scripts')
<script>
(function () {
  const url = '{{ route('agent.dashboard.stats') }}';
  const getEl = (id) => document.getElementById(id);

  async function refreshStats() {
    try {
      const res = await fetch(url, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
      });

      if (!res.ok) return;
      const data = await res.json();

      const v1 = getEl('agent-pending-validations');
      if (v1) v1.textContent = data.pendingValidations;

      const v2 = getEl('agent-pending-visits');
      if (v2) v2.textContent = data.pendingVisits;

      const v3 = getEl('agent-properties-count');
      if (v3) v3.textContent = data.propertiesCount;
    } catch (e) {
      // no-op
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    refreshStats();
    setInterval(refreshStats, 15000);
  });
})();
</script>
@endpush
@endsection
