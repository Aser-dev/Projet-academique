@extends('layouts.app')

@section('title', 'Historique des Demandes de Visite')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Mes Demandes de Visite</h1>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Propriété</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adresse</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Demandée</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($visits as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $visit->property->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visit->property->location }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visit->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                    @if($visit->status === 'en_attente') bg-yellow-100 text-yellow-800
                                    @elseif($visit->status === 'validee') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @if($visit->status === 'en_attente') En Attente
                                    @elseif($visit->status === 'validee') Validée
                                    @else Refusée
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('property.show', $visit->property) }}" class="text-blue-600 hover:text-blue-800">
                                    Voir Propriété
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Vous n'avez pas encore de demandes de visite</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $visits->links() }}
        </div>
    </div>
</div>
@endsection
