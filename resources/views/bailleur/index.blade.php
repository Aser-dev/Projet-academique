@extends('layouts.app')
@section('title', 'Mes annonces')

@section('content')
@php
    $statusMeta = [
        'publiee' => [
            'label' => 'Publi&eacute;e',
            'class' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
            'dot' => 'bg-emerald-500',
        ],
        'en_attente' => [
            'label' => 'En attente',
            'class' => 'bg-amber-50 text-amber-700 ring-amber-100',
            'dot' => 'bg-amber-500',
        ],
        'retiree' => [
            'label' => 'Retir&eacute;e',
            'class' => 'bg-rose-50 text-rose-700 ring-rose-100',
            'dot' => 'bg-rose-500',
        ],
    ];

    $totalViews = $properties->sum('views_count');
    $publishedCount = $properties->where('status', 'publiee')->count();
    $pendingCount = $properties->where('status', 'en_attente')->count();
    $totalValue = $properties->sum('price');
@endphp

<div class="min-h-screen bg-slate-50">
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="mb-6 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('bailleur.dashboard') }}" class="font-medium transition-colors hover:text-blue-700">Espace bailleur</a>
                <svg class="h-4 w-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="font-semibold text-slate-800">Mes annonces</span>
            </nav>

            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase text-blue-700">Portefeuille immobilier</p>
                    <h1 class="mt-2 text-3xl font-extrabold text-slate-950 sm:text-4xl">Mes annonces</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                        Suivez vos biens, leur statut de validation et leurs performances depuis un seul espace.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('bailleur.dashboard') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                        </svg>
                        Tableau de bord
                    </a>
                    <a href="{{ route('properties.create') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-blue-700 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-700/20 transition hover:-translate-y-0.5 hover:bg-blue-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        D&eacute;poser une annonce
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-500">Total annonces</p>
                    <span class="rounded-lg bg-blue-50 p-2 text-blue-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-950">{{ number_format($properties->count(), 0, ',', ' ') }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-500">Publi&eacute;es</p>
                    <span class="rounded-lg bg-emerald-50 p-2 text-emerald-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-950">{{ number_format($publishedCount, 0, ',', ' ') }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-500">En attente</p>
                    <span class="rounded-lg bg-amber-50 p-2 text-amber-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-950">{{ number_format($pendingCount, 0, ',', ' ') }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-500">Vues totales</p>
                    <span class="rounded-lg bg-violet-50 p-2 text-violet-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-950">{{ number_format($totalViews, 0, ',', ' ') }}</p>
            </div>
        </div>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-slate-950">Gestion des biens</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Valeur totale affich&eacute;e: {{ number_format($totalValue, 0, ',', ' ') }} FCFA
                    </p>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    {{ $properties->count() }} bien(s)
                </span>
            </div>

            @if($properties->isNotEmpty())
                <div class="divide-y divide-slate-100">
                    @foreach($properties as $property)
                        @php
                            $meta = $statusMeta[$property->status] ?? [
                                'label' => ucfirst(str_replace('_', ' ', $property->status ?? 'inconnu')),
                                'class' => 'bg-slate-100 text-slate-700 ring-slate-200',
                                'dot' => 'bg-slate-400',
                            ];
                            $mainPhoto = $property->photos->first();
                        @endphp

                        <article class="grid gap-4 p-5 transition hover:bg-slate-50 lg:grid-cols-[180px_1fr_auto] lg:items-center">
                            <a href="{{ route('property.show', $property) }}" class="block overflow-hidden rounded-xl bg-slate-100 lg:h-32">
                                @if($mainPhoto)
                                    <img src="{{ $mainPhoto->url }}" alt="{{ $property->title }}" class="h-48 w-full object-cover transition duration-300 hover:scale-105 lg:h-full">
                                @else
                                    <div class="flex h-48 w-full items-center justify-center lg:h-full">
                                        <svg class="h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $meta['class'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $meta['dot'] }}"></span>
                                        {!! $meta['label'] !!}
                                    </span>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold capitalize text-slate-600">{{ $property->type }}</span>
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold capitalize text-blue-700">{{ $property->option }}</span>
                                </div>

                                <a href="{{ route('property.show', $property) }}" class="mt-3 block text-xl font-extrabold leading-tight text-slate-950 transition hover:text-blue-700">
                                    {{ $property->title }}
                                </a>

                                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $property->location }}
                                    </span>
                                    <span>{{ number_format($property->superficie, 0, ',', ' ') }} m&sup2;</span>
                                    @if($property->rooms)
                                        <span>{{ $property->rooms }} chambre(s)</span>
                                    @endif
                                    <span>{{ number_format($property->views_count, 0, ',', ' ') }} vue(s)</span>
                                </div>

                                @if($property->rejection_reason)
                                    <p class="mt-3 rounded-xl bg-rose-50 px-3 py-2 text-sm font-medium text-rose-700">
                                        Motif: {{ $property->rejection_reason }}
                                    </p>
                                @endif
                            </div>

                            <div class="flex flex-col gap-4 lg:items-end">
                                <div class="lg:text-right">
                                    <p class="text-2xl font-extrabold text-slate-950">{{ number_format($property->price, 0, ',', ' ') }}</p>
                                    <p class="text-sm font-semibold text-slate-500">FCFA{{ $property->option === 'location' ? ' / mois' : '' }}</p>
                                </div>

                                <div class="flex flex-wrap gap-2 lg:justify-end">
                                    <a href="{{ route('property.show', $property) }}"
                                       class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700"
                                       title="Voir l'annonce" aria-label="Voir l'annonce">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('properties.edit', $property) }}"
                                       class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-amber-200 hover:bg-amber-50 hover:text-amber-700"
                                       title="Modifier" aria-label="Modifier">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('properties.destroy', $property) }}" x-data
                                          @submit.prevent="if (confirm('Supprimer cette annonce ?')) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-700"
                                                title="Supprimer" aria-label="Supprimer">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-16 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                        </svg>
                    </div>
                    <h2 class="mt-5 text-xl font-extrabold text-slate-950">Aucune annonce pour le moment</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Ajoutez votre premier bien pour lancer le processus de validation et commencer &agrave; recevoir des vues.
                    </p>
                    <a href="{{ route('properties.create') }}"
                       class="mt-6 inline-flex items-center gap-2 rounded-xl bg-blue-700 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        D&eacute;poser ma premi&egrave;re annonce
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
