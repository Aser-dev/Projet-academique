@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Tableau de Bord Manager</h1>

        <!-- Key Statistics - EF-D7 -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium">Total Propriétés</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_properties'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium">En Attente de Validation</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending_validations'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium">Demandes de Visite</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['visits_requested'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium">Utilisateurs</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['total_clients'] + $stats['total_bailheurs'] + $stats['total_agents'] }}</p>
            </div>
        </div>

        <!-- Properties by Type Chart -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Propriétés par Type</h2>
                <div class="space-y-3">
                    @forelse($stats['properties_by_type'] as $prop)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 capitalize">{{ $prop->type }}</span>
                            <div class="flex items-center gap-2">
                                <div class="w-48 bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $stats['total_properties'] > 0 ? ($prop->count / $stats['total_properties'] * 100) : 0 }}%"></div>
                                </div>
                                <span class="text-gray-900 font-bold">{{ $prop->count }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Aucune propriété</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Résumé Utilisateurs</h2>
                <ul class="space-y-3">
                    <li class="flex justify-between">
                        <span class="text-gray-700">Clients</span>
                        <span class="font-bold">{{ $stats['total_clients'] }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-700">Bailleurs</span>
                        <span class="font-bold">{{ $stats['total_bailheurs'] }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-700">Agents</span>
                        <span class="font-bold">{{ $stats['total_agents'] }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Recent Visit Requests -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Demandes de Visite Récentes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Propriété</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-t border-gray-200">
                        @forelse($stats['recent_visits'] as $visit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visit->client->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visit->property->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                        @if($visit->status === 'en_attente') bg-yellow-100 text-yellow-800
                                        @elseif($visit->status === 'validee') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($visit->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visit->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucune demande</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Properties - EF-D8/EF-D7 -->
        <div class="bg-white shadow-sm rounded-lg p-6 mt-8">
            <h2 class="text-xl font-semibold mb-4">Annonces en attente de validation</h2>

            @if($pendingProperties->isEmpty())
                <p class="text-gray-500">Aucune annonce en attente de validation</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bailleur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de soumission</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white border-t border-gray-200">
                            @foreach($pendingProperties as $property)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $property->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($property->type) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $property->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $property->created_at?->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-sm space-x-3">
                                        <form method="POST" action="{{ route('manager.properties.validate', $property) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                                                ✓ Valider
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('manager.properties.reject', $property) }}" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Rejeter cette annonce ?')" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                                                ✗ Rejeter
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex gap-4">

            <a href="{{ route('manager.users') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Gérer Utilisateurs
            </a>
            <a href="{{ route('manager.stats') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                Voir Statistiques Détaillées
            </a>
        </div>
    </div>
</div>
@endsection
