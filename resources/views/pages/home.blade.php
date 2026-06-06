<!doctype html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LACOMP – Inovatívne riešenia pre inteligentnejšiu budúcnosť</title>
  <meta name="description" content="LACOMP – špecializujeme sa na fotovoltiku, kamerové systémy, alarmy a revízie elektroinštalácií pre domácnosti aj firmy na Slovensku." />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', -apple-system, sans-serif; }
    .hero-gradient-text {
      background: linear-gradient(135deg, #fca5a5, #fbbf24);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .hero-grid-bg {
      background-image:
        linear-gradient(rgba(255,255,255,.022) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.022) 1px, transparent 1px);
      background-size: 64px 64px;
    }
    @keyframes blink {
      0%,100% { opacity:1; transform:scale(1); }
      50%      { opacity:.6; transform:scale(1.4); }
    }
    .badge-dot { animation: blink 2s ease-in-out infinite; }
    .fade-up { opacity:0; transform:translateY(24px); transition:opacity .6s ease,transform .6s ease; }
    .fade-up.visible { opacity:1; transform:translateY(0); }
    .svc-card { position:relative; overflow:hidden; }
    .svc-card::after {
      content:''; position:absolute; bottom:0; left:0; right:0; height:3px;
      background:#d42020; transform:scaleX(0); transform-origin:left;
      transition:transform .38s ease;
    }
    .svc-card:hover::after { transform:scaleX(1); }
    .gallery-item img { transition:transform .5s ease; }
    .gallery-item:hover img { transform:scale(1.06); }
  </style>
</head>
<body class="bg-slate-50 antialiased">

{{-- ====== NAVBAR ====== --}}
<nav x-data="{ scrolled: false, open: false }"
     @scroll.window="scrolled = window.scrollY > 20"
     :class="scrolled ? 'bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-md' : 'border-b border-transparent'"
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
           class="text-[0.9125rem] font-medium px-3 py-2 rounded-lg transition-all duration-200 whitespace-nowrap">{{ $label }}</a>
        @endforeach
      </div>

      <div class="flex items-center gap-3">
        <a href="/kontakt"
           class="hidden lg:inline-flex items-center gap-2 text-sm font-semibold text-white bg-[#d42020] border-2 border-[#d42020] px-5 py-2 rounded-xl hover:bg-[#b31c1c] hover:border-[#b31c1c] hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(212,32,32,0.4)] transition-all duration-200">Kontakt</a>
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
      ['/photovoltaicSystems','Fotovoltika','M12,12 m-4,0 a4,4 0 1,0 8,0 a4,4 0 1,0 -8,0 M12 2v4 M12 18v4 M4.93 4.93l2.83 2.83 M16.24 16.24l2.83 2.83 M2 12h4 M18 12h4 M4.93 19.07l2.83-2.83 M16.24 7.76l2.83-2.83'],
      ['/kamery','Kamerové systémy','M23 7l-7 5 7 5V7z M1 5h15a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H1z'],
      ['/alarmy','Alarmové systémy','M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9 M13.73 21a2 2 0 0 1-3.46 0'],
      ['/inspection','Revízie elektroinštalácií','M13 2 3 14 12 14 11 22 21 10 12 10 13 2'],
      ['/rekuperacie','Rekuperácie','M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2'],
    ] as [$url,$label])
    <a href="{{ $url }}" class="flex items-center gap-3 text-white/80 text-[1.05rem] font-medium py-3.5 px-4 rounded-xl hover:text-white hover:bg-white/8 border-b border-white/6 transition-all">{{ $label }}</a>
    @endforeach
    <a href="/kontakt" class="flex justify-center mt-5 w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] transition-all">Kontaktujte nás</a>
  </div>
</nav>

{{-- ====== HERO ====== --}}
<section class="min-h-screen pt-[72px] relative overflow-hidden flex items-center" style="background: linear-gradient(135deg, #0d0404 0%, #200808 45%, #7a1010 100%);">
  <div class="hero-grid-bg absolute inset-0 pointer-events-none"></div>
  <div class="absolute -top-1/4 -right-16 w-[700px] h-[700px] pointer-events-none" style="background:radial-gradient(circle,rgba(212,32,32,.28) 0%,transparent 65%)"></div>
  <div class="absolute -bottom-1/4 -left-16 w-[500px] h-[500px] pointer-events-none" style="background:radial-gradient(circle,rgba(16,185,129,.12) 0%,transparent 65%)"></div>

  <div class="max-w-[1200px] mx-auto px-6 relative z-10 w-full">
    <div class="grid lg:grid-cols-2 items-center gap-16 py-16 lg:py-20">

      <div>
        <div class="inline-flex items-center gap-2 bg-[rgba(212,32,32,0.2)] text-[#fca5a5] text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-[rgba(252,165,165,0.3)] mb-6">
          <span class="badge-dot w-2 h-2 bg-emerald-400 rounded-full"></span>
          LA, spol. s.r.o. · Spišské Bystré
        </div>

        <h1 class="text-white font-extrabold leading-[1.08] mb-5" style="font-size:clamp(2.2rem,5vw,3.75rem);letter-spacing:-0.035em;">
          Inovatívne riešenia pre
          <span class="hero-gradient-text">inteligentnejšiu</span> budúcnosť
        </h1>

        <p class="text-white/70 text-lg leading-[1.72] mb-9 max-w-[520px]">
          Špecializujeme sa na fotovoltiku, kamerové systémy, alarmy a revízie elektroinštalácií pre vašu domácnosť aj firmu. Kvalita overená praxou.
        </p>

        <div class="flex gap-4 flex-wrap mb-14">
          <a href="/kontakt" class="inline-flex items-center gap-2 text-white bg-[#d42020] border-2 border-[#d42020] text-[1.0625rem] font-semibold px-9 py-3.5 rounded-xl hover:bg-[#b31c1c] hover:border-[#b31c1c] hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(212,32,32,0.4)] transition-all duration-200">
            <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 21.72 16z"/></svg>
            Nezáväzná konzultácia
          </a>
          <a href="#services" class="inline-flex items-center gap-2 text-white bg-white/10 border-2 border-white/30 text-[1.0625rem] font-semibold px-9 py-3.5 rounded-xl hover:bg-white/20 hover:border-white/50 hover:-translate-y-0.5 transition-all duration-200 backdrop-blur-sm">
            Naše služby
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
          </a>
        </div>

        <div class="flex gap-10 flex-wrap">
          <div><div class="text-[1.875rem] font-extrabold text-white leading-none">300</div><div class="text-[0.775rem] text-white/50 mt-1">Spokojných zákazníkov</div></div>
          <div><div class="text-[1.875rem] font-extrabold text-white leading-none">15</div><div class="text-[0.775rem] text-white/50 mt-1">Rokov skúseností</div></div>
          <div><div class="text-[1.875rem] font-extrabold text-white leading-none">300</div><div class="text-[0.775rem] text-white/50 mt-1">Dokončených projektov</div></div>
        </div>
      </div>

      <div class="hidden lg:grid grid-cols-2 gap-4 max-w-[420px] ml-auto">
        <a href="/photovoltaicSystems" class="bg-white/[0.07] border border-white/10 rounded-2xl p-5 backdrop-blur-xl hover:bg-white/[0.13] hover:border-white/20 hover:-translate-y-1 transition-all duration-300 block">
          <div class="w-11 h-11 rounded-[10px] bg-amber-600 flex items-center justify-center mb-3">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg>
          </div>
          <h4 class="text-white text-[0.895rem] font-semibold mb-1">Fotovoltika</h4>
          <p class="text-white/50 text-[0.78rem] leading-[1.45]">Solárne panely pre dom aj firmu</p>
        </a>
        <a href="/kamery" class="bg-white/[0.07] border border-white/10 rounded-2xl p-5 backdrop-blur-xl hover:bg-white/[0.13] hover:border-white/20 hover:-translate-y-1 transition-all duration-300 block">
          <div class="w-11 h-11 rounded-[10px] bg-[#d42020] flex items-center justify-center mb-3">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
          </div>
          <h4 class="text-white text-[0.895rem] font-semibold mb-1">Kamerové systémy</h4>
          <p class="text-white/50 text-[0.78rem] leading-[1.45]">Vzdialený dohľad odkiaľkoľvek</p>
        </a>
        <a href="/alarmy" class="bg-white/[0.07] border border-white/10 rounded-2xl p-5 backdrop-blur-xl hover:bg-white/[0.13] hover:border-white/20 hover:-translate-y-1 transition-all duration-300 block">
          <div class="w-11 h-11 rounded-[10px] bg-red-600 flex items-center justify-center mb-3">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          </div>
          <h4 class="text-white text-[0.895rem] font-semibold mb-1">Alarmové systémy</h4>
          <p class="text-white/50 text-[0.78rem] leading-[1.45]">Ochrana majetku 24/7</p>
        </a>
        <a href="/inspection" class="bg-white/[0.07] border border-white/10 rounded-2xl p-5 backdrop-blur-xl hover:bg-white/[0.13] hover:border-white/20 hover:-translate-y-1 transition-all duration-300 block">
          <div class="w-11 h-11 rounded-[10px] bg-emerald-600 flex items-center justify-center mb-3">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          </div>
          <h4 class="text-white text-[0.895rem] font-semibold mb-1">Revízie elektriky</h4>
          <p class="text-white/50 text-[0.78rem] leading-[1.45]">Certifikované odborné revízie</p>
        </a>
        <a href="/rekuperacie" class="col-span-2 bg-white/[0.07] border border-white/10 rounded-2xl p-5 backdrop-blur-xl hover:bg-white/[0.13] hover:border-white/20 hover:-translate-y-1 transition-all duration-300 block">
          <div class="w-11 h-11 rounded-[10px] bg-violet-700 flex items-center justify-center mb-3">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/></svg>
          </div>
          <h4 class="text-white text-[0.895rem] font-semibold mb-1">Rekuperácie</h4>
          <p class="text-white/50 text-[0.78rem] leading-[1.45]">Čistý vzduch, žiadne tepelné straty – systém RECUAIR s 5-ročnou zárukou</p>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ====== STATS STRIP ====== --}}
