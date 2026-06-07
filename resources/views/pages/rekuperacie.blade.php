<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekuperácie – LACOMP</title>
  <meta name="description" content="Ventilačné systémy s rekuperáciou tepla RECUAIR pre zdravé ovzdušie bez tepelných strát. DC 40 HRV od 1 190 € a DC 40 ERV od 1 290 €.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body { font-family: 'Inter', -apple-system, sans-serif; }
    .fade-up { opacity:0; transform:translateY(24px); transition:opacity .6s ease,transform .6s ease; }
    .fade-up.visible { opacity:1; transform:translateY(0); }
  </style>
</head>
<body class="bg-slate-50 antialiased">

{{-- ===================== NAVBAR ===================== --}}
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
        <a href="/kontakt"
           class="hidden lg:inline-flex items-center gap-2 text-sm font-semibold text-white bg-[#d42020] border-2 border-[#d42020] px-5 py-2 rounded-xl hover:bg-[#b31c1c] hover:border-[#b31c1c] hover:-translate-y-0.5 transition-all duration-200">
          Kontakt
        </a>
        <button @click="open = !open"
                class="lg:hidden flex flex-col gap-[5px] p-1 bg-transparent border-none cursor-pointer"
                aria-label="Menu">
          <span :class="[open ? 'translate-y-[7px] rotate-45' : '', scrolled ? 'bg-slate-900' : 'bg-white']"
                class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
          <span :class="[open ? 'opacity-0' : 'opacity-100', scrolled ? 'bg-slate-900' : 'bg-white']"
                class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
          <span :class="[open ? '-translate-y-[7px] -rotate-45' : '', scrolled ? 'bg-slate-900' : 'bg-white']"
                class="block w-6 h-0.5 rounded-sm transition-all duration-200"></span>
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
    <a href="{{ $url }}"
       class="flex items-center gap-3 text-white/80 text-[1.05rem] font-medium py-3.5 px-4 rounded-xl hover:text-white hover:bg-white/8 border-b border-white/6 transition-all">
      {{ $label }}
    </a>
    @endforeach
    <a href="/kontakt"
       class="flex justify-center mt-5 w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] transition-all">
      Kontaktujte nás
    </a>
  </div>
</nav>

{{-- ===================== HERO ===================== --}}
<section class="pt-[72px] bg-[#0f172a] relative overflow-hidden">
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:64px 64px"></div>
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(124,58,237,.2) 0%,transparent 65%)"></div>
  <div class="max-w-[1200px] mx-auto px-6 py-16 relative z-10">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="text-white/80">Rekuperácie</span>
    </div>
    <div class="inline-flex items-center gap-2 bg-violet-900/30 text-violet-300 text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-violet-500/30 mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
      </svg>
      Zdravé ovzdušie
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Vetrajte bez tepelných strát<br>a zbavte sa vlhkosti
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Ventilačné systémy s rekuperáciou tepla RECUAIR zaistia nepretržitý prísun čerstvého vzduchu – bez hluku, bez zápachu, bez alergénov a so zárukou 5 rokov.
    </p>
  </div>
</section>

