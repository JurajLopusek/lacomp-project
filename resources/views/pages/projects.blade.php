<x-layouts.base title="Realizácie – LACOMP">
<style>
  .project-card .project-cover img { transition: transform .5s ease; }
  .project-card:hover .project-cover img { transform: scale(1.05); }
  .project-desc { display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 4; overflow: hidden; }
  .project-desc.is-open { -webkit-line-clamp: unset; }
  .project-tag { background: #fef2f2; color: #d42020; border: 1px solid #fee2e2; }
</style>

{{-- ====== PAGE HERO ====== --}}
<section class="bg-[#0f172a] relative overflow-hidden">
  @include('components.includes.page-hero-style')
  <div class="absolute inset-0 pointer-events-none" style="background-image:linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px);background-size:64px 64px"></div>
  <div class="absolute -top-32 right-0 w-[600px] h-[600px] pointer-events-none" style="background:radial-gradient(circle,rgba(212,32,32,.18) 0%,transparent 65%)"></div>
  <div class="page-hero max-w-[1200px] mx-auto px-6 py-16 relative z-10 flex flex-col justify-center">
    <div class="flex items-center gap-2 text-white/45 text-sm mb-6">
      <a href="/" class="hover:text-white transition-colors">Domov</a>
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
      <span class="text-white/80">Realizácie</span>
    </div>
    <div class="inline-flex self-start items-center gap-2 bg-red-600/20 text-red-300 text-[0.775rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full border border-red-500/30 mb-5">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      Naše projekty
    </div>
    <h1 class="text-white font-extrabold leading-[1.1] mb-4" style="font-size:clamp(2rem,4.5vw,3.25rem);letter-spacing:-0.03em;">
      Realizácie, na ktoré<br>sme hrdí
    </h1>
    <p class="text-white/65 text-lg leading-[1.7] max-w-[580px]">
      Fotovoltika, kamerové a alarmové systémy, revízie aj rekuperácie – pozrite si ukážky projektov, ktoré sme u našich zákazníkov zrealizovali.
    </p>
  </div>
</section>

{{-- ====== PROJECTS ====== --}}
<section class="py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    @if($projects->isEmpty())
      <div class="text-center py-16 fade-up">
        <div class="w-16 h-16 rounded-2xl bg-red-50 text-[#d42020] flex items-center justify-center mx-auto mb-5">
          <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <h2 class="text-slate-900 font-bold text-xl mb-2">Čoskoro tu pribudnú naše realizácie</h2>
        <p class="text-slate-500">Medzitým nás neváhajte <a href="/kontakt" class="text-[#d42020] font-semibold">kontaktovať</a>.</p>
      </div>
    @else
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
          @php($photos = $project->gallery())
          <article class="project-card bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col fade-up">
            {{-- cover + hidden rest of the photos = one lightbox gallery per project --}}
            <div class="project-gallery project-cover relative overflow-hidden bg-slate-100" style="aspect-ratio:4/3">
              @forelse($photos as $i => $photo)
                <a href="{{ $photo['src'] }}" data-pswp-width="{{ $photo['w'] }}" data-pswp-height="{{ $photo['h'] }}" target="_blank"
                   class="block w-full h-full" style="cursor:zoom-in{{ $i > 0 ? ';display:none' : '' }}">
                  @if($i === 0)
                    <img src="{{ $photo['src'] }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover" />
                  @endif
                </a>
              @empty
                <div class="w-full h-full flex items-center justify-center text-slate-300">
                  <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
              @endforelse
              @if($project->year)
                <span class="absolute top-3 left-3 bg-white/95 text-slate-900 text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm pointer-events-none">{{ $project->year }}</span>
              @endif
              @if(count($photos) > 1)
                <span class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 bg-black/60 text-white text-xs font-semibold px-2.5 py-1 rounded-lg pointer-events-none">
                  <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                  {{ count($photos) }}
                </span>
              @endif
            </div>

            <div class="p-6 flex flex-col flex-grow" x-data="{ open: false }">
              @if(!empty($project->tags))
                <div class="flex flex-wrap gap-1.5 mb-3">
                  @foreach($project->tags as $tag)
                    <span class="project-tag text-[0.72rem] font-semibold px-2.5 py-1 rounded-full">{{ $tag }}</span>
                  @endforeach
                </div>
              @endif
              <h2 class="text-slate-900 font-bold text-[1.1rem] leading-snug mb-1.5">{{ $project->title }}</h2>
              @if($project->location)
                <div class="flex items-center gap-1.5 text-slate-500 text-sm mb-3">
                  <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  {{ $project->location }}
                </div>
              @endif
              @if($project->description)
                <p class="project-desc text-slate-600 text-sm leading-[1.65]" :class="{ 'is-open': open }">{{ $project->description }}</p>
                @if(mb_strlen($project->description) > 220)
                  <button type="button" @click="open = !open" class="self-start mt-2 text-sm font-semibold text-[#d42020]" x-text="open ? 'Zobraziť menej' : 'Zobraziť viac'">Zobraziť viac</button>
                @endif
              @endif
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- ====== CTA ====== --}}
<section class="pb-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="rounded-2xl p-10 relative overflow-hidden fade-up" style="background:linear-gradient(135deg,#e11d48 0%,#d42020 45%,#f97316 100%)">
      <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
        <div>
          <h3 class="text-white font-bold text-[1.5rem] mb-1.5">Chcete podobné riešenie?</h3>
          <p class="text-[1rem]" style="color:rgba(255,255,255,.85)">Ozvite sa nám a dohodneme si bezplatnú obhliadku a cenovú ponuku.</p>
        </div>
        <a href="/kontakt" class="shrink-0 inline-flex items-center gap-2 bg-white text-[#d42020] font-semibold text-[1rem] px-8 py-3.5 rounded-xl hover:bg-red-50 hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">Kontaktujte nás</a>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.css">
<script type="module">
  import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe-lightbox.esm.min.js';
  const lightbox = new PhotoSwipeLightbox({
    gallery: '.project-gallery',
    children: 'a',
    bgOpacity: 0.92,
    showHideAnimationType: 'zoom',
    pswpModule: () => import('https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.esm.min.js'),
  });
  lightbox.init();
</script>
</x-layouts.base>
