@extends('layouts.app')
@section('title', 'Modifier l\'annonce')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('bailleur.dashboard') }}" class="hover:text-blue-600 transition-colors font-medium">Mon espace</a>
        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('bailleur.properties') }}" class="hover:text-blue-600 transition-colors font-medium">Mes annonces</a>
        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-800 font-semibold truncate max-w-xs">Modifier</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-900">Modifier l'annonce</h1>
                <p class="text-xs text-gray-400 mt-0.5">{{ $property->title }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('properties.update', $property) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Titre --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Titre de l'annonce *</label>
                    <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 focus:bg-white transition-all @error('title') border-red-400 @enderror">
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Type de bien *</label>
                    <select name="type" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all">
                        @foreach(['terrain','batiment','appartement','villa','commerce'] as $t)
                        <option value="{{ $t }}" {{ old('type', $property->type) === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Transaction --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Transaction *</label>
                    <select name="option" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all">
                        <option value="vente" {{ old('option', $property->option) === 'vente' ? 'selected' : '' }}>Vente</option>
                        <option value="location" {{ old('option', $property->option) === 'location' ? 'selected' : '' }}>Location</option>
                    </select>
                </div>

                {{-- Prix --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Prix (FCFA) *</label>
                    <input type="number" name="price" value="{{ old('price', $property->price) }}" required min="0"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all @error('price') border-red-400 @enderror">
                    @error('price') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Superficie --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Superficie (m²) *</label>
                    <input type="number" name="superficie" value="{{ old('superficie', $property->superficie) }}" required min="0" step="0.01"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all @error('superficie') border-red-400 @enderror">
                    @error('superficie') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Localisation --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Localisation *</label>
                          <input type="text" name="location" value="{{ old('location', $property->location) }}" required
                              placeholder="Ex: Secteur 15, Ouagadougou"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all @error('location') border-red-400 @enderror">
                    @error('location') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Chambres --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre de chambres</label>
                    <input type="number" name="rooms" value="{{ old('rooms', $property->rooms) }}" min="0"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all">
                </div>

                {{-- Étage --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Étage</label>
                    <input type="number" name="floor" value="{{ old('floor', $property->floor) }}" min="0"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all">
                </div>

                {{-- Meublé --}}
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="furnished" value="1" {{ old('furnished', $property->furnished) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-blue-600 cursor-pointer">
                        <span class="text-sm font-semibold text-gray-700">Bien meublé</span>
                    </label>
                </div>

                {{-- Description --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:border-blue-500 transition-all resize-none @error('description') border-red-400 @enderror">{{ old('description', $property->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('bailleur.properties') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                    Annuler
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 text-white text-sm font-bold rounded-xl transition-all hover:-translate-y-0.5"
                        style="background:linear-gradient(135deg,#2563eb,#1e3a8a); box-shadow:0 4px 14px rgba(37,99,235,0.35)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
