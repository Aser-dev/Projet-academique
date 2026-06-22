@extends('layouts.app')

@section('title', 'Nouvelle annonce (bailleur)')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
            <span class="inline-block w-2 h-2 bg-blue-600 rounded-full"></span>
            <span class="text-sm font-semibold">Nouvelle annonce</span>
        </div>

        <h1 class="mt-4 text-3xl sm:text-4xl font-black text-gray-900">
            Publier un bien avec un style premium
        </h1>
        <p class="mt-3 text-gray-600 max-w-2xl">
            Renseigne les informations clés, sélectionne les usages et ajoute plusieurs photos pour attirer plus d’acheteurs.
        </p>
    </div>

    <div class="bg-white/80 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-gray-800">Formulaire de publication</p>
                    <p class="text-xs text-gray-500 mt-1">Champs requis : titre, description, prix, superficie, localisation, type, option, usages, photos.</p>
                </div>
                <div class="hidden sm:flex items-center gap-2 text-xs text-gray-600">
                    <span class="px-2 py-1 rounded-lg bg-blue-50 border border-blue-100 font-semibold">PRO</span>
                    <span class="px-2 py-1 rounded-lg bg-indigo-50 border border-indigo-100 font-semibold">MAX</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('agent.properties.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf

            {{-- Identité du bien --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <x-input-label for="title" :value="__('Titre')" />
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Ex: Villa 3 chambres à Ouagadougou"
                    >
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="md:col-span-1">
                    <x-input-label for="type" :value="__('Type')" />
                    <select
                        id="type"
                        name="type"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >
                        <option value="terrain" @selected(old('type')==='terrain')>Terrain</option>
                        <option value="batiment" @selected(old('type')==='batiment')>Bâtiment</option>
                        <option value="appartement" @selected(old('type')==='appartement')>Appartement</option>
                        <option value="villa" @selected(old('type')==='villa')>Villa</option>
                        <option value="commerce" @selected(old('type')==='commerce')>Commerce</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="md:col-span-1">
                    <x-input-label for="option_type" :value="__('Option')" />
                    <select
                        id="option_type"
                        name="option_type"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >
                        <option value="location" @selected(old('option_type')==='location')>Location</option>
                        <option value="vente" @selected(old('option_type')==='vente')>Vente</option>
                    </select>
                    <x-input-error :messages="$errors->get('option_type')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea
                        id="description"
                        name="description"
                        required
                        rows="5"
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Décris le bien : emplacement, atouts, état, proximité, etc."
                    >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            {{-- Détails --}}
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="price" :value="__('Prix (FCFA)')" />
                    <input
                        id="price"
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Ex: 45000000"
                    >
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="superficie" :value="__('Superficie (m²)')" />
                    <input
                        id="superficie"
                        type="number"
                        name="superficie"
                        value="{{ old('superficie') }}"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Ex: 180"
                    >
                    <x-input-error :messages="$errors->get('superficie')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="localisation" :value="__('Localisation')" />
                    <input
                        id="localisation"
                        type="text"
                        name="localisation"
                        value="{{ old('localisation') }}"
                        required
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Ex: Zone du Bois, Ouagadougou"
                    >
                    <x-input-error :messages="$errors->get('localisation')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="rooms" :value="__('Pièces (chambres)')" />
                    <input
                        id="rooms"
                        type="number"
                        name="rooms"
                        value="{{ old('rooms') }}"
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Optionnel"
                    >
                    <x-input-error :messages="$errors->get('rooms')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="floor" :value="__('Étage')" />
                    <input
                        id="floor"
                        type="number"
                        name="floor"
                        value="{{ old('floor') }}"
                        class="mt-2 w-full rounded-xl border-gray-200 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Optionnel"
                    >
                    <x-input-error :messages="$errors->get('floor')" class="mt-2" />
                </div>

                <div class="md:col-span-2 flex items-center gap-3">
                    <input
                        id="furnished"
                        type="checkbox"
                        name="furnished"
                        value="1"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-200"
                        @checked(old('furnished'))
                    >
                    <div class="flex-1">
                        <x-input-label for="furnished" :value="__('Meublé ?')" />
                        <p class="text-xs text-gray-500 mt-1">Coche si le bien est meublé.</p>
                    </div>
                    <x-input-error :messages="$errors->get('furnished')" class="mt-2" />
                </div>
            </div>

            {{-- Usages --}}
            <div class="mt-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <x-input-label :value="__('Usages')" />
                        <p class="text-xs text-gray-500 mt-1">Sélectionne au moins un usage.</p>
                    </div>
                </div>

                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @php
                        $usages = [
                            'residence' => 'Résidence',
                            'bureau' => 'Bureau',
                            'commerce' => 'Commerce',
                            'agriculture' => 'Agriculture',
                        ];
                    @endphp

                    @foreach($usages as $key => $label)
                        <label class="cursor-pointer flex items-center gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-3 hover:border-blue-300 hover:shadow-sm transition">
                            <input
                                type="checkbox"
                                name="usages[]"
                                value="{{ $key }}"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-200"
                                @checked(in_array($key, old('usages', [])))
                            >
                            <span class="font-semibold text-gray-800">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>

                <x-input-error :messages="$errors->get('usages')" class="mt-2" />
            </div>

            {{-- Photos --}}
            <div class="mt-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <x-input-label for="photos" :value="__('Photos')" />
                        <p class="text-xs text-gray-500 mt-1">Ajoute plusieurs photos (backend : max 5).</p>
                    </div>
                </div>

                <div class="mt-3 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-5">
                    <input
                        id="photos"
                        type="file"
                        name="photos[]"
                        multiple
                        required
                        class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700 hover:file:bg-blue-100"
                    >
                    <p class="mt-2 text-xs text-gray-500">
                        Astuce : 3 à 5 photos nettes = meilleure conversion.
                    </p>
                </div>

                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
            </div>

            {{-- Actions --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <a
                    href="{{ route('bailleur.properties') }}"
                    class="px-5 py-3 rounded-xl border border-gray-200 text-gray-700 bg-white hover:border-gray-300 hover:bg-gray-50 transition text-center font-semibold"
                >
                    Annuler
                </a>

                <button
                    type="submit"
                    class="px-7 py-3 rounded-xl text-white font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 hover:shadow-lg hover:shadow-blue-500/30 transition text-center"
                >
                    Publier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
