@props([
    'icon',
    'title',
    'description',
    'iconType' => 'svg', // svg alebo png
])

@php
    $icons = [
        'sun' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>',
        'camera' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l2-3h14l2 3v13H3V8z"/><circle cx="12" cy="13" r="4"/></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3z"/></svg>',
        'shield3' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">,

    <!-- Štít -->
    <path d="M12 2L4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3z" />
    <!-- WiFi signál vo vnútri štítu -->
    <path d="M8 12c1.5-1.5 6.5-1.5 8 0" />
    <path d="M9.5 14.5c1-1 4-1 5 0" />
    <circle cx="12" cy="17" r="1" fill="currentColor"/>
</svg>
',
        'shield2' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
    <!-- Zámok -->
    <rect x="7" y="10" width="10" height="10" rx="2" />
    <path d="M8 10V7a4 4 0 018 0v3" />
    <!-- Kábel -->
    <path d="M12 20v2M10 22h4" />
</svg>
',
'wind' => '<svg xmlns="http://www.w3.org/2000/svg"
    class="w-6 h-6"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    viewBox="0 0 24 24">

    <path d="M3 8h10a3 3 0 100-6" />
    <path d="M2 16h14a3 3 0 110 6" />
    <path d="M4 12h12" />

</svg>',


        'bolt' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2L3 14h9v8l10-12h-9z"/></svg>',
        'default' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a6 6 0 00-8.5 8.5l10 10 3.5-3.5-10-10zM16 2l6 6"/></svg>',
    ];

    $iconSvg = $icons[$icon] ?? $icons['default'];
@endphp

<div class="border-2 border-rose-100 rounded-lg p-6 bg-softPink text-rose-800 w-full hover:shadow transition">
    <div class="mb-4 text-2xl text-black">
        @if ($iconType === 'svg')
            {!! $iconSvg !!}
        @elseif ($iconType === 'png')
            <img src="{{ asset('storage/icons/' . $icon . '.png') }}" alt="{{ $title }}" class="w-8 h-8">
        @endif
    </div>
    <h3 class="font-bold text-lg text-black mb-2">{{ $title }}</h3>
    <p class="text-md leading-snug">{{ $description }}</p>
</div>
