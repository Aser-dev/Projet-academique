@php
    $roleStyles = [
        'manager' => [
            'badge' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
            'accent' => 'text-indigo-700',
            'line' => 'bg-indigo-600',
            'photo' => asset('storage/propriete/avatars/AVATAR5.png'),
            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        ],
        'agent' => [
            'badge' => 'bg-blue-50 text-blue-700 border-blue-100',
            'accent' => 'text-blue-700',
            'line' => 'bg-blue-600',
            'photo' => asset('storage/propriete/avatars/AVATAR2.jpeg'),
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        ],
        'bailleur' => [
            'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
            'accent' => 'text-emerald-700',
            'line' => 'bg-emerald-600',
            'photo' => asset('storage/propriete/avatars/avatar3.webp'),
            'icon' => 'M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z',
        ],
    ];
    $style = $roleStyles[$expert->role] ?? $roleStyles['agent'];
    $stat = $expert->expert_stat;
    $fallbackPhotos = [
        asset('storage/propriete/avatars/AVATAR5.png'),
        asset('storage/propriete/avatars/AVATAR5.png'),
        asset('storage/propriete/avatars/AVATAR_3.PNG'),
        asset('storage/propriete/avatars/AVATAR_3.PNG'),
        asset('storage/propriete/avatars/AVATAR_3.PNG'),
        asset('storage/propriete/avatars/AVATAR_3.PNG'),
    ];

    $fallbackPhoto = $fallbackPhotos[$expert->id % count($fallbackPhotos)] ?? $style['photo'];
    $defaultAvatar = asset('images/avatardefault.webp');

    $photoUrl = $expert->avatar
        ? asset('storage/'.$expert->avatar)
        : ($fallbackPhoto ?: $defaultAvatar);
@endphp

<article class="expert-card group overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:border-slate-300">
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        <img src="{{ $photoUrl }}" alt="{{ $expert->name }}" loading="lazy"
             class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]">
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-slate-950/70 to-transparent" aria-hidden="true"></div>
        <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-[11px] font-bold shadow-sm {{ $style['badge'] }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $style['icon'] }}"/>
                </svg>
                {{ $expert->role_label }}
        </span>
        <div class="absolute bottom-4 left-4 right-4">
            <h3 class="truncate text-xl font-extrabold tracking-tight text-white">
                {{ $expert->name }}
            </h3>
            @if($expert->address)
                <p class="mt-1 flex items-center gap-1 text-xs font-medium text-white/85">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    <span class="truncate">{{ $expert->address }}</span>
                </p>
            @endif
        </div>
    </div>

    <div class="p-5">
        <div class="mb-5 flex items-start justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-500">Expert ImmoSN</p>
                <p class="mt-1 text-sm leading-6 text-slate-600">Accompagnement terrain, conseils fiables et suivi des demandes de visite.</p>
            </div>
            <div class="flex items-center gap-1 rounded-md bg-amber-50 px-2 py-1 text-xs font-bold text-amber-700">
                <svg class="h-3.5 w-3.5 fill-current" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                4.9
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 border-y border-slate-100 py-4">
            <div>
                <p class="text-2xl font-extrabold text-slate-900">{{ $stat['value'] }}</p>
                <p class="mt-0.5 text-[11px] font-bold uppercase text-slate-500">{{ $stat['label'] }}</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-slate-900">24h</p>
                <p class="mt-0.5 text-[11px] font-bold uppercase text-slate-500">Réponse moyenne</p>
            </div>
        </div>

        @if($expert->phone)
            <a href="tel:{{ preg_replace('/\s+/', '', $expert->phone) }}"
               class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-md bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $expert->phone }}
            </a>
        @else
            <div class="mt-5 h-11 rounded-md border border-slate-200 bg-slate-50"></div>
        @endif
    </div>
</article>