{{-- ===================== INTRO ===================== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div class="fade-up">
        <span class="inline-flex bg-violet-50 text-violet-700 text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-5">Prečo rekuperácia?</span>
        <h2 class="text-slate-900 font-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.25rem)">Zdravý vzduch bez zbytočných tepelných strát</h2>
        <p class="text-slate-500 text-[1.05rem] leading-[1.75] mb-6">
          Moderné budovy sú dobre utesnené, čo je výhodné z hľadiska izolácie, no bez správneho vetrania vedie k hromadeniu CO₂, vlhkosti a alergénov. Rekuperačné jednotky RECUAIR riešia oba problémy – vymenia vzduch a zároveň vrátia až 94 % tepla späť do miestnosti.
        </p>
        <ul class="flex flex-col gap-3">
          @foreach([
            'Automatické vetranie bez otvárania okien',
            'Blokuje prach, alergény, hmyz a hluk z vonku',
            'Odstraňuje zápach a kontroluje vlhkosť v interiéri',
            'Rekuperácia tepla – úspora na vykurovaní aj klimatizácii',
            'Ovládanie cez mobilnú aplikáciu, 5-ročná záruka',
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
        <div class="w-full rounded-2xl p-12 flex flex-col items-center justify-center gap-4 text-center" style="background:linear-gradient(135deg,#ede9fe,#f5f3ff);border:1px solid #ddd6fe;min-height:360px;">
          <svg class="w-16 h-16 text-violet-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
          </svg>
          <div class="text-[3.5rem] font-black text-violet-700 leading-none">94%</div>
          <div class="text-lg font-bold text-violet-800">rekuperácia tepla</div>
          <div class="text-sm text-violet-600 leading-relaxed">Až 94 % tepla zostane<br>v miestnosti</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== PRODUCTS ===================== --}}
<section id="produkty" class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="text-violet-700 text-sm font-bold tracking-[0.1em] uppercase mb-3 block">Naše produkty</span>
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Rekuperačné jednotky RECUAIR</h2>
      <p class="text-slate-500 max-w-xl mx-auto">Ponúkame dve varianty decentralizovaných rekuperačných jednotiek pre rôzne potreby prevádzky a vlhkosti v budove.</p>
    </div>
    <div class="grid md:grid-cols-2 gap-8 max-w-[900px] mx-auto">

      {{-- HRV --}}
      <div class="fade-up bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
        <div class="bg-gradient-to-br from-violet-700 to-violet-900 p-8 text-white text-center">
          <div class="w-16 h-16 bg-white/15 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
            </svg>
          </div>
          <h3 class="text-2xl font-extrabold mb-1">DC 40 HRV</h3>
          <p class="text-violet-200 text-sm">od <strong class="text-white text-lg">1 190 €</strong> (bez DPH)</p>
        </div>
        <div class="p-6">
          <p class="text-slate-500 text-sm leading-relaxed mb-5">
            Decentralizovaná rekuperačná jednotka s entalpickým výmenníkom. Ideálna pre štandardné obytné priestory so zvýšenou vlhkosťou.
          </p>
          <ul class="flex flex-col gap-2 mb-6">
            @foreach([
              'Rekuperácia tepla až 94 %',
              'Prietok vzduchu 15–40 m³/h',
              'Filtrácia triedy G4 (prach, peľ)',
              'Hlučnosť iba 26 dB(A)',
              'Príkon 2,3 W (nízka spotreba)',
              'Ovládanie cez Wi-Fi aplikáciu',
              'Záruka 5 rokov',
            ] as $f)
            <li class="flex items-center gap-2.5 text-sm text-slate-600">
              <svg class="w-4 h-4 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              {{ $f }}
            </li>
            @endforeach
          </ul>
          <a href="/kontakt" class="flex justify-center w-full bg-violet-700 text-white font-semibold py-3 px-6 rounded-xl hover:bg-violet-800 transition-all">
            Dopytovať HRV
          </a>
        </div>
      </div>

      {{-- ERV --}}
      <div class="fade-up bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
        <div class="p-8 text-white text-center" style="background:linear-gradient(135deg,#7f1d1d,#b31c1c)">
          <div class="w-16 h-16 bg-white/15 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
            </svg>
          </div>
          <h3 class="text-2xl font-extrabold mb-1">DC 40 ERV</h3>
          <p class="text-red-200 text-sm">od <strong class="text-white text-lg">1 290 €</strong> (bez DPH)</p>
        </div>
        <div class="p-6">
          <p class="text-slate-500 text-sm leading-relaxed mb-5">
            Vylepšená verzia s entalpickým výmenníkom – rekuperuje nielen teplo, ale aj vlhkosť. Ideálna pre suché klimatické podmienky a nízkoenergetické domy.
          </p>
          <ul class="flex flex-col gap-2 mb-6">
            @foreach([
              'Rekuperácia tepla aj vlhkosti',
              'Prietok vzduchu 15–40 m³/h',
              'Filtrácia triedy G4 (prach, peľ)',
              'Hlučnosť iba 26 dB(A)',
              'Príkon 2,3 W (nízka spotreba)',
              'Ovládanie cez Wi-Fi aplikáciu',
              'Záruka 5 rokov',
            ] as $f)
            <li class="flex items-center gap-2.5 text-sm text-slate-600">
              <svg class="w-4 h-4 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              {{ $f }}
            </li>
            @endforeach
          </ul>
          <a href="/kontakt" class="flex justify-center w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] transition-all">
            Dopytovať ERV
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ===================== FEATURES ===================== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="text-violet-700 text-sm font-bold tracking-[0.1em] uppercase mb-3 block">Výhody systému</span>
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Prečo si vybrať rekuperáciu RECUAIR?</h2>
      <p class="text-slate-500 max-w-xl mx-auto">Decentralizované jednotky RECUAIR prinesú do každej miestnosti čerstvý vzduch bez nutnosti rúrkového rozvodu.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach([
        ['Čerstvý vzduch pre zdravý spánok','Systém zabezpečuje neustály prísun čerstvého vzduchu s optimálnou koncentráciou O₂ a nízkym obsahom CO₂ – ideálne pre deti aj alergikov.','M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z M4.93 4.93l4.24 4.24 M14.83 9.17l4.24-4.24 M14.83 14.83l4.24 4.24 M9.17 14.83l-4.24 4.24','green'],
        ['Filtrácia alergénov a prachu','Filter G4 zachytáva peľ, prach, spóry plesní a iné alergény. Vzduch v interiéri je čistejší ako vonkajší.','M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z','violet'],
        ['Blokovanie hluku a zápachu','Jednotka nezatváraným otvorom nezavádza hluk z ulice ani nepríjemné zápachy. Tichá prevádzka len 26 dB(A).','M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z M12 8v4 M12 16h.01','amber'],
        ['Kontrola vlhkosti','ERV verzia rekuperuje vlhkosť a zabraňuje prílišnému sušeniu vzduchu v zime. HRV verzia odstraňuje prebytočnú vlhkosť v letnom období.','M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2','red'],
        ['Energetická úspora','Rekuperácia až 94 % tepelnej energie z odpadového vzduchu minimalizuje straty pri vetraní. Systém funguje s minimálnou spotrebou iba 2,3 W.','M13 10V3L4 14h7v7l9-11h-7z','emerald'],
        ['Ovládanie cez aplikáciu','Nastavenie intenzity vetrania, monitorovanie kvality vzduchu a plánovanie prevádzkových režimov priamo z vášho smartfónu.','M12 18h.01 M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z','orange'],
      ] as [$title,$desc,$icon,$color])
      @php
        $iconColors = [
          'green'   => 'bg-green-100 text-green-600',
          'violet'  => 'bg-violet-100 text-violet-600',
          'amber'   => 'bg-amber-100 text-amber-600',
          'red'     => 'bg-red-100 text-red-600',
          'emerald' => 'bg-emerald-100 text-emerald-600',
          'orange'  => 'bg-orange-100 text-orange-600',
        ];
      @endphp
      <div class="fade-up flex gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-white hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
        <div class="w-11 h-11 rounded-xl {{ $iconColors[$color] }} flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="{{ $icon }}"/>
          </svg>
        </div>
        <div>
          <h3 class="font-bold text-slate-900 mb-1">{{ $title }}</h3>
          <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== INSTALLATION PROCESS ===================== --}}
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="text-violet-700 text-sm font-bold tracking-[0.1em] uppercase mb-3 block">Inštalácia</span>
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Rýchla a čistá montáž bez búrania</h2>
      <p class="text-slate-500 max-w-xl mx-auto">Každá jednotka RECUAIR sa inštaluje do jedného otvoru v stene (⌀160 mm). Bez rúrkových rozvodov, bez stavebných úprav.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
      @foreach([
        ['01','Konzultácia a návrh','Navštívime objekt, posúdime dispozíciu a odporučíme vhodný počet a umiestnenie jednotiek pre optimálne vetranie.','M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z'],
        ['02','Príprava otvorov','Vyvrtáme otvory priemeru 160 mm v určených miestach. Celý proces je rýchly a s minimálnym množstvom stavebného prachu.','M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z'],
        ['03','Montáž jednotiek','Osadíme vonkajšiu a vnútornú časť jednotky, zapojíme napájanie a nakonfigurujeme systém pre váš objekt.','M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2'],
        ['04','Zaškolenie a odovzdanie','Nastavíme aplikáciu v smartfóne, zaškolíme vás na obsluhu a odovzdáme kompletný záručný list so zárukou 5 rokov.','M22 11.08V12a10 10 0 1 1-5.93-9.14 M22 4L12 14.01l-3-3'],
      ] as [$num,$title,$desc,$icon])
      <div class="fade-up bg-white rounded-2xl border border-slate-100 p-6 text-center hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
        <div class="w-12 h-12 rounded-2xl bg-violet-700 text-white text-lg font-extrabold flex items-center justify-center mx-auto mb-4">{{ $num }}</div>
        <svg class="w-6 h-6 text-violet-500 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="{{ $icon }}"/>
        </svg>
        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
      </div>
      @endforeach
    </div>

    {{-- CTA banner --}}
    <div class="fade-up bg-[#0f172a] rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
      <div>
        <h3 class="text-white text-2xl font-extrabold mb-2">Zaujímajú vás rekuperačné jednotky?</h3>
        <p class="text-white/55 max-w-lg">Kontaktujte nás pre bezplatné posúdenie objektu a cenovú ponuku – zdravý vzduch je len jeden krok od vás.</p>
      </div>
      <a href="/kontakt"
         class="shrink-0 inline-flex items-center gap-2 bg-white text-slate-900 font-semibold px-7 py-3.5 rounded-xl hover:bg-slate-100 hover:-translate-y-0.5 transition-all duration-200">
        Získať cenovú ponuku
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
  </div>