<section class="bg-[#0f172a] py-14 border-t border-white/[0.06]">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
      <div class="relative sm:after:content-[''] sm:after:absolute sm:after:top-1/2 sm:after:-translate-y-1/2 sm:after:right-0 sm:after:w-px sm:after:h-3/5 sm:after:bg-white/10">
        <div class="text-[2.75rem] font-extrabold text-white leading-none">150<span class="text-[#d42020]">+</span></div>
        <div class="text-sm text-white/50 mt-1.5">Spokojných zákazníkov</div>
      </div>
      <div class="relative sm:after:content-[''] sm:after:absolute sm:after:top-1/2 sm:after:-translate-y-1/2 sm:after:right-0 sm:after:w-px sm:after:h-3/5 sm:after:bg-white/10">
        <div class="text-[2.75rem] font-extrabold text-white leading-none">15<span class="text-[#d42020]">+</span></div>
        <div class="text-sm text-white/50 mt-1.5">Rokov skúseností</div>
      </div>
      <div>
        <div class="text-[2.75rem] font-extrabold text-white leading-none">300<span class="text-[#d42020]">+</span></div>
        <div class="text-sm text-white/50 mt-1.5">Dokončených projektov</div>
      </div>
    </div>
  </div>
</section>

{{-- ====== SERVICES ====== --}}
<section class="bg-white py-20" id="services">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Naše služby</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.6rem,3.5vw,2.5rem)">Komplexné riešenia pre váš dom aj firmu</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[600px] mx-auto">Od obnoviteľných zdrojov energie až po bezpečnostné systémy – pokrývame všetky vaše potreby.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5">
      <a href="/photovoltaicSystems" class="svc-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 block fade-up">
        <div class="w-[54px] h-[54px] rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-5">
          <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold mb-2.5 text-[1.025rem]">Fotovoltika</h3>
        <p class="text-slate-500 text-sm leading-[1.65] mb-5">Využite silu slnka s našimi efektívnymi solárnymi riešeniami pre domácnosti aj komerčné objekty.</p>
        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#d42020]">Zistiť viac <svg class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </a>
      <a href="/kamery" class="svc-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 block fade-up">
        <div class="w-[54px] h-[54px] rounded-xl bg-red-50 text-[#d42020] flex items-center justify-center mb-5">
          <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold mb-2.5 text-[1.025rem]">Kamerové systémy</h3>
        <p class="text-slate-500 text-sm leading-[1.65] mb-5">Zvýšte bezpečnosť pomocou moderných kamier s nočným videním, vzdialeným prístupom a cloudovým úložiskom.</p>
        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#d42020]">Zistiť viac <svg class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </a>
      <a href="/alarmy" class="svc-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 block fade-up">
        <div class="w-[54px] h-[54px] rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-5">
          <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold mb-2.5 text-[1.025rem]">Alarmové systémy</h3>
        <p class="text-slate-500 text-sm leading-[1.65] mb-5">Chráňte svoj majetok spoľahlivými alarmovými systémami s ovládaním cez smartfón a záložným napájaním.</p>
        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#d42020]">Zistiť viac <svg class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </a>
      <a href="/inspection" class="svc-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 block fade-up">
        <div class="w-[54px] h-[54px] rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-5">
          <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold mb-2.5 text-[1.025rem]">Revízie elektroinštalácií</h3>
        <p class="text-slate-500 text-sm leading-[1.65] mb-5">Zabezpečte bezpečnosť vďaka dôkladným revíziám elektroinštalácií vykonávaným certifikovanými technikmi.</p>
        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#d42020]">Zistiť viac <svg class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </a>
      <a href="/rekuperacie" class="svc-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 block fade-up">
        <div class="w-[54px] h-[54px] rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center mb-5">
          <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/></svg>
        </div>
        <h3 class="text-slate-900 font-bold mb-2.5 text-[1.025rem]">Rekuperácie</h3>
        <p class="text-slate-500 text-sm leading-[1.65] mb-5">Zabezpečte čerstvý vzduch bez tepelných strát pomocou moderného systému RECUAIR s 5-ročnou zárukou.</p>
        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#d42020]">Zistiť viac <svg class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </a>
    </div>
  </div>
