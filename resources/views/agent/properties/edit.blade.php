@extends('layouts.app')
@section('title', 'Modifier annonce agence')

@section('content')
<div class="max-w-3xl px-4 py-10 mx-auto sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Modifier l’annonce agence</h1>
        <p class="mt-2 text-gray-600">Mettez à jour les informations et enregistrez.</p>
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

    <form method="POST" action="{{ route('agent.properties.update', $property) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Titre *</label>
            <input type="text" name="title" value="{{ old('title', $property->title) }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Description *</label>
            <textarea name="description" required rows="4" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Prix *</label>
                <input type="number" name="price" min="0" step="1" value="{{ old('price', $property->price) }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Superficie *</label>
                <input type="number" name="superficie" min="0" step="1" value="{{ old('superficie', $property->superficie) }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Localisation *</label>
            <input type="text" name="localisation" value="{{ old('localisation', $property->location) }}" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Type *</label>
                <select name="type" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    @foreach(['terrain'=>'Terrain','batiment'=>'Bâtiment','appartement'=>'Appartement','villa'=>'Villa','commerce'=>'Commerce'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $property->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Option *</label>
                <select name="option_type" required class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                    @foreach(['location'=>'Location','vente'=>'Vente'] as $val => $label)
                        <option value="{{ $val }}" {{ old('option_type', $property->option) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Pièces</label>
                <input type="number" name="rooms" min="0" step="1" value="{{ old('rooms', $property->rooms) }}" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Étage</label>
                <input type="number" name="floor" min="0" step="1" value="{{ old('floor', $property->floor) }}" class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="furnished" value="1" id="furnished" {{ old('furnished', (bool) $property->furnished) ? 'checked' : '' }}>
            <label for="furnished" class="text-sm font-medium text-gray-700">Meublé</label>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Usages *</label>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach(['residence'=>'Résidence','bureau'=>'Bureau','commerce'=>'Commerce','agriculture'=>'Agriculture'] as $val=>$label)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="usages[]" value="{{ $val }}"
                            {{ in_array($val, old('usages', $property->usages->pluck('usage')->toArray() ?? []), true) ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Photos actuelles</label>
            <div class="flex flex-wrap gap-3 mb-4">
                @if($property->photos)
                    @foreach($property->photos as $photo)
                        <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center">
                            @php
                                $url = null;
                                // Certains modèles exposent path; d’autres peuvent exposer url via accessor.
                                if (isset($photo->url)) $url = $photo->url;
                                if (!$url && isset($photo->path)) $url = Storage::disk('public')->url($photo->path);
                            @endphp
                            @if($url)
                                <img src="{{ $url }}" alt="photo" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs text-gray-400">photo</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

            <label class="block mb-2 text-sm font-medium text-gray-700">Remplacer les photos (optionnel)</label>
            <input type="file" name="photos[]" multiple accept="image/*" class="w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700">
            <p class="mt-2 text-xs text-gray-500">L’upload remplace les anciennes photos si vous sélectionnez un fichier.</p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition-all">
                Enregistrer
            </button>
            <a href="{{ route('agent.properties') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection

