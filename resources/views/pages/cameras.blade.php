<!doctype html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kamerové systémy – LACOMP</title>
  <meta name="description" content="Moderné kamerové systémy pre domácnosti a firmy. Nočné videnie, vzdialený prístup, cloudové úložisko. Odborná inštalácia." />
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
          ['/admin','Meranie spotreby'],
        ] as [$url,$label])
        <a href="{{ $url }}"
           :class="scrolled ? 'text-slate-600 hover:text-[#d42020] hover:bg-red-50' : 'text-white/85 hover:text-white hover:bg-white/10'"
           class="text-[0.9125rem] font-medium px-3 py-2 rounded-lg transition-all duration-200 whitespace-nowrap">{{ $label }}</a>
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
      ['/admin','Meranie spotreby'],
    ] as [$url,$label])
    <a href="{{ $url }}" class="flex items-center gap-3 text-white/80 text-[1.05rem] font-medium py-3.5 px-4 rounded-xl hover:text-white hover:bg-white/8 border-b border-white/6 transition-all">{{ $label }}</a>
    @endforeach
    <a href="/kontakt" class="flex justify-center mt-5 w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] transition-all">Kontaktujte nás</a>
  </div>
</nav>

{{-- ====== PAGE HERO ====== --}}
<section class="pt-[72px] bg-[#0f172a] relative overflow-hidden">
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:64px 64px"></div>
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(212,32,32,.2) 0%,transparent 65%)"></div>
  <div class="max-w-[1200px] mx-auto px-6 py-16 relative z-10">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="text-white/80">Kamerové systémy</span>
    </div>
    <div class="inline-flex items-center gap-2 bg-[rgba(212,32,32,0.2)] text-[#fca5a5] text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-[rgba(252,165,165,0.3)] mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
      Bezpečnostné systémy
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Kamerové systémy<br>pre spoľahlivý dohľad
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Od domácností po firemné areály – inštalujeme moderné kamerové systémy s diaľkovým prístupom, nočným videním a cloudovým úložiskom.
    </p>
  </div>
</section>

{{-- ====== INTRO ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-16 items-center">

      <div class="fade-up">
        <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-5">Prečo kamerový systém?</span>
        <h2 class="text-slate-900 font-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.25rem)">Sledujte svoj majetok odkiaľkoľvek</h2>
        <p class="text-slate-500 text-[1.05rem] leading-[1.75] mb-6">
          Moderné kamerové systémy vám umožnia sledovať váš dom alebo firmu 24 hodín denne, 7 dní v týždni – priamo z vášho smartfónu alebo počítača, kdekoľvek na svete.
        </p>
        <ul class="flex flex-col gap-3">
          @foreach([
            'Vzdialený prístup cez mobilnú aplikáciu',
            'Ukladanie záznamu do cloudu alebo na lokálny zásobník',
            'Automatické upozornenia pri detekcii pohybu',
            'Odstrašujúci efekt pre potenciálnych narušiteľov',
            'Videoarchív pre prípad právnych incidentov',
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
        <div class="w-full rounded-2xl p-12 flex flex-col items-center justify-center gap-6 text-center" style="background:linear-gradient(135deg,#fef2f2,#fecaca);min-height:360px;">
          <div class="w-24 h-24 bg-[#d42020] rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M23 7l-7 5 7 5V7z"/>
              <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
            </svg>
          </div>
          <div>
            <div class="text-[3.5rem] font-extrabold text-slate-900 leading-none">4K</div>
            <div class="text-[1.1rem] font-semibold text-[#d42020] mt-2">Ultra HD rozlíšenie</div>
            <p class="text-[#b31c1c]/70 text-sm mt-1.5">Ostré záznamy pre bezpečnú identifikáciu</p>
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
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Typy kamier</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Kamera pre každé miesto</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[540px] mx-auto">Vyberieme vám optimálne riešenie podľa vašich priestorov a bezpečnostných potrieb.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-8 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center mb-5">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold text-[1.05rem] mb-2.5">Dome kamery</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Ideálne na nenápadné vnútorné sledovanie. Diskrétny vzhľad, pritom výborný záber.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-8 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-14 h-14 rounded-xl bg-red-50 text-[#d42020] flex items-center justify-center mb-5">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold text-[1.05rem] mb-2.5">Bullet kamery</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Odolné voči poveternostným podmienkam. Vhodné na vonkajšie použitie a väčšie vzdialenosti.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-8 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-14 h-14 rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center mb-5">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold text-[1.05rem] mb-2.5">PTZ kamery</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Otáčanie, nakláňanie a priblíženie pre maximálne pokrytie veľkých priestorov a areálov.</p>
      </div>
    </div>
  </div>
</section>

{{-- ====== FEATURES ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Kľúčové vlastnosti</span>
      <h2 class="text-slate-900 font-bold" style="font-size:clamp(1.5rem,3vw,2.25rem)">Naše kamerové systémy v číslach</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Vysoké rozlíšenie obrazu</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">FullHD a 4K záznamy zaručujú ostrý obraz pre spoľahlivú identifikáciu.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-slate-800 text-white flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Nočné videnie</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Infračervené LED diódy umožňujú jasný záznam aj v úplnej tme.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-red-50 text-[#d42020] flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Detekcia pohybu</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Inteligentná detekcia pohybu s okamžitým upozornením na váš telefón.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1.05 12H7L9.5 19.5l4-15 2.5 7.5h5.95"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Vzdialený prístup</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Živý prenos a záznamy dostupné odkiaľkoľvek cez smartfón alebo tablet.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Cloudové úložisko</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">Záznamy sú bezpečne uložené v cloude alebo lokálne. Vy si vyberiete.</p>
      </div>
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">Odolnosť voči počasiu</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">IP65+ krytie zaručuje funkčnosť vonkajších kamier za každého počasia.</p>
      </div>
    </div>
  </div>
</section>

{{-- ====== PROCESS ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Inštalácia a podpora</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Postup pri inštalácii kamerového systému</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative mb-16">
      <div class="hidden lg:block absolute top-8 left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-0.5 bg-slate-200 z-0"></div>
      @foreach([
        ['1','Analýza priestoru','Obhliadka objektu a návrh rozmiestnenia kamier pre maximálne pokrytie.'],
        ['2','Výber systému','Odporučíme vhodné typy kamier a rekordér podľa vašich požiadaviek a rozpočtu.'],
        ['3','Profesionálna montáž','Inštalácia kamier, kabeláže a rekordéra skúsenými technikmi s minimálnym rušením.'],
        ['4','Nastavenie a školenie','Nakonfigurujeme vzdialený prístup a zaškolíme vás na obsluhu systému.'],
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
          <h3 class="text-white font-bold text-[1.5rem] mb-1.5">Záujem o kamerový systém?</h3>
          <p class="text-white/65 text-[1rem]">Zavolajte nám alebo pošlite správu – radi navrhneme riešenie pre vás.</p>
        </div>
        <a href="/kontakt" class="shrink-0 inline-flex items-center gap-2 bg-white text-[#d42020] font-semibold text-[1rem] px-8 py-3.5 rounded-xl hover:bg-red-50 hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
          Nezáväzná ponuka
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
          <a href="/photovoltaicSystems" class="text-white/50 text-sm hover:text-white transition-colors">Fotovoltika</a>
          <a href="/kamery" class="text-[#d42020] text-sm font-medium">Kamerové systémy</a>
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
