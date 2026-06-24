@extends('layouts.app')
@section('title', 'Demandes de visite')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold">Demandes de visite</h1>
                <p class="text-gray-500 mt-1">Liste paginée des demandes à traiter.</p>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Bien</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date souhaitée</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($visits as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $visit->client->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="font-semibold text-gray-900">{{ $visit->property->title ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ $visit->property->location ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visit->visit_date }} à {{ $visit->visit_time }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($visit->status === 'en_attente')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                @elseif($visit->status === 'validee')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Validée</span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Refusée</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($visit->status === 'en_attente')
                                    <form method="POST" action="{{ route('agent.visits.update', $visit) }}" class="flex items-center gap-2">
                                        @csrf
                                        <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                            <option value="validee">Valider</option>
                                            <option value="refusee">Refuser</option>
                                        </select>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Appliquer</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">Aucune demande pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $visits->links() }}
        </div>
    </div>
</div>
@endsection
