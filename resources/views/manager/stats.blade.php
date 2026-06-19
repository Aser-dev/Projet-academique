@extends('layouts.app')
@section('title', 'Statistiques')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold">Statistiques Manager</h1>
                <p class="text-gray-500 mt-1">Vue d’ensemble chiffrée de la plateforme.</p>
            </div>
            <a href="{{ route('manager.users') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow-sm">
                Gérer les utilisateurs
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">
            <div class="bg-white shadow-sm rounded-2xl p-6 card">
                <h3 class="text-gray-500 text-sm font-medium">Utilisateurs</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-2xl p-6 card">
                <h3 class="text-gray-500 text-sm font-medium">Annonces</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_properties'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-2xl p-6 card">
                <h3 class="text-gray-500 text-sm font-medium">Publiées</h3>
                <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $stats['published'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-2xl p-6 card">
                <h3 class="text-gray-500 text-sm font-medium">En attente</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending_validation'] }}</p>
            </div>
            <div class="bg-white shadow-sm rounded-2xl p-6 card">
                <h3 class="text-gray-500 text-sm font-medium">Visites aujourd’hui</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['visits_today'] }}</p>
            </div>
        </div>

        <div class="mt-6 bg-white shadow-sm rounded-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Conseils rapides</h2>
            <ul class="space-y-2 text-gray-700">
                <li>• Surveillez particulièrement le nombre d’annonces <span class="font-semibold">en attente</span>.</li>
                <li>• Comparez les <span class="font-semibold">visites d’aujourd’hui</span> avec vos annonces publiées.</li>
                <li>• Utilisez « Gérer les utilisateurs » pour activer/désactiver et maintenir la plateforme.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