</section>

{{-- ===================== FOOTER ===================== --}}
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
          <a href="https://facebook.com/" target="_blank" rel="noopener" aria-label="Facebook"
             class="w-[38px] h-[38px] rounded-xl bg-white/[0.07] border border-white/10 flex items-center justify-center text-white/65 hover:bg-[#d42020] hover:border-[#d42020] hover:text-white transition-all duration-200">
            <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="https://www.instagram.com/la_s.r.o/" target="_blank" rel="noopener" aria-label="Instagram"
             class="w-[38px] h-[38px] rounded-xl bg-white/[0.07] border border-white/10 flex items-center justify-center text-white/65 hover:bg-[#d42020] hover:border-[#d42020] hover:text-white transition-all duration-200">
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
          <a href="/rekuperacie" class="text-white font-semibold text-sm">Rekuperácie</a>
          <a href="/admin" class="text-white/50 text-sm hover:text-white transition-colors">Meranie spotreby</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Spoločnosť</h5>
        <div class="flex flex-col gap-2.5">
          <a href="/kontakt" class="text-white/50 text-sm hover:text-white transition-colors">Kontakt</a>
          <a href="{{ route('Privacy Policy') }}" class="text-white/50 text-sm hover:text-white transition-colors">Ochrana osobných údajov</a>
          <a href="{{ route('Terms of Service') }}" class="text-white/50 text-sm hover:text-white transition-colors">Obchodné podmienky</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Kontakt</h5>
        <div class="flex flex-col gap-3">
          <div class="flex gap-3 items-start">
            <svg class="w-[17px] h-[17px] text-[#d42020] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-white/55 text-sm leading-[1.55]">SNP 182, Spišské Bystré<br>059 18</span>
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
        <a href="{{ route('Privacy Policy') }}" class="text-[0.8375rem] text-white/40 hover:text-white/70 transition-colors">Ochrana osobných údajov</a>
        <a href="{{ route('Terms of Service') }}" class="text-[0.8375rem] text-white/40 hover:text-white/70 transition-colors">Obchodné podmienky</a>
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
