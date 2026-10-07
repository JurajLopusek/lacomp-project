{{-- Photo gallery of a service page, managed in admin (Web → Galérie stránok). Expects $gallery, $title, $alt. --}}
@if($gallery->isNotEmpty())
<style>
  .gallery-item img { transition:transform .5s ease; }
  .gallery-item:hover img { transform:scale(1.06); }
  @media (min-width: 768px) { .page-gallery-swiper .swiper-wrapper { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
  @media (min-width: 1024px) { .page-gallery-swiper .swiper-wrapper { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
</style>
<section class="bg-slate-50 py-20">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="text-center mb-14 fade-up">
      <span class="inline-flex bg-red-50 text-[#d42020] text-[0.78rem] font-bold tracking-[0.07em] uppercase px-4 py-1.5 rounded-full mb-4">Naše realizácie</span>
      <h2 class="text-slate-900 font-bold mb-3" style="font-size:clamp(1.5rem,3vw,2.25rem)">{{ $title }}</h2>
      <p class="text-slate-500 text-[1.05rem] max-w-[500px] mx-auto">Pozrite si ukážky systémov, ktoré sme nainštalovali.</p>
    </div>

    <div id="page-gallery" class="swiper m-swiper page-gallery-swiper">
      <div class="swiper-wrapper">
      @foreach($gallery as $img)
      <a href="{{ $img['src'] }}" data-pswp-width="{{ $img['w'] }}" data-pswp-height="{{ $img['h'] }}" target="_blank"
         class="swiper-slide gallery-item block rounded-xl overflow-hidden relative shadow-md hover:-translate-y-1 hover:shadow-xl transition-all duration-300 fade-up"
         style="aspect-ratio:3/4;cursor:zoom-in">
        <img src="{{ $img['src'] }}" alt="{{ $alt }}" loading="lazy" class="w-full h-full object-cover" />
      </a>
      @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.css">
<script type="module">
  import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe-lightbox.esm.min.js';
  const lightbox = new PhotoSwipeLightbox({
    gallery: '#page-gallery',
    children: 'a',
    bgOpacity: 0.92,
    showHideAnimationType: 'zoom',
    pswpModule: () => import('https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.esm.min.js'),
  });
  lightbox.init();
</script>
@endif
