@extends('layouts.app')
@section('title', 'Mes annonces')
@section('content')
<h2>Mes annonces</h2>
<a href="{{ route('properties.create') }}">Déposer une annonce</a>
@foreach($properties as $property)
    <div>
        <h3>{{ $property->title }}</h3>
        <p>{{ $property->price }} FCFA - {{ $property->status }}</p>
        <a href="{{ route('properties.edit', $property) }}">Modifier</a>
        <form method="POST" action="{{ route('properties.destroy', $property) }}">
            @csrf @method('DELETE')
            <button>Supprimer</button>
        </form>
    </div>
@endforeach
@endsection