{{-- Usage: @include('components.nav.nav') – white fixed bar that also reserves its own space below it, so pages need no top offset.
     ['light' => false] makes it dark at the top and white after scrolling (no spacer – the page hero must add class "nav-offset"), ['transparent' => true] makes that top state see-through. --}}
@php($light = $light ?? true)
<style>
  :root { --nav-h: 84px; }  /* menu height – single source of truth */
  .nav-bar { height: var(--nav-h); }
  .nav-offset { padding-top: var(--nav-h); }
</style>
<nav x-data="{ scrolled: {{ $light ? 'true' : 'false' }}, open: false }"
     @scroll.window="scrolled = {{ $light ? 'true' : 'window.scrollY > 20' }}"
     :class="scrolled ? 'bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-md' : '{{ ($transparent ?? false) ? 'border-b border-transparent' : 'bg-[#0f172a] border-b border-white/10' }}'"
     class="nav-bar fixed top-0 left-0 right-0 z-50 transition-all duration-300">
  <div class="mx-auto px-6" style="max-width:1440px">
    <div class="nav-bar flex items-center justify-between">

      <a href="/" class="flex items-center gap-3 shrink-0">
        <img src="{{ asset('cervene-logo.svg') }}" alt="LACOMP" class="h-14 w-14" />
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
@if($light)
<div class="nav-offset" aria-hidden="true"></div>
@endif
