<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontakt – LACOMP</title>
  <meta name="description" content="Kontaktujte LACOMP – LA, spol. s.r.o. Sídlo: SNP 182, Spišské Bystré. Tel: +421 903 701 665. Email: lacomp@lacomp.sk. Pracovná doba: Pon–Pia 07:00–17:00.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
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
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(220,38,38,.18) 0%,transparent 65%)"></div>
  <div class="max-w-[1200px] mx-auto px-6 py-16 relative z-10">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="text-white/80">Kontakt</span>
    </div>
    <div class="inline-flex items-center gap-2 bg-red-900/30 text-red-300 text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-red-500/30 mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 21.72 16z"/>
      </svg>
      Sme tu pre vás
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Kontaktujte nás
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Máte otázku, potrebujete cenovú ponuku alebo chcete dohodnúť termín? Ozvite sa nám – radi vám pomôžeme.
    </p>
  </div>
</section>

{{-- ===================== CONTACT GRID ===================== --}}
<section class="bg-white py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="grid lg:grid-cols-[1fr_1.4fr] gap-10">

      {{-- LEFT: Info + Quick links --}}
      <div class="fade-up flex flex-col gap-6">

        {{-- Contact info card --}}
        <div class="bg-[#0f172a] rounded-2xl p-8 text-white">
          <h3 class="text-xl font-bold mb-2">Kontaktné informácie</h3>
          <p class="text-white/50 text-sm leading-relaxed mb-7">
            Sme malá, no spoľahlivá slovenská spoločnosť so sídlom v Spišskom Bystrom. Neváhajte nás kontaktovať telefonicky alebo e-mailom.
          </p>
          <div class="flex flex-col gap-5">
            <div class="flex gap-4 items-start">
              <div class="w-10 h-10 rounded-xl bg-[#d42020]/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div>
                <div class="text-white/45 text-xs font-semibold uppercase tracking-wider mb-0.5">Adresa</div>
                <div class="text-white text-sm leading-relaxed">SNP 182<br>Spišské Bystré, 059 18</div>
              </div>
            </div>
            <div class="flex gap-4 items-start">
              <div class="w-10 h-10 rounded-xl bg-[#d42020]/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 21.72 16z"/></svg>
              </div>
              <div>
                <div class="text-white/45 text-xs font-semibold uppercase tracking-wider mb-0.5">Telefón</div>
                <a href="tel:+421903701665" class="text-white text-sm hover:text-[#d42020] transition-colors">+421 903 701 665</a>
              </div>
            </div>
            <div class="flex gap-4 items-start">
              <div class="w-10 h-10 rounded-xl bg-[#d42020]/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </div>
              <div>
                <div class="text-white/45 text-xs font-semibold uppercase tracking-wider mb-0.5">E-mail</div>
                <a href="mailto:lacomp@lacomp.sk" class="text-white text-sm hover:text-[#d42020] transition-colors">lacomp@lacomp.sk</a>
              </div>
            </div>
            <div class="flex gap-4 items-start">
              <div class="w-10 h-10 rounded-xl bg-[#d42020]/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              </div>
              <div>
                <div class="text-white/45 text-xs font-semibold uppercase tracking-wider mb-0.5">Pracovná doba</div>
                <div class="text-white text-sm leading-relaxed">Pon – Pia: 07:00 – 17:00<br><span class="text-white/45">Sobota – Nedeľa: Zatvorené</span></div>
              </div>
            </div>
            <div class="flex gap-4 items-start">
              <div class="w-10 h-10 rounded-xl bg-[#d42020]/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#d42020]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
              </div>
              <div>
                <div class="text-white/45 text-xs font-semibold uppercase tracking-wider mb-0.5">Instagram</div>
                <a href="https://www.instagram.com/la_s.r.o/" target="_blank" rel="noopener" class="text-white text-sm hover:text-[#d42020] transition-colors">@la_s.r.o</a>
              </div>
            </div>
          </div>
        </div>

        {{-- Quick service links --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6">
          <h4 class="text-slate-900 font-bold mb-4">Čo hľadáte?</h4>
          <div class="flex flex-col gap-1.5">
            @foreach([
              ['/photovoltaicSystems','Fotovoltické systémy','M12 2v1 M12 21v1 M4.22 4.22l.7.7M18.36 18.36l.71.71M2 12h1M21 12h1M4.22 19.78l.7-.7M18.36 5.64l.71-.71M12 6a6 6 0 1 0 0 12A6 6 0 0 0 12 6z'],
              ['/kamery','Kamerové systémy','M23 7l-7 5 7 5V7z M1 5h15a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H1z'],
              ['/alarmy','Alarmové systémy','M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9 M13.73 21a2 2 0 0 1-3.46 0'],
              ['/inspection','Revízie elektroinštalácií','M13 10V3L4 14h7v7l9-11h-7z'],
              ['/rekuperacie','Rekuperácie','M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2'],
            ] as [$url,$label,$icon])
            <a href="{{ $url }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-slate-50 hover:bg-red-50 hover:text-[#d42020] text-slate-600 text-sm font-medium transition-all duration-200 group">
              <svg class="w-4 h-4 shrink-0 text-slate-400 group-hover:text-[#d42020] transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="{{ $icon }}"/>
              </svg>
              {{ $label }}
            </a>
            @endforeach
          </div>
        </div>

      </div>

      {{-- RIGHT: Livewire form --}}
      <div class="fade-up" style="transition-delay:.1s">
        <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
          @livewire('contact-form')
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ===================== MAP ===================== --}}
<div>
    <iframe
        title="Mapa – LACOMP, SNP 182, Spišské Bystré"
        src="https://maps.google.com/maps?q=SNP+182,+Spi%C5%A1sk%C3%A9+Bystr%C3%A9&output=embed&z=14"
        width="100%" height="420" style="border:0;display:block;"
        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

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
          <a href="/rekuperacie" class="text-white/50 text-sm hover:text-white transition-colors">Rekuperácie</a>
          <a href="/admin" class="text-white/50 text-sm hover:text-white transition-colors">Meranie spotreby</a>
        </div>
      </div>
      <div>
        <h5 class="text-white text-[0.795rem] font-bold tracking-[0.07em] uppercase mb-5">Spoločnosť</h5>
        <div class="flex flex-col gap-2.5">
          <a href="/kontakt" class="text-white font-semibold text-sm">Kontakt</a>
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

@livewireScripts
</body>
</html>
