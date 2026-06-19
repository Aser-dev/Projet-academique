<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                            <div class="grid gap-6 xl:grid-cols-3">
                                <div class="p-6 bg-white shadow sm:rounded-lg xl:col-span-1">
                                    <h2 class="text-lg font-semibold text-gray-900">Résumé du profil</h2>
                                    <p class="mt-2 text-sm text-gray-500">Informations de base et statut du compte.</p>

                                    <div class="mt-6 space-y-4">
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">Nom</p>
                                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $user->name }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">Email</p>
                                            <p class="mt-1 text-base text-gray-900">{{ $user->email }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">Rôle</p>
                                            <p class="mt-1 text-base text-gray-900 capitalize">{{ $user->role }}</p>
                                        </div>
                                        @if($user->phone)
                                            <div class="rounded-2xl bg-slate-50 p-4">
                                                <p class="text-xs uppercase tracking-wide text-gray-500">Téléphone</p>
                                                <p class="mt-1 text-base text-gray-900">{{ $user->phone }}</p>
                                            </div>
                                        @endif
                                        @if($user->address)
                                            <div class="rounded-2xl bg-slate-50 p-4">
                                                <p class="text-xs uppercase tracking-wide text-gray-500">Adresse</p>
                                                <p class="mt-1 text-base text-gray-900">{{ $user->address }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-6 bg-white shadow sm:rounded-lg xl:col-span-1">
                                    <h2 class="text-lg font-semibold text-gray-900">Statistiques</h2>
                                    <p class="mt-2 text-sm text-gray-500">Chiffres clés liés à votre rôle.</p>
                                    <div class="mt-6 space-y-3">
                                        @forelse($stats as $label => $value)
                                            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                                <p class="text-sm text-gray-600">{{ $label }}</p>
                                                <p class="font-semibold text-gray-900">{{ $value }}</p>
                                            </div>
                                        @empty
                                            <p class="text-sm text-gray-500">Aucune statistique disponible pour ce rôle.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
