<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2" style="letter-spacing:-0.02em">Bon retour 👋</h1>
        <p class="text-gray-500 text-sm">Connectez-vous à votre espace ImmoSN</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="vous@exemple.com"
                   class="field {{ $errors->has('email') ? 'error' : '' }}">
            @error('email')
            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <div class="flex items-center justify-between mb-1.5">
                <label class="text-sm font-semibold text-gray-700">Mot de passe</label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:text-blue-800">
                    Mot de passe oublié ?
                </a>
                @endif
            </div>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password" required
                       placeholder="••••••••"
                       class="field pr-11 {{ $errors->has('password') ? 'error' : '' }}">
                <button type="button" @click="show=!show"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            @error('password')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2.5">
            <input id="remember" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-blue-600 cursor-pointer">
            <label for="remember" class="text-sm text-gray-600 cursor-pointer select-none">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-submit">
            Se connecter
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-500">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800">
                S'inscrire gratuitement
            </a>
        </p>
    </div>
</x-guest-layout>
