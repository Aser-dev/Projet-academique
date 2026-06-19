@extends('layouts.app')
@section('title', 'Tableau de bord Bailleur')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-sm text-gray-500 font-medium">Espace bailleur</p>
            <h1 class="text-2xl font-extrabold text-gray-900 mt-0.5" style="letter-spacing:-0.01em">
                Bonjour, {{ explode(' ', auth()->user()->name)[0] }} 👋
            </h1>
        </div>
        <a href="{{ route('properties.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 text-white text-sm font-bold rounded-xl shadow-md transition-all hover:-translate-y-0.5"
           style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouvelle annonce
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @php
        $stats = [
            [$properties->count(), 'Total annonces', 'text-blue-600', 'bg-blue-50', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            [$properties->where('status','publiee')->count(), 'Publiées', 'text-emerald-600', 'bg-emerald-50', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            [$properties->where('status','en_attente')->count(), 'En attente', 'text-amber-600', 'bg-amber-50', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            [$properties->sum('views_count'), 'Vues totales', 'text-purple-600', 'bg-purple-50', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
        ];
        @endphp
        @foreach($stats as [$val,$label,$color,$bg,$path])
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl {{ $bg }} flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 {{ $color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $path }}"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-gray-900">{{ number_format($val) }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $label }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Table des annonces --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="font-bold text-gray-900">Mes annonces</h2>
            <span class="text-xs text-gray-400 font-medium">{{ $properties->count() }} bien(s)</span>
        </div>

        @if($properties->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Bien</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Vues</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($properties as $property)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                    @if($property->photos->first())
                                        <img src="{{ $property->photos->first()->url }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 max-w-xs truncate">{{ $property->title }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                        <span class="capitalize">{{ $property->type }}</span>
                                        <span class="text-gray-300">·</span>
                                        <span>{{ $property->location }}</span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-900">{{ number_format($property->price, 0, ',', ' ') }}</p>
                            <p class="text-xs text-gray-400">FCFA{{ $property->option === 'location' ? '/mois' : '' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $statuses = [
                                'publiee'    => ['Publiée',    'bg-emerald-50 text-emerald-700'],
                                'en_attente' => ['En attente', 'bg-amber-50 text-amber-700'],
                                'retiree'    => ['Retirée',    'bg-red-50 text-red-700'],
                            ];
                            [$label, $cls] = $statuses[$property->status] ?? ['Inconnu', 'bg-gray-100 text-gray-600'];
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $cls }}">{{ $label }}</span>
                            @if($property->rejection_reason)
                                <p class="text-xs text-red-500 mt-1 max-w-xs truncate">{{ $property->rejection_reason }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-gray-700">{{ number_format($property->views_count) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('property.show', $property) }}"
                                   class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Voir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('properties.edit', $property) }}"
                                   class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('properties.destroy', $property) }}" x-data
                                      @submit.prevent="if(confirm('Supprimer cette annonce ?')) $el.submit()">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
            </div>
            <p class="text-sm font-medium text-gray-500 mb-4">Aucune annonce pour l'instant</p>
            <a href="{{ route('properties.create') }}"
               class="flex items-center gap-2 px-5 py-2.5 text-white text-sm font-bold rounded-xl transition-all"
               style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Publier ma première annonce
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
