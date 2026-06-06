<!doctype html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fotovoltické systémy – LACOMP</title>
  <meta name="description" content="Fotovoltické systémy pre domácnosti a firmy. Ušetrite na elektrine s modernými solárnymi panelmi. Odborná inštalácia a servis." />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', -apple-system, sans-serif; }
    .fade-up { opacity:0; transform:translateY(24px); transition:opacity .6s ease,transform .6s ease; }
    .fade-up.visible { opacity:1; transform:translateY(0); }
    .feat-card { position:relative; overflow:hidden; }
    .feat-card::after { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; background:#d42020; transform:scaleX(0); transform-origin:left; transition:transform .38s ease; }
    .feat-card:hover::after { transform:scaleX(1); }
  </style>
</head>
<body class="bg-slate-50 antialiased">

{{-- ====== NAVBAR ====== --}}
<nav x-data="{ scrolled: false, open: false }"
     @scroll.window="scrolled = window.scrollY > 20"
     :class="scrolled ? 'bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-md' : 'bg-[#0f172a] border-b border-white/10'"
     class="fixed top-0 left-0 right-0 z-50 h-[72px] transition-all duration-300">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="h-[72px] flex items-center justify-between">
      <a href="/" class="flex items-center gap-3 shrink-0">
        <img src="{{ asset('lacomp-logo.svg') }}" alt="LACOMP" class="h-11 w-11" />
      </a>
      <div class="hidden lg:flex items-center gap-0.5">
        @foreach([
          ['/photovoltaicSystems','Fotovoltika'],
          ['/kamery','Kamery'],
          ['/alarmy','Alarmy'],
          ['/inspection','Revízie'],
          ['/rekuperacie','Rekuperácie'],
        ] as [$url,$label])
        <a href="{{ $url }}"
           :class="scrolled ? 'text-slate-600 hover:text-[#d42020] hover:bg-red-50' : 'text-white/85 hover:text-white hover:bg-white/10'"
           class="{{ request()->is(ltrim($url,'/')) ? 'text-[#d42020]!' : '' }} text-[0.9125rem] font-medium px-3 py-2 rounded-lg transition-all duration-200 whitespace-nowrap">{{ $label }}</a>
        @endforeach
      </div>
      <div class="flex items-center gap-3">
        <a href="/kontakt" class="hidden lg:inline-flex items-center gap-2 text-sm font-semibold text-white bg-[#d42020] border-2 border-[#d42020] px-5 py-2 rounded-xl hover:bg-[#b31c1c] hover:border-[#b31c1c] hover:-translate-y-0.5 transition-all duration-200">Kontakt</a>
        <button @click="open = !open" class="lg:hidden flex flex-col gap-[5px] p-1 bg-transparent border-none cursor-pointer" aria-label="Menu">
          <span :class="[open ? 'translate-y-[7px] rotate-45' : '', scrolled ? 'bg-slate-900' : 'bg-white']" class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
          <span :class="[open ? 'opacity-0' : 'opacity-100', scrolled ? 'bg-slate-900' : 'bg-white']" class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
          <span :class="[open ? '-translate-y-[7px] -rotate-45' : '', scrolled ? 'bg-slate-900' : 'bg-white']" class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
        </button>
      </div>
    </div>
  </div>
  <div x-show="open" x-cloak
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       class="bg-[rgba(12,20,38,0.98)] backdrop-blur-2xl px-6 pb-8 border-b border-white/10">
    @foreach([
      ['/photovoltaicSystems','Fotovoltika'],
      ['/kamery','Kamerové systémy'],
      ['/alarmy','Alarmové systémy'],
      ['/inspection','Revízie elektroinštalácií'],
      ['/rekuperacie','Rekuperácie'],
    ] as [$url,$label])
    <a href="{{ $url }}" class="flex items-center gap-3 text-white/80 text-[1.05rem] font-medium py-3.5 px-4 rounded-xl hover:text-white hover:bg-white/8 border-b border-white/6 transition-all">{{ $label }}</a>
    @endforeach
    <a href="/kontakt" class="flex justify-center mt-5 w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] transition-all">Kontaktujte nás</a>
  </div>
</nav>

{{-- ====== PAGE HERO ====== --}}
<section class="pt-[72px] bg-[#0f172a] relative overflow-hidden">
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:64px 64px"></div>
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(217,119,6,.18) 0%,transparent 65%)"></div>
  <div class="max-w-[1200px] mx-auto px-6 py-16 relative z-10">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="text-white/80">Fotovoltika</span>
    </div>
    <div class="inline-flex items-center gap-2 bg-amber-600/20 text-amber-300 text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-amber-500/30 mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/></svg>
      Obnoviteľná energia
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Fotovoltické systémy<br>pre váš dom aj firmu
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Využite silu slnka s našimi modernými riešeniami. Kompletná realizácia od konzultácie až po inštaláciu a servis.
    </p>
  </div>
