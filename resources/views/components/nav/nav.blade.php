@php($light = $light ?? true)
@php($navHeight = 84) {{-- menu height in px on desktop (≥1024px) – single source of truth --}}
@php($navHeightMobile = 64) {{-- menu height in px on phones/tablets --}}
<style>
  .nav-bar { height: {{ $navHeightMobile }}px; }
  .nav-offset { padding-top: {{ $navHeightMobile }}px; }
  .nav-logo { width: 44px; height: 44px; }
  @media (min-width: 1024px) {
    .nav-bar { height: {{ $navHeight }}px; }
    .nav-offset { padding-top: {{ $navHeight }}px; }
    .nav-logo { width: 56px; height: 56px; }
  }
  .m-menu { position: fixed; top: {{ $navHeightMobile }}px; left: 0; right: 0; bottom: 0; display: flex; flex-direction: column; gap: 4px; padding: 16px 16px calc(24px + env(safe-area-inset-bottom)); background: #fff; border-top: 1px solid #f1f5f9; overflow-y: auto; }
  .m-link { display: flex; align-items: center; justify-content: space-between; padding: 16px 18px; border-radius: 14px; color: #334155; font-size: 1.125rem; font-weight: 500; transition: background-color .15s, color .15s; }
  .m-link:hover, .m-link.is-active { background: #fef2f2; color: #d42020; }
  .m-link svg { width: 18px; height: 18px; color: #cbd5e1; transition: color .15s, transform .15s; }
  .m-link:hover svg, .m-link.is-active svg { color: #d42020; transform: translateX(2px); }
  .m-cta { display: flex; justify-content: center; margin-top: auto; padding: 16px; font-size: 1.0625rem; border-radius: 14px; background: #d42020; color: #fff; font-weight: 600; transition: background-color .15s; }
  .m-cta:hover { background: #b31c1c; }
</style>
<nav x-data="{ scrolled: {{ $light ? 'true' : 'false' }}, open: false }"
     @click.outside="open = false" @keydown.escape.window="open = false"
     x-effect="document.documentElement.style.overflow = open ? 'hidden' : ''"
     @resize.window="if (window.innerWidth >= 1024) open = false"
     @scroll.window="scrolled = {{ $light ? 'true' : 'window.scrollY > 20' }}"
     :class="scrolled ? 'bg-white border-b border-slate-200 shadow-md' : '{{ ($transparent ?? false) ? 'border-b border-transparent' : 'bg-[#0f172a] border-b border-white/10' }}'"
     class="nav-bar fixed top-0 left-0 right-0 z-50 transition-all duration-300">
  <div class="mx-auto px-6" style="max-width:1440px">
    <div class="nav-bar flex items-center justify-between">

      <a href="/" class="flex items-center gap-3 shrink-0">
        <img src="{{ asset('cervene-logo.svg') }}" alt="LACOMP" class="nav-logo" />
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
           @class([
             'text-base font-medium px-4 py-2.5 rounded-lg transition-all duration-200 whitespace-nowrap',
             'text-[#d42020]!' => request()->is(ltrim($url, '/')),
           ])>{{ $label }}</a>
        @endforeach
      </div>

      <div class="flex items-center gap-3">
        <a href="/kontakt"
           class="hidden lg:inline-flex items-center gap-2 text-base font-semibold text-white bg-[#d42020] border-2 border-[#d42020] px-6 py-2.5 rounded-xl hover:bg-[#b31c1c] hover:border-[#b31c1c] hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(212,32,32,0.4)] transition-all duration-200">
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

  {{-- Mobile menu --}}
  <div x-show="open" x-cloak
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-4"
       class="lg:hidden m-menu">
    @foreach([
      ['/photovoltaicSystems','Fotovoltika'],
      ['/kamery','Kamerové systémy'],
      ['/alarmy','Alarmové systémy'],
      ['/inspection','Revízie elektroinštalácií'],
      ['/rekuperacie','Rekuperácie'],
      ['/admin','Meranie spotreby'],
    ] as [$url,$label])
    <a href="{{ $url }}" @class(['m-link', 'is-active' => request()->is(ltrim($url, '/'))])>
      {{ $label }}
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    @endforeach
    <a href="/kontakt" class="m-cta">Kontaktujte nás</a>
  </div>
</nav>
@if($light)
<div class="nav-offset" aria-hidden="true"></div>
@endif
