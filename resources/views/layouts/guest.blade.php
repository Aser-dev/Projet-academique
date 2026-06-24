<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .field {
            width:100%; padding:0.75rem 1rem;
            background:#f8fafc; border:1.5px solid #e2e8f0;
            border-radius:0.75rem; font-size:0.875rem; outline:none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field:focus { border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,0.12); background:#fff; }
        .field.error { border-color:#ef4444; background:#fef2f2; }
        .btn-submit {
            width:100%; padding:0.8rem 1.5rem; display:flex; align-items:center; justify-content:center; gap:0.5rem;
            color:#fff; font-weight:700; font-size:0.9rem; border-radius:0.75rem;
            background:linear-gradient(135deg,#2563eb,#1e3a8a);
            box-shadow:0 4px 15px rgba(37,99,235,0.4); transition:all .2s; cursor:pointer; border:0;
        }
        .btn-submit:hover { box-shadow:0 6px 20px rgba(37,99,235,0.5); transform:translateY(-1px); }
        [x-cloak] { display:none!important; }
    </style>
</head>
<body class="antialiased bg-white" style="height:100vh; overflow:hidden">
<div class="flex h-screen">

    <!-- ── Panneau gauche ── -->
    <div class="hidden lg:flex lg:w-[55%] relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=85"
             class="absolute inset-0 w-full h-full object-cover" alt="">
        <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(15,23,42,0.88) 0%,rgba(30,58,138,0.7) 50%,rgba(37,99,235,0.4) 100%)"></div>

        <div class="relative z-10 flex flex-col justify-between h-full p-12">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center"
                     style="background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); backdrop-filter:blur(8px)">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-xl leading-none">ImmoSN</p>
                    <p class="text-blue-300 text-[10px] tracking-widest uppercase">Immobilier</p>
                </div>
            </a>

            <!-- Texte principal -->
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-white text-xs font-semibold mb-6"
                     style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2)">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    N°1 de l'immobilier au Burkina
                </div>

                <h2 class="text-4xl font-extrabold text-white leading-tight mb-4" style="letter-spacing:-0.02em">
                    Votre prochain<br>
                    <span style="background:linear-gradient(90deg,#93c5fd,#a5b4fc); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text">
                        chez-vous
                    </span><br>
                    vous attend ici.
                </h2>
                <p class="text-slate-300 text-base mb-10">
                    Des annonces vérifiées partout au Burkina — villas, appartements, terrains.
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4">
                    @foreach([['500+','Annonces'],['5','Villes'],['100%','Vérifiées']] as [$n,$l])
                    <div class="rounded-2xl p-4 text-center"
                         style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12); backdrop-filter:blur(8px)">
                        <p class="text-white text-2xl font-extrabold">{{ $n }}</p>
                        <p class="text-slate-400 text-xs mt-1">{{ $l }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Testimonial -->
            <div class="rounded-2xl p-5"
                 style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); backdrop-filter:blur(8px)">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&q=80"
                         class="w-10 h-10 rounded-full object-cover border-2 border-white/20" alt="">
                    <div>
                        <p class="text-white text-sm font-semibold">Mamadou D.</p>
                        <p class="text-slate-400 text-xs">Client vérifié</p>
                    </div>
                    <div class="ml-auto flex gap-0.5">
                        @for($i=0;$i<5;$i++)
                        <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                </div>
                <p class="text-slate-300 text-xs leading-relaxed italic">"Trouvé ma villa en 4 jours. Service impeccable !"</p>
            </div>
        </div>
    </div>

    <!-- ── Panneau droit formulaire ── -->
    <div class="w-full lg:w-[45%] flex flex-col bg-white overflow-y-auto">
        <!-- Header mobile -->
        <div class="lg:hidden flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#2563eb,#1e3a8a)">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                </div>
                <span class="font-bold text-gray-900">Immo<span class="text-blue-600">SN</span></span>
            </a>
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-600">← Retour</a>
        </div>

        <!-- Formulaire -->
        <div class="flex-1 flex items-center justify-center p-8 lg:p-14">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
