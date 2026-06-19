<x-guest-layout>
    <div class="mb-7">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2" style="letter-spacing:-0.02em">Créer un compte</h1>
        <p class="text-gray-500 text-sm">Rejoignez des milliers d'utilisateurs ImmoSN</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nom --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                   placeholder="Prénom Nom"
                   class="field {{ $errors->has('name') ? 'error' : '' }}">
            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   placeholder="vous@exemple.com"
                   class="field {{ $errors->has('email') ? 'error' : '' }}">
            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Rôle --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Je suis un(e)</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer block">
                    <input type="radio" name="role" value="client" class="peer sr-only"
                           {{ old('role','client') === 'client' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition-all
                                peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800">Client</p>
                        <p class="text-xs text-gray-400 mt-0.5">Je cherche un bien</p>
                    </div>
                </label>
                <label class="cursor-pointer block">
                    <input type="radio" name="role" value="bailleur" class="peer sr-only"
                           {{ old('role') === 'bailleur' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition-all
                                peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800">Bailleur</p>
                        <p class="text-xs text-gray-400 mt-0.5">Je vends / loue</p>
                    </div>
                </label>
            </div>
            @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Mot de passe --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
            <input type="password" name="password" required
                   placeholder="Minimum 8 caractères"
                   class="field {{ $errors->has('password') ? 'error' : '' }}">
            @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Confirmation --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   placeholder="Répétez votre mot de passe"
                   class="field">
        </div>

        <button type="submit" class="btn-submit">
            Créer mon compte
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-500">
            Déjà inscrit ?
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800">Se connecter</a>
        </p>
    </div>
</x-guest-layout>