</section>

{{-- ====== WHY ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-20 items-center">
      <div>
        <div class="mb-10 fade-up">
          <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Prečo my?</span>
          <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.6rem,3.5vw,2.5rem)">Odbornosť, na ktorú sa môžete spoľahnúť</h2>
          <p class="text-slate-500 text-[1.05rem]">Každý projekt realizujeme s maximálnym nasadením, kvalitou a profesionalitou.</p>
        </div>
        <div class="flex flex-col gap-6">
          @foreach([
            ['M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z','Certifikovaní technici','Naši pracovníci sú plne certifikovaní a pravidelne sa vzdelávajú v najnovších technológiách.'],
            ['M22 12 18 12 15 21 9 3 6 12 2 12','Rýchla realizácia','Od obhliadky po inštaláciu zvyčajne trvá celý proces len niekoľko dní. Pracujeme efektívne.'],
            ['','Servis a podpora','Zabezpečujeme pravidelnú technickú údržbu a poskytujeme priebežnú zákaznícku podporu.'],
            ['','Transparentné ceny','Žiadne skryté poplatky. Cenovú ponuku dostanete vždy vopred – jasne a zrozumiteľne.'],
          ] as [$icon,$title,$text])
          <div class="flex gap-4 items-start fade-up">
            <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
              @if($title === 'Servis a podpora')
              <svg class="w-[22px] h-[22px] text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              @elseif($title === 'Transparentné ceny')
              <svg class="w-[22px] h-[22px] text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              @elseif($title === 'Rýchla realizácia')
              <svg class="w-[22px] h-[22px] text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
              @else
              <svg class="w-[22px] h-[22px] text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              @endif
            </div>
            <div>
              <h4 class="text-slate-900 font-semibold mb-1">{{ $title }}</h4>
              <p class="text-slate-500 text-sm leading-[1.65]">{{ $text }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="rounded-2xl p-12 relative overflow-hidden fade-up" style="background:linear-gradient(145deg,#0f172a,#4a0c0c)">
        <div class="absolute -top-2/5 -right-1/5 w-[400px] h-[400px] pointer-events-none" style="background:radial-gradient(circle,rgba(212,32,32,.3) 0%,transparent 65%)"></div>
        <div class="grid grid-cols-2 gap-5 relative z-10">
          @foreach([['150','+','Spokojných zákazníkov'],['300','+','Dokončených projektov'],['5','+','Rokov na trhu'],['100','%','Spokojnosť klientov']] as [$n,$s,$lbl])
          <div class="bg-white/[0.07] border border-white/10 rounded-2xl p-6 text-center">
            <div class="text-[2.375rem] font-extrabold text-white leading-none">{{ $n }}<span class="text-[#fca5a5]">{{ $s }}</span></div>
            <div class="text-[0.8rem] text-white/55 mt-1.5">{{ $lbl }}</div>
          </div>
          @endforeach
        </div>
        <div class="mt-8 pt-8 border-t border-white/10 relative z-10">
          <p class="text-white/55 text-sm leading-[1.7]">"Každý klient je pre nás prioritou. Naším cieľom je priniesť riešenia, ktoré skutočne fungujú – dlhodobo a spoľahlivo."</p>
          <div class="mt-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#d42020] flex items-center justify-center font-bold text-white text-sm">LC</div>
            <div>
              <div class="text-white font-semibold text-[0.9rem]">Tím LACOMP</div>
              <div class="text-white/45 text-[0.78rem]">Spišské Bystré, Slovensko</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ====== GALLERY ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Naše projekty</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.6rem,3.5vw,2.5rem)">Realizácie, na ktoré sme hrdí</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[600px] mx-auto">Pozrite si ukážky našich dokončených inštalácií – fotovoltika, kamery, alarmy, revízie aj rekuperácie naprieč Slovenskom.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach([
        ['https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&h=450&fit=crop&auto=format&q=80','Fotovoltika – rodinný dom'],
        ['https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&h=450&fit=crop&auto=format&q=80','Kamerový systém – komerčná budova'],
        ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=450&fit=crop&auto=format&q=80','Alarmový systém – rodinný dom'],
        ['https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=600&h=450&fit=crop&auto=format&q=80','Revízia elektroinštalácie'],
        ['https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600&h=450&fit=crop&auto=format&q=80','Rekuperácia – bytový dom'],
        ['https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&h=450&fit=crop&auto=format&q=80','Profesionálna inštalácia v teréne'],
      ] as [$src,$lbl])
      <div class="gallery-item rounded-xl overflow-hidden relative aspect-[4/3] shadow-md hover:-translate-y-1 hover:shadow-xl transition-all duration-300 fade-up">
        <img src="{{ $src }}" alt="{{ $lbl }}" loading="lazy" class="w-full h-full object-cover" />
        <div class="absolute bottom-0 left-0 right-0 px-4 py-3 text-white text-sm font-medium" style="background:linear-gradient(0deg,rgba(0,0,0,.72) 0%,transparent 100%)">{{ $lbl }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== PROCESS ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Ako to funguje</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.6rem,3.5vw,2.5rem)">Jednoduchý proces od A po Z</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[600px] mx-auto">Postaráme sa o všetko – od prvého hovoru až po dokončenú inštaláciu a servis.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
      <div class="hidden lg:block absolute top-8 left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-0.5 bg-slate-200 z-0"></div>
      @foreach([
        ['1','Konzultácia','Bezplatná obhliadka a posúdenie vašich potrieb priamo na mieste.'],
        ['2','Návrh riešenia','Pripravíme prispôsobený návrh systému s detailnou cenovou ponukou.'],
        ['3','Odborná inštalácia','Certifikovaní technici vykonajú inštaláciu rýchlo a s minimálnym rušením.'],
        ['4','Podpora a servis','Sme tu pre vás aj po dokončení – pravidelná údržba a technická podpora.'],
      ] as [$num,$title,$text])
      <div class="text-center relative z-10 fade-up">
        <div class="w-16 h-16 rounded-full bg-white border-[3px] border-[#d42020] shadow-[0_0_0_7px_#fef2f2] flex items-center justify-center text-[1.375rem] font-extrabold text-[#d42020] mx-auto mb-5">{{ $num }}</div>
        <h4 class="text-slate-900 font-semibold text-[0.9375rem] mb-1.5">{{ $title }}</h4>
        <p class="text-slate-500 text-[0.85rem] leading-[1.6]">{{ $text }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== CTA ====== --}}
