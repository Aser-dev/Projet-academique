@extends('layouts.app')
@section('title', 'Mes annonces agence')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold">Annonces publiées par l’agence</h1>
                <p class="text-gray-500 mt-1">Gérez vos annonces et suivez leur visibilité.</p>
            </div>

            <a href="{{ route('agent.properties.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 shadow-sm">
                + Nouvelle annonce agence
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($properties as $property)
                <div class="card bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                    <div class="h-44 bg-gray-100 flex items-center justify-center">
                        @if ($property->photos && $property->photos->first())
                            <img src="{{ $property->photos->first()?->url ?? asset('images/no-image.png') }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 leading-tight line-clamp-2">{{ $property->title }}</h2>
                                <p class="text-sm text-gray-600 mt-1">{{ $property->location }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-extrabold text-blue-700">{{ number_format($property->price, 0) }} <span class="text-sm font-semibold text-gray-500">FCFA</span></p>
                                <p class="text-xs text-gray-500 mt-1">{{ ucfirst($property->type) }} · {{ ucfirst($property->option) }}</p>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @if(!empty($property->superficie))
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">{{ $property->superficie }} m²</span>
                            @endif
                            @if(!empty($property->rooms))
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">{{ $property->rooms }} pièces</span>
                            @endif
                            <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">{{ $property->status === 'publiee' ? 'Publiée' : ucfirst($property->status) }}</span>
                        </div>

                        <div class="mt-5 flex gap-3">
                            <a href="{{ route('property.show', $property) }}" class="flex-1 px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-black text-center">
                                Voir
                            </a>


                            <a href="{{ route('agent.properties.edit', ['property' => $property->id]) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 text-center">
                                Modifier
                            </a>
                            </a>

                            <form action="{{ route('agent.properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-xl hover:bg-red-700 text-center">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 xl:col-span-3 bg-white shadow-sm rounded-2xl p-10 text-center border border-gray-100">
                    <p class="text-gray-500">Aucune annonce agence publiée.</p>
                    <a href="{{ route('agent.properties.create') }}" class="mt-4 inline-block px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Créer une annonce</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
