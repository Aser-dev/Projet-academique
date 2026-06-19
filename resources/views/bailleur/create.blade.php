@extends('layouts.app')
@section('title', 'Nouvelle annonce agence')
@section('content')
<form method="POST" action="{{ route('agent.properties.store') }}" enctype="multipart/form-data" class="max-w-lg">
    @csrf
    <div><label>Titre</label><input type="text" name="title" required></div>
    <div><label>Description</label><textarea name="description" required></textarea></div>
    <div><label>Prix</label><input type="number" name="price" required></div>
    <div><label>Superficie</label><input type="number" name="superficie" required></div>
    <div><label>Localisation</label><input type="text" name="localisation" required></div>
    <div><label>Type</label><select name="type" required>
        <option value="terrain">Terrain</option>
        <option value="batiment">Bâtiment</option>
        <option value="appartement">Appartement</option>
        <option value="villa">Villa</option>
        <option value="commerce">Commerce</option>
    </select></div>
    <div><label>Option</label><select name="option_type" required>
        <option value="location">Location</option>
        <option value="vente">Vente</option>
    </select></div>
    <div><label>Pièces</label><input type="number" name="rooms"></div>
    <div><label>Étage</label><input type="number" name="floor"></div>
    <div><label>Meublé ?</label><input type="checkbox" name="furnished" value="1"></div>
    <div><label>Usages</label>
        <input type="checkbox" name="usages[]" value="residence"> Résidence
        <input type="checkbox" name="usages[]" value="bureau"> Bureau
        <input type="checkbox" name="usages[]" value="commerce"> Commerce
        <input type="checkbox" name="usages[]" value="agriculture"> Agriculture
    </div>
    <div><label>Photos</label><input type="file" name="photos[]" multiple required></div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2">Publier</button>
</form>
@endsection