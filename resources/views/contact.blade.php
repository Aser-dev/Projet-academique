@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">
        <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 text-sm font-semibold">
                <span class="inline-flex w-2 h-2 rounded-full bg-blue-500"></span>
                Support & demandes d'informations
            </div>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">Contact</h1>
            <p class="mt-3 text-slate-600 max-w-xl leading-relaxed">
                Une question sur une annonce, une visite, ou un projet immobilier ? Envoyez votre message et
                <span class="font-semibold text-slate-800">nous revenons vers vous rapidement</span>.
                Nos annonces sont publiées avec soin pour vous aider à décider en confiance.
            </p>

            <!-- Trust points -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Réponse rapide</p>
                            <p class="text-sm text-slate-600">En général sous 24–48h</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Annonces vérifiées</p>
                            <p class="text-sm text-slate-600">Qualité & cohérence des informations</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a4 4 0 00-8 0v4m8 0v2a4 4 0 01-8 0v-2m16 0v2a4 4 0 01-8 0v-2m8 0V7a4 4 0 00-8 0v4"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Confidentialité</p>
                            <p class="text-sm text-slate-600">Vos données restent privées</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Accompagnement</p>
                            <p class="text-sm text-slate-600">Visite, financement, conseils</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-5">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900">Coordonnées</h2>
                <p class="mt-1 text-sm text-slate-600">Vous préférez un contact direct ?</p>

                <div class="mt-5 space-y-4 text-sm">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-9 h-9 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Email</p>
                            <a class="text-blue-700 hover:underline" href="mailto:contact@immosn.bf">contact@immosn.bf</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-9 h-9 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21L8 10a11.042 11.042 0 005.516 5.516l2.257-1.13a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Téléphone</p>
                            <a class="text-blue-700 hover:underline" href="tel:+22670000000">+226 70 00 00 00</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 w-9 h-9 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Adresse</p>
                            <p class="text-slate-600">Ouagadougou, Burkina Faso</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-4">
                    <p class="text-sm font-semibold text-blue-900">Astuce</p>
                    <p class="text-sm text-blue-900/80">Si vous avez une annonce précise, copiez son intitulé dans le sujet.</p>
                </div>
            </div>
        </aside>
    </div>

    <!-- Feedback -->
    <div class="mt-10">
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                <p class="font-semibold mb-2">Corrigez les points suivants :</p>
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Form + FAQ -->
    <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <form method="POST" action="{{ route('contact.store') }}" class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                @csrf

                <!-- Honeypot anti-spam -->
                <div class="hidden">
                    <label for="hp_website" class="sr-only">Leave this field empty</label>
                    <input id="hp_website" name="hp_website" type="text" autocomplete="off" tabindex="-1">
                </div>

                <div class="flex items-start justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Envoyer un message</h2>
                        <p class="text-sm text-slate-600">Nous utilisons ces informations uniquement pour vous répondre.</p>
                    </div>
                    <div class="shrink-0 rounded-2xl bg-slate-50 border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600">
                        Réponse sous 24–48h
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="name">Nom</label>
                        <input id="name" name="name" type="text" placeholder="Votre nom"
                            value="{{ old('name') }}" required
                            aria-describedby="nameHelp" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <p id="nameHelp" class="mt-1 text-xs text-slate-500">Ex : Jean K.</p>
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="vous@exemple.com"
                            value="{{ old('email') }}" required
                            aria-describedby="emailHelp" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <p id="emailHelp" class="mt-1 text-xs text-slate-500">Pour vous recontacter rapidement.</p>
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="subject">Sujet</label>
                        <input id="subject" name="subject" type="text" placeholder="Ex : Demande de visite – Villa à Yagma"
                            value="{{ old('subject') }}" required
                            aria-describedby="subjectHelp" aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <p id="subjectHelp" class="mt-1 text-xs text-slate-500">Soyez précis (annonce, ville, type de bien).</p>
                        @error('subject')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required
                            placeholder="Décrivez votre demande (budget, délai, localisation, disponibilité)..."
                            aria-describedby="messageHelp" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('message') }}</textarea>
                        <p id="messageHelp" class="mt-1 text-xs text-slate-500">Minimum 10 caractères. Plus vous détaillez, plus on vous aide vite.</p>
                        @error('message')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- After send -->
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-900">Que se passe-t-il après l’envoi ?</p>
                    <ol class="mt-2 space-y-2 text-sm text-slate-700">
                        <li class="flex gap-3"><span class="font-bold text-blue-700">1</span> Votre demande est enregistrée.</li>
                        <li class="flex gap-3"><span class="font-bold text-blue-700">2</span> On vous contacte pour clarifier si besoin.</li>
                        <li class="flex gap-3"><span class="font-bold text-blue-700">3</span> On vous propose la meilleure suite (visite / infos / accompagnement).</li>
                    </ol>
                </div>

                <button type="submit"
                    class="mt-6 w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:shadow-xl hover:shadow-blue-500/50 transition font-bold text-lg">
                    Envoyer
                </button>
            </form>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">FAQ</h2>
                <p class="mt-1 text-sm text-slate-600">Réponses aux questions fréquentes.</p>

                <div class="mt-6 space-y-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Qu’est-ce que je dois écrire ?</p>
                        <p class="mt-1 text-sm text-slate-700">Votre demande (type de bien), la ville/quartier, votre budget indicatif et votre disponibilité pour une visite.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Sous combien de temps je reçois une réponse ?</p>
                        <p class="mt-1 text-sm text-slate-700">En général sous 24–48h. Si votre demande est urgente, précisez-le dans le message.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Mes informations sont-elles privées ?</p>
                        <p class="mt-1 text-sm text-slate-700">Oui. Nous utilisons vos informations uniquement pour vous recontacter au sujet de votre demande.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Puis-je demander une visite ?</p>
                        <p class="mt-1 text-sm text-slate-700">Oui. Mentionnez l’annonce et vos préférences de date/heure, et nous coordonnons la suite.</p>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl bg-blue-50 border border-blue-100 p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-white border border-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-blue-900">Besoin d’un accompagnement ?</p>
                            <p class="text-sm text-blue-900/80">On peut aussi vous aider pour le financement et les démarches.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


