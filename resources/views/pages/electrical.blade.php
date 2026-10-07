<!doctype html>
<html lang="sk">
<head>
  @include('components.includes.google-tag')
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Elektroinštalácie – LACOMP</title>
  <meta name="description" content="Kompletná elektroinštalácia rodinného domu na kľúč – silnoprúd, slaboprúd, rozvádzače, osvetlenie a revízia. Novostavby aj rekonštrukcie." />
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
  @include('components.includes.google-tag-noscript')

{{-- ====== NAVBAR ====== --}}
@include('components.nav.nav')

{{-- ====== PAGE HERO ====== --}}
@php
  $pageGallery = \App\Models\PageGallery::forPage('elektroinstalacie');
  $gallery = collect($pageGallery?->gallery() ?? []);
  $heroUrl = $pageGallery?->heroUrl();
@endphp
<section class="bg-[#0f172a] relative overflow-hidden">
  @include('components.includes.page-hero-image')
  @include('components.includes.page-hero-style')
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:64px 64px"></div>
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,.18) 0%,transparent 65%)"></div>
  <div class="page-hero max-w-[1200px] mx-auto px-6 py-16 relative z-10 flex flex-col justify-center">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="text-white/80">Elektroinštalácie</span>
    </div>
    <div class="inline-flex items-center gap-2 bg-blue-900/30 text-blue-300 text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-blue-500/30 mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      Silnoprúd a slaboprúd
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Elektroinštalácia<br>celého domu na kľúč
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Od návrhu rozvodov cez montáž až po revíziu – postaráme sa o kompletnú elektroinštaláciu novostavby aj rekonštrukcie. Silnoprúd, slaboprúd aj príprava na smart domácnosť od jednej firmy.
    </p>
  </div>
</section>