</section>

{{-- ====== INTRO ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-16 items-center">

      <div class="fade-up">
        <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-5">Prečo fotovoltika?</span>
        <h2 class="text-slate-900 font-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.25rem)">Investícia, ktorá sa vráti</h2>
        <p class="text-slate-500 text-[1.05rem] leading-[1.75] mb-6">
          Fotovoltické systémy prinášajú výrazné dlhodobé úspory vďaka zníženiu alebo eliminácii účtov za elektrinu. Sú veľmi spoľahlivé, vyžadujú minimálnu údržbu a zároveň prispievajú k ochrane životného prostredia znížením emisií CO₂.
        </p>
        <ul class="flex flex-col gap-3">
          @foreach([
            'Výrazné zníženie nákladov na elektrickú energiu',
            'Ekologickejšie a udržateľnejšie bývanie',
            'Minimálna údržba po inštalácii',
            'Nezávislosť od kolísania cien energií',
            'Možnosť predaja prebytočnej energie do siete',
          ] as $item)
          <li class="flex items-start gap-3">
            <span class="mt-0.5 w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
              <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <span class="text-slate-600 text-[0.95rem]">{{ $item }}</span>
          </li>
          @endforeach
        </ul>
      </div>

      <div class="fade-up flex items-center justify-center">
        <div class="w-full rounded-2xl p-12 flex flex-col items-center justify-center gap-6 text-center" style="background:linear-gradient(135deg,#fef3c7,#fde68a);min-height:360px;">
          <div class="w-24 h-24 bg-amber-600 rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/>
              <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/>
              <line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/>
              <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/>
            </svg>
          </div>
          <div>
            <div class="text-[3.5rem] font-extrabold text-slate-900 leading-none">70%</div>
            <div class="text-[1.1rem] font-semibold text-amber-800 mt-2">Priemerná úspora na elektrine</div>
            <p class="text-amber-900/70 text-sm mt-1.5">za prvý rok prevádzky solárneho systému</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ====== TYPES ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Typy systémov</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Riešenie pre každú situáciu</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[540px] mx-auto">Ponúkame rôzne typy fotovoltických systémov prispôsobených vašim konkrétnym potrebám.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @foreach([
        ['bg-amber-50','text-amber-700','M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z M9 22V12h6v10','Systémy pre domácnosti','Ideálne riešenie pre rodinné domy. Znížte účty za elektrinu a staňte sa energeticky nezávislými.'],
        ['bg-blue-50','text-blue-700','M2 7h20v14H2z M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16','Systémy pre firmy','Pomáhame firmám znížiť prevádzkové náklady a dosiahnuť udržateľnosť podnikania.'],
        ['bg-emerald-50','text-emerald-700','M13 2 3 14 12 14 11 22 21 10 12 10 13 2','Ostrovné systémy','Vhodné pre miesta bez prístupu k elektrickej sieti – chaty, záhradné domy, vzdialené objekty.'],
      ] as [$bg,$color,$icon,$title,$desc])
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-8 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-14 h-14 rounded-xl {{ $bg }} {{ $color }} flex items-center justify-center mb-5">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            @if($title === 'Systémy pre domácnosti')
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            @elseif($title === 'Systémy pre firmy')
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
            @else
              <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
            @endif
          </svg>
        </div>
        <h3 class="text-slate-900 font-bold text-[1.05rem] mb-2.5">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== BENEFITS ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Výhody</span>
      <h2 class="text-slate-900 font-bold" style="font-size:clamp(1.5rem,3vw,2.25rem)">Prečo si vybrať náš solárny systém</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach([
        ['text-emerald-600','bg-emerald-50','M12 1v22 M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6','Úspora nákladov','Výrazné dlhodobé úspory vďaka zníženiu alebo eliminácii účtov za elektrinu.'],
        ['text-[#d42020]','bg-red-50','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z','Spoľahlivosť','Používame iba prémiové komponenty od overených výrobcov s dlhou zárukou.'],
        ['text-emerald-600','bg-emerald-50','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4','Ekologický prínos','Prispejte k ochrane životného prostredia znížením emisií CO₂ a uhlíkovej stopy.'],
        ['text-blue-600','bg-blue-50','M22 12 18 12 15 21 9 3 6 12 2 12','Monitoring v reálnom čase','Sledujte výkon vášho systému online cez mobilnú aplikáciu alebo webový portál.'],
        ['text-slate-600','bg-slate-100','M1 6h22v13H1z M1 10h22','Batériové úložiská','Uchováme prebytočnú energiu pre večerné hodiny a v prípade výpadku siete.'],
        ['text-amber-600','bg-amber-50','M12 12m-10 0a10 10 0 1 0 20 0a10 10 0 1 0-20 0 M12 6v6l4 2','Rýchla návratnosť','Investícia do fotovoltiky sa zvyčajne vráti do 6–9 rokov. Systém funguje 25+ rokov.'],
      ] as [$color,$bg,$icon,$title,$desc])
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl {{ $bg }} {{ $color }} flex items-center justify-center mb-4">
          @if($title === 'Úspora nákladov')
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          @elseif($title === 'Spoľahlivosť')
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          @elseif($title === 'Ekologický prínos')
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
          @elseif($title === 'Monitoring v reálnom čase')
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          @elseif($title === 'Batériové úložiská')
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="6" width="22" height="13" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          @else
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          @endif
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== PROCESS ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Proces inštalácie</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Bezstarostný prechod na solárnu energiu</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[500px] mx-auto">Postaráme sa o všetko od prvého hovoru až po spustenie systému.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative mb-16">
      <div class="hidden lg:block absolute top-8 left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-0.5 bg-slate-200 z-0"></div>
      @foreach([
        ['1','Konzultácia','Bezplatná obhliadka, posúdenie energetických potrieb a strechy objektu.'],
        ['2','Návrh a plánovanie','Prispôsobený návrh systému s cieľom maximalizovať efektivitu a výnos.'],
        ['3','Odborná inštalácia','Certifikovaní technici vykonajú montáž rýchlo a bez zbytočného rušenia.'],
        ['4','Servis a údržba','Pravidelná údržba a technická podpora pre optimálny dlhodobý výkon.'],
      ] as [$num,$title,$text])
      <div class="text-center relative z-10 fade-up">
        <div class="w-16 h-16 rounded-full bg-white border-[3px] border-[#d42020] shadow-[0_0_0_7px_#fef2f2] flex items-center justify-center text-[1.375rem] font-extrabold text-[#d42020] mx-auto mb-5">{{ $num }}</div>
        <h4 class="text-slate-900 font-semibold text-[0.9375rem] mb-1.5">{{ $title }}</h4>
        <p class="text-slate-500 text-[0.85rem] leading-[1.6]">{{ $text }}</p>
      </div>
      @endforeach
    </div>

    {{-- CTA Banner --}}
    <div class="rounded-2xl p-10 relative overflow-hidden fade-up" style="background:linear-gradient(135deg,#7f1d1d,#0d0404)">
      <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:44px 44px"></div>
      <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
          <h3 class="text-white font-bold text-[1.5rem] mb-1.5">Zaujíma vás fotovoltika?</h3>
          <p class="text-white/65 text-[1rem]">Kontaktujte nás a dohovorte si bezplatnú obhliadku a cenovú ponuku.</p>
        </div>
        <a href="/kontakt" class="shrink-0 inline-flex items-center gap-2 bg-white text-[#d42020] font-semibold text-[1rem] px-8 py-3.5 rounded-xl hover:bg-red-50 hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
          Získať cenovú ponuku
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ====== FOOTER ====== --}}
<footer class="bg-[#0f172a] pt-16 pb-8">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.6fr_1fr_1fr_1fr] gap-12 mb-12">
      <div>
        <a href="/" class="flex items-center gap-3 mb-4">
          <img src="{{ asset('lacomp-logo.svg') }}" alt="LACOMP" class="h-10 w-10" />
          <span class="text-[1.3rem] font-extrabold text-white tracking-tight">LA<span class="text-[#d42020]">COMP</span></span>
        </a>
        <p class="text-white/50 text-sm max-w-[252px] leading-[1.7] mb-6">Inovatívne riešenia pre inteligentnejšiu budúcnosť. Fotovoltika, kamerové systémy, alarmy a revízie elektroinštalácií.</p>
        <div class="flex gap-2.5">
          <a href="https://facebook.com/" target="_blank" rel="noopener" aria-label="Facebook" class="w-[38px] h-[38px] rounded-xl bg-white/[0.07] border border-white/10 flex items-center justify-center text-white/65 hover:bg-[#d42020] hover:border-[#d42020] hover:text-white transition-all duration-200">
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="https://www.instagram.com/la_s.r.o/" target="_blank" rel="noopener" aria-label="Instagram" class="w-[38px] h-[38px] rounded-xl bg-white/[0.07] border border-white/10 flex items-center justify-center text-white/65 hover:bg-[#d42020] hover:border-[#d42020] hover:text-white transition-all duration-200">
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Služby</h5>
        <div class="flex flex-col gap-2.5">
          <a href="/photovoltaicSystems" class="text-[#d42020] text-sm font-medium">Fotovoltika</a>
          <a href="/kamery" class="text-white/50 text-sm hover:text-white transition-colors">Kamerové systémy</a>
          <a href="/alarmy" class="text-white/50 text-sm hover:text-white transition-colors">Alarmové systémy</a>
          <a href="/inspection" class="text-white/50 text-sm hover:text-white transition-colors">Revízie elektroinštalácií</a>
          <a href="/rekuperacie" class="text-white/50 text-sm hover:text-white transition-colors">Rekuperácie</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Spoločnosť</h5>
        <div class="flex flex-col gap-2.5">
          <a href="/kontakt" class="text-white/50 text-sm hover:text-white transition-colors">Kontakt</a>
          <a href="/privacy-policy" class="text-white/50 text-sm hover:text-white transition-colors">Ochrana osobných údajov</a>
          <a href="/terms-of-service" class="text-white/50 text-sm hover:text-white transition-colors">Obchodné podmienky</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Kontakt</h5>
        <div class="flex flex-col gap-3">
          <div class="flex gap-3 items-start">
            <svg class="w-[17px] h-[17px] text-[#d42020] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-white/55 text-sm leading-[1.55]">SNP 182, Spišské Bystré<br/>059 18</span>
          </div>
          <div class="flex gap-3 items-center">
            <svg class="w-[17px] h-[17px] text-[#d42020] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 21.72 16z"/></svg>
            <a href="tel:+421903701665" class="text-white/55 text-sm hover:text-white transition-colors">+421 903 701 665</a>
          </div>
          <div class="flex gap-3 items-center">
            <svg class="w-[17px] h-[17px] text-[#d42020] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <a href="mailto:lacomp@lacomp.sk" class="text-white/55 text-sm hover:text-white transition-colors">lacomp@lacomp.sk</a>
          </div>
        </div>
      </div>
    </div>
    <hr class="border-t border-white/[0.08] mb-6" />
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
      <p class="text-[0.8375rem] text-white/40">© {{ date('Y') }} LA, spol. s.r.o. Všetky práva vyhradené.</p>
      <div class="flex gap-6 flex-wrap justify-center">
        <a href="/privacy-policy" class="text-[0.8375rem] text-white/40 hover:text-white/70 transition-colors">Ochrana osobných údajov</a>
        <a href="/terms-of-service" class="text-[0.8375rem] text-white/40 hover:text-white/70 transition-colors">Obchodné podmienky</a>
        <a href="/kontakt" class="text-[0.8375rem] text-white/40 hover:text-white/70 transition-colors">Kontakt</a>
      </div>
    </div>
  </div>
</footer>

<script>
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
</body>
</html>
