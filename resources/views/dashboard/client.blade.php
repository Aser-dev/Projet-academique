@extends('layouts.app')
@section('title', 'Mon espace client')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-sm text-gray-500 font-medium">Espace client</p>
            <h1 class="text-2xl font-extrabold text-gray-900 mt-0.5" style="letter-spacing:-0.01em">
                Bonjour, {{ explode(' ', auth()->user()->name)[0] }} 👋
            </h1>
        </div>
        <a href="{{ route('home') }}"
           class="flex items-center gap-2 px-5 py-2.5 text-white text-sm font-bold rounded-xl shadow-md transition-all hover:-translate-y-0.5"
           style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Parcourir
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        @php
        $stats = [
            [$favorites->count(), 'Favoris', 'text-rose-500', 'bg-rose-50', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            [$visits->count(), 'Visites demandées', 'text-blue-500', 'bg-blue-50', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            [$visits->where('status','validee')->count(), 'Visites validées', 'text-emerald-500', 'bg-emerald-50', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];
        @endphp
        @foreach($stats as [$val,$label,$color,$bg,$path])
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ $bg }} flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 {{ $color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $path }}"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ $val }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $label }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Favoris --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-900">Mes favoris</h2>
                <a href="{{ route('client.favorites') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800">
                    Voir tout →
                </a>
            </div>
            @if($favorites->count() > 0)
            <div class="divide-y divide-gray-50">
                @foreach($favorites->take(5) as $fav)
                <a href="{{ route('property.show', $fav->property) }}"
                   class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($fav->property->photos->first())
                            <img src="{{ $fav->property->photos->first()->url }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-blue-700 transition-colors">
                            {{ $fav->property->title }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $fav->property->location }}
                        </p>
                    </div>
                    <p class="text-sm font-bold text-blue-600 flex-shrink-0">
                        {{ number_format($fav->property->price, 0, ',', ' ') }} F
                    </p>
                </a>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-14 px-6 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-3">Aucun favori</p>
                <a href="{{ route('home') }}" class="text-xs font-semibold text-blue-600 hover:underline">Parcourir les annonces</a>
            </div>
            @endif
        </div>

        {{-- Visites --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-900">Mes demandes de visite</h2>
            </div>
            @if($visits->count() > 0)
            <div class="divide-y divide-gray-50">
                @foreach($visits->take(5) as $visit)
                <div class="flex items-center gap-4 px-6 py-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                        {{ $visit->status === 'en_attente' ? 'bg-amber-50' : ($visit->status === 'validee' ? 'bg-emerald-50' : 'bg-red-50') }}">
                        @if($visit->status === 'en_attente')
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($visit->status === 'validee')
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @else
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $visit->property->title }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('d/m/Y') : '—' }}
                            @if($visit->visit_time) · {{ substr($visit->visit_time, 0, 5) }} @endif
                        </p>
                    </div>
                    <span class="flex-shrink-0 px-2.5 py-1 rounded-full text-xs font-bold
                        {{ $visit->status === 'en_attente' ? 'bg-amber-50 text-amber-700' : ($visit->status === 'validee' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                        {{ $visit->status === 'en_attente' ? 'En attente' : ($visit->status === 'validee' ? 'Validée' : 'Refusée') }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-14 px-6 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-sm font-medium text-gray-500">Aucune visite demandée</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