{{-- ====== INTRO ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-16 items-center">

      <div class="fade-up">
        <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-5">Prečo s nami?</span>
        <h2 class="text-slate-900 font-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.25rem)">Celá elektrina domu z jednej ruky</h2>
        <p class="text-slate-500 text-[1.05rem] leading-[1.75] mb-6">
          Nemusíte koordinovať elektrikára, technika na dátovú sieť a revízneho technika zvlášť. Silnoprúdové aj slaboprúdové rozvody navrhneme spolu tak, aby boli prehľadné, bezpečné a pripravené aj na to, čo do domu pridáte neskôr.
        </p>
        <ul class="flex flex-col gap-3">
          @foreach([
            'Návrh rozvodov podľa dispozície a vášho zariadenia',
            'Silnoprúd aj slaboprúd naraz – bez zbytočného sekania navyše',
            'Domový rozvádzač zostavený a označený na mieru',
            'Príprava na fotovoltiku, tepelné čerpadlo či nabíjačku auta',
            'Revízna správa po dokončení prác',
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
        <div class="w-full rounded-2xl p-12 flex flex-col items-center justify-center gap-6 text-center" style="background:linear-gradient(135deg,#fefce8,#fde68a);min-height:360px;">
          <div class="w-24 h-24 bg-[#d42020] rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          </div>
          <div>
            <div class="text-[3.5rem] font-extrabold text-slate-900 leading-none">Na kľúč</div>
            <div class="text-[1.1rem] font-semibold text-[#d42020] mt-2">Od návrhu po revíziu</div>
            <p class="text-[#92400e]/70 text-sm mt-1.5">Jedna firma, jeden termín, jedna zodpovednosť</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ====== GALLERY ====== --}}
@include('components.includes.page-gallery', ['title' => 'Galéria elektroinštalácií', 'alt' => 'Realizácia elektroinštalácie'])

{{-- ====== TYPES ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Čo robíme</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Silnoprúd, slaboprúd aj rekonštrukcie</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[540px] mx-auto">Rodinné domy, byty aj menšie prevádzky – novostavby aj staré rozvody, ktoré potrebujú výmenu.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @foreach([
        ['bg-amber-50 text-amber-600', '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>', 'Silnoprúd', [
          'Zásuvkové a svetelné okruhy',
          'Rozvádzač s ističmi a prúdovými chráničmi',
          'Prívody pre sporák, bojler či tepelné čerpadlo',
          'Vonkajšie zásuvky a osvetlenie pozemku',
        ]],
        ['bg-blue-50 text-blue-700', '<path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>', 'Slaboprúd', [
          'Dátová sieť a pokrytie Wi-Fi',
          'TV a satelitné rozvody',
          'Zvonček, domáci telefón, videovrátnik',
          'Kabeláž pre kamery a alarm',
        ]],
        ['bg-red-50 text-[#d42020]', '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>', 'Rekonštrukcie a opravy', [
          'Výmena starých hliníkových rozvodov za medené',
          'Modernizácia starého rozvádzača',
          'Rozšírenie okruhov pri prestavbe',
          'Hľadanie a odstraňovanie porúch',
        ]],
      ] as [$color, $icon, $title, $items])
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-8 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-14 h-14 rounded-xl {{ $color }} flex items-center justify-center mb-5">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
        </div>
        <h3 class="text-slate-900 font-bold text-[1.05rem] mb-3">{{ $title }}</h3>
        <ul class="flex flex-col gap-2">
          @foreach($items as $item)
          <li class="flex items-start gap-2 text-slate-500 text-sm leading-[1.6]">
            <span class="mt-[0.45rem] w-1.5 h-1.5 rounded-full bg-[#d42020] shrink-0"></span>{{ $item }}
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== FEATURES ====== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Kompletné služby</span>
      <h2 class="text-slate-900 font-bold" style="font-size:clamp(1.5rem,3vw,2.25rem)">Všetko, čo k elektroinštalácii patrí</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach([
        ['bg-slate-100 text-slate-700', '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>', 'Návrh rozvodov', 'Rozmiestnenie zásuviek, vypínačov a svetiel naplánujeme podľa dispozície a toho, kde bude nábytok a spotrebiče.'],
        ['bg-slate-800 text-white', '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="8" y1="8" x2="8" y2="16"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="16" y1="8" x2="16" y2="16"/>', 'Domové rozvádzače', 'Zostavenie, zapojenie a prehľadné označenie rozvádzača vrátane prepäťových ochrán a prúdových chráničov.'],
        ['bg-amber-50 text-amber-600', '<path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.74V17h8v-2.26A7 7 0 0 0 12 2z"/>', 'Osvetlenie', 'Montáž svietidiel v interiéri aj exteriéri, LED pásy, schodiskové a pohybové osvetlenie.'],
        ['bg-red-50 text-[#d42020]', '<rect x="2" y="4" width="20" height="16" rx="2"/><circle cx="8" cy="12" r="2"/><circle cx="16" cy="12" r="2"/>', 'Pripojenie spotrebičov', 'Indukčné varné dosky, rúry, bojlery, klimatizácie a tepelné čerpadlá zapojíme odborne a bezpečne.'],
        ['bg-sky-50 text-sky-700', '<path d="M12 2v8"/><path d="M5 10h14"/><path d="M7 14h10"/><path d="M9.5 18h5"/><path d="M11.5 22h1"/>', 'Uzemnenie a hromozvod', 'Uzemňovacia sústava a ochrana pred bleskom, ktorá chráni dom aj elektroniku v ňom.'],
        ['bg-emerald-50 text-emerald-700', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/>', 'Revízia a odovzdanie', 'Po dokončení vykonáme revíziu elektroinštalácie a odovzdáme vám revíznu správu potrebnú ku kolaudácii.'],
      ] as [$color, $icon, $title, $text])
      <div class="feat-card bg-white border border-slate-200 rounded-2xl p-7 hover:border-red-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up">
        <div class="w-12 h-12 rounded-xl {{ $color }} flex items-center justify-center mb-4">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
        </div>
        <h3 class="text-slate-900 font-semibold text-[0.975rem] mb-2">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-[1.7]">{{ $text }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ====== PROCESS ====== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Ako postupujeme</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">Od obhliadky po zapnutý istič</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative mb-16">
      <div class="hidden lg:block absolute top-8 left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-0.5 bg-slate-200 z-0"></div>
      @foreach([
        ['1','Obhliadka a návrh','Prejdeme si dom alebo projekt, vaše požiadavky a navrhneme rozmiestnenie rozvodov.'],
        ['2','Cenová ponuka','Pripravíme prehľadnú ponuku s rozpisom materiálu a prác, bez skrytých položiek.'],
        ['3','Hrubá montáž a kompletácia','Rozvody a krabice pred omietkou, po omietkach zásuvky, vypínače, svietidlá a rozvádzač.'],
        ['4','Revízia a odovzdanie','Všetko premeriame, vystavíme revíznu správu a vysvetlíme vám, čo je v rozvádzači.'],
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
          <h3 class="text-white font-bold text-[1.5rem] mb-1.5">Staviate alebo rekonštruujete?</h3>
          <p class="text-white/65 text-[1rem]">Ozvite sa nám včas – elektroinštaláciu je najlepšie naplánovať ešte pred omietkami.</p>
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
          <img src="{{ asset('biele-logo.svg') }}" alt="LACOMP" class="h-10 w-10" />
          <span class="text-[1.3rem] font-extrabold text-white tracking-tight">LA<span class="text-[#d42020]">COMP</span></span>
        </a>
        <p class="text-white/50 text-sm max-w-[252px] leading-[1.7] mb-6">Elektroinštalácie a elektroslužby pre váš domov. Fotovoltika, kamerové systémy, alarmy a revízie elektroinštalácií.</p>
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
          <a href="/elektroinstalacie" class="text-[#d42020] text-sm font-medium">Elektroinštalácie</a>
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
@include('components.includes.mobile-swiper')
</body>
</html>
