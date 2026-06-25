<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ImmobSite') — Immobilier au Burkina Faso</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { DEFAULT: '#1047a9', 50:'#eff6ff', 100:'#dbeafe', 500:'#3b82f6', 600:'#2563eb', 700:'#1d4ed8', 800:'#1e40af', 900:'#1e3a8a' },
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { font-family: 'Inter', sans-serif; }

        /* Scrollbar thin */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }

        /* Navbar blur */
        .navbar { backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }

        /* Card hover */
        .card { transition: transform .22s ease, box-shadow .22s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.13); }
        .card:hover .card-img { transform: scale(1.06); }
        .card-img { transition: transform .4s ease; }

        /* Toast slide */
        @keyframes slideIn { from { opacity:0; transform: translateX(110%); } to { opacity:1; transform: translateX(0); } }
        .toast { animation: slideIn .3s ease; }

        /* Active nav link */
        .nav-link.active { color: #1d4ed8; font-weight: 600; }

        /* Dropdown animation */
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="antialiased text-gray-900 bg-slate-50">

<!-- ╔══════════════════════════════════════════╗
     ║              NAVIGATION                  ║
     ╚══════════════════════════════════════════╝ -->
<header class="sticky top-0 z-50 border-b border-gray-200 shadow-sm navbar bg-white/95">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="flex items-center justify-center shadow-md w-9 h-9 rounded-xl"
                     >
                    <img src="{{ asset('images/logo.png') }}" alt="ImmoSN">
                </div>
                <div class="leading-none">
                    <span class="text-lg font-bold tracking-tight text-gray-900">Immo</span><span class="text-lg font-bold tracking-tight" style="color:#1d4ed8">SN</span>
                    <p class="text-[9px] text-gray-400 font-medium tracking-widest uppercase">Immobilier</p>
                </div>
            </a>

            <!-- Nav centre -->
            <nav class="items-center hidden gap-1 lg:flex">
                <a href="{{ route('home') }}"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition-all {{ request()->routeIs('home') ? 'active bg-blue-50' : '' }}">
                    Annonces
                </a>
                <a href="{{ route('home') }}?option=vente"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition-all {{ request('option')==='vente' ? 'active bg-blue-50' : '' }}">
                    Vente
                </a>
                <a href="{{ route('home') }}?option=location"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition-all {{ request('option')==='location' ? 'active bg-blue-50' : '' }}">
                    Location
                </a>
                 <a href="{{ route('contact.create') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium text-sm rounded-lg hover:bg-gray-100 transition-all">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 6 9-6"/>
                        </svg>
                        Contact
                    </span>
                </a>
                @auth
                <a href="{{ route(auth()->user()->role.'.dashboard') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-600 transition-all rounded-lg nav-link hover:text-blue-700 hover:bg-blue-50">
                    Mon espace
                </a>
                @endauth
            </nav>

            <!-- Droite -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- User menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-2xl border border-gray-200 hover:border-blue-300 bg-white hover:bg-blue-50 transition-all shadow-sm">
                            <div class="flex items-center justify-center w-8 h-8 text-sm font-bold text-white shadow-sm rounded-xl"
                                 style="background: linear-gradient(135deg, #1d4ed8, #1e3a8a)">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden leading-tight text-left sm:block">
                                <p class="text-xs font-semibold text-gray-800">{{ explode(' ', auth()->user()->name)[0] }}</p>
                                <p class="text-[10px] text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                                 :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-cloak @click.away="open = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 z-50 w-56 mt-2 overflow-hidden bg-white border border-gray-100 shadow-2xl rounded-2xl">

                            <!-- User info -->
                            <div class="px-4 py-3.5 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                                <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                <div class="flex items-center gap-1.5 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                    <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }} · Actif</p>
                                </div>
                            </div>

                            <div class="p-1.5">
                                <a href="{{ route(auth()->user()->role.'.dashboard') }}"
                                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors font-medium">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/></svg>
                                    Tableau de bord
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors font-medium">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Mon profil
                                </a>
                            </div>

                            <div class="p-1.5 border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-semibold text-gray-700 transition-colors rounded-lg hover:text-blue-700 hover:bg-blue-50">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-semibold text-white rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5"
                       style="background: linear-gradient(135deg, #2563eb, #1e3a8a)">
                        Publier une annonce
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- ╔══════════════════════════════════════════╗
     ║                TOASTS                    ║
     ╚══════════════════════════════════════════╝ -->
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-end="opacity-0 translate-x-full"
     class="toast fixed top-20 right-5 z-[100] flex items-start gap-3 bg-white border border-green-200 shadow-xl rounded-2xl p-4 w-80">
    <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-100 rounded-full">
        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
    </div>
    <div class="flex-1">
        <p class="text-sm font-semibold text-gray-900">Succès</p>
        <p class="text-xs text-gray-500 mt-0.5">{{ session('success') }}</p>
    </div>
    <button @click="show=false" class="text-gray-300 hover:text-gray-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