<section class="py-[5.5rem] relative overflow-hidden" style="background:linear-gradient(135deg,#7f1d1d,#0d0404)">
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:44px 44px"></div>
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center relative z-10">
      <h2 class="text-white font-bold mb-4" style="font-size:clamp(1.75rem,3vw,2.5rem)">Pripravení začať?</h2>
      <p class="text-white/70 text-[1.1rem] max-w-[540px] mx-auto mb-10">Kontaktujte nás ešte dnes a získajte nezáväznú konzultáciu a cenovú ponuku zdarma.</p>
      <div class="flex gap-4 justify-center flex-wrap">
        <a href="/kontakt" class="inline-flex items-center gap-2 bg-white text-[#d42020] border-2 border-white text-[1.0625rem] font-semibold px-9 py-3.5 rounded-xl hover:bg-red-50 hover:-translate-y-0.5 transition-all duration-200">
          <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 21.72 16z"/></svg>
          +421 903 701 665
        </a>
        <a href="mailto:lacomp@lacomp.sk" class="inline-flex items-center gap-2 bg-white/10 text-white border-2 border-white/30 text-[1.0625rem] font-semibold px-9 py-3.5 rounded-xl hover:bg-white/20 hover:border-white/50 hover:-translate-y-0.5 transition-all duration-200 backdrop-blur-sm">
          <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          lacomp@lacomp.sk
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
        <a href="/" class="flex items-center gap-3 text-[1.45rem] font-extrabold tracking-tight text-white mb-4">
          <span class="w-[38px] h-[38px] bg-[#d42020] rounded-[9px] flex items-center justify-center shrink-0">
            <svg class="w-[22px] h-[22px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          </span>
          LA<span class="text-[#d42020]">COMP</span>
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
          <a href="/kamery" class="text-white/50 text-sm hover:text-white transition-colors">Kamerové systémy</a>
          <a href="/alarmy" class="text-white/50 text-sm hover:text-white transition-colors">Alarmové systémy</a>
          <a href="/inspection" class="text-white/50 text-sm hover:text-white transition-colors">Revízie elektroinštalácií</a>
          <a href="/rekuperacie" class="text-white/50 text-sm hover:text-white transition-colors">Rekuperácie</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Spoločnosť</h5>
        <div class="flex flex-col gap-2.5">
          <a href="/kontakt" class="text-white/50 text-sm hover:text-white transition-colors">O nás</a>
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
