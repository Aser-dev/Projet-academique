@extends('layouts.app')
@section('title', 'Nouvelle annonce agence')

@section('content')
<div class="max-w-3xl px-4 py-10 mx-auto sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Nouvelle annonce agence</h1>
        <p class="mt-2 text-gray-600">Remplissez les informations et publiez votre annonce.</p>
    </div>
    @if ($errors->any())
        <div class="p-4 mb-6 border border-red-200 rounded-xl bg-red-50">
            <div class="font-semibold text-red-800">Oups !</div>
            <ul class="pl-5 mt-2 text-sm text-red-700 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agent.properties.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Titre *</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Description *</label>
            <textarea name="description" required rows="4" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Prix *</label>
                <input type="number" name="price" min="0" step="1" value="{{ old('price') }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Superficie *</label>
                <input type="number" name="superficie" min="0" step="1" value="{{ old('superficie') }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Localisation *</label>
            <input type="text" name="localisation" value="{{ old('localisation') }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Type *</label>
                <select name="type" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="terrain" {{ old('type')==='terrain'?'selected':'' }}>Terrain</option>
                    <option value="batiment" {{ old('type')==='batiment'?'selected':'' }}>Bâtiment</option>
                    <option value="appartement" {{ old('type')==='appartement'?'selected':'' }}>Appartement</option>
                    <option value="villa" {{ old('type')==='villa'?'selected':'' }}>Villa</option>
                    <option value="commerce" {{ old('type')==='commerce'?'selected':'' }}>Commerce</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Option *</label>
                <select name="option_type" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    <option value="location" {{ old('option_type')==='location'?'selected':'' }}>Location</option>
                    <option value="vente" {{ old('option_type')==='vente'?'selected':'' }}>Vente</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Pièces</label>
                <input type="number" name="rooms" min="0" step="1" value="{{ old('rooms') }}" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Étage</label>
                <input type="number" name="floor" min="0" step="1" value="{{ old('floor') }}" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="furnished" value="1" id="furnished" {{ old('furnished') ? 'checked' : '' }}>
            <label for="furnished" class="text-sm font-medium text-gray-700">Meublé</label>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Usages *</label>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach(['residence'=>'Résidence','bureau'=>'Bureau','commerce'=>'Commerce','agriculture'=>'Agriculture'] as $val=>$label)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="usages[]" value="{{ $val }}" {{ in_array($val, (array) old('usages', []), true) ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Photos * (max 5)</label>
            <input type="file" name="photos[]" multiple required accept="image/*" class="w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700">
            <p class="mt-2 text-xs text-gray-500">Astuce : sélectionnez plusieurs images d’un coup.</p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition-all">
                Publier
            </button>
            <a href="{{ route('agent.properties') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