</div>
@endif
@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-end="opacity-0 translate-x-full"
     class="toast fixed top-20 right-5 z-[100] flex items-start gap-3 bg-white border border-red-200 shadow-xl rounded-2xl p-4 w-80">
    <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-100 rounded-full">
        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </div>
    <div class="flex-1">
        <p class="text-sm font-semibold text-gray-900">Erreur</p>
        <p class="text-xs text-gray-500 mt-0.5">{{ session('error') }}</p>
    </div>
    <button @click="show=false" class="text-gray-300 hover:text-gray-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
</div>
@endif

<!-- MAIN -->
<main>
    @isset($slot)
        {{ $slot }}
    @endisset

    @yield('content')
</main>

<!-- ╔══════════════════════════════════════════╗
     ║                FOOTER                    ║
     ╚══════════════════════════════════════════╝ -->
<footer style="background:#0f172a" class="mt-20 text-slate-400">
    <div class="px-4 pb-8 mx-auto max-w-7xl sm:px-6 lg:px-8 pt-14">
        <div class="grid grid-cols-1 gap-10 mb-12 md:grid-cols-4">

            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-5">
                    <div class="flex items-center justify-center w-9 h-9 rounded-xl"
                        >
                        <img src="{{ asset('images/logo.png') }}" alt="ImmoSN">
                    </div>
                    <div>
                        <p class="text-lg font-bold leading-none tracking-tight text-white">ImmoSN</p>
                        <p class="text-slate-500 text-[10px] tracking-widest uppercase">Immobilier Burkina Faso</p>
                    </div>
                </div>
                <p class="max-w-sm text-sm leading-relaxed text-slate-500">
La référence de l'immobilier au Burkina Faso. Achetez, vendez ou louez votre bien en toute confiance avec des annonces vérifiées.
                </p>
            </div>

            <!-- Liens -->
            <div>
                <h5 class="mb-4 text-sm font-semibold text-white">Explorer</h5>
                <ul class="space-y-2.5 text-sm">
                    @foreach([['Villas','?type=villa'],['Appartements','?type=appartement'],['Terrains','?type=terrain'],['Commerces','?type=commerce']] as [$l,$q])
                    <li><a href="{{ route('home') }}{{ $q }}" class="transition-colors hover:text-white">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="mb-4 text-sm font-semibold text-white">Contact</h5>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2.5">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
contact@immosn.bf
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
+226 70 00 00 00
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
Ouagadougou, Burkina Faso
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-3 pt-6 border-t border-slate-800 sm:flex-row">
            <p class="text-xs text-slate-600">© {{ date('Y') }} ImmoSN — Tous droits réservés</p>
            <div class="flex gap-4 text-xs text-slate-600">
                <a href="#" class="transition-colors hover:text-slate-400">Confidentialité</a>
                <a href="#" class="transition-colors hover:text-slate-400">CGU</a>
                <a href="#" class="transition-colors hover:text-slate-400">Cookies</a>
            </div>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
