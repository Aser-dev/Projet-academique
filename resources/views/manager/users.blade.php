@extends('layouts.app')
@section('title', 'Utilisateurs')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold">Gestion des utilisateurs</h1>
                <p class="text-gray-500 mt-1">Recherchez, filtrez et gérez les comptes.</p>
            </div>
            <a href="{{ route('manager.users.create') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow-sm">
                + Créer utilisateur
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6 bg-white shadow-sm rounded-2xl p-5">
            <form method="GET" action="{{ route('manager.users') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Recherche</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom ou email" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                    <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous</option>
                        @foreach(['client','bailleur','agent'] as $r)
                            <option value="{{ $r }}" {{ request('role')===$r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Actif</label>
                    <select name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous</option>
                        <option value="1" {{ request('is_active')==='1' ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ request('is_active')==='0' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex items-end gap-2">
                    <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-black">Filtrer</button>
                    <a href="{{ route('manager.users') }}" class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 text-center">Reset</a>
                </div>
            </form>
        </div>

        <div class="mt-6 bg-white shadow-sm rounded-2xl overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Rôle</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Téléphone</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actif</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                    @if($user->role === 'client') bg-blue-100 text-blue-800
                                    @elseif($user->role === 'bailleur') bg-purple-100 text-purple-800
                                    @elseif($user->role === 'agent') bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                    @if($user->is_active) bg-emerald-100 text-emerald-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $user->is_active ? 'Oui' : 'Non' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm space-x-3">
                                <a href="{{ route('manager.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Éditer</a>

                                <form method="POST" action="{{ route('manager.users.toggle', $user) }}" class="inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="ml-2 text-indigo-700 hover:text-indigo-900 font-semibold">
                                        {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('manager.users.delete', $user) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucun utilisateur</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
