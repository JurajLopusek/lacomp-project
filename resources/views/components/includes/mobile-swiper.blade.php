<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.2.0/swiper-bundle.min.css">
<style>
  .m-swiper { padding-bottom: 36px; }
  .m-swiper .swiper-slide { height: auto; transition-property: all; }
  .m-swiper .swiper-pagination-bullet-active { background: #d42020; }
  @media (min-width: 768px) {
    .m-swiper { overflow: visible; padding-bottom: 0; }
    .m-swiper .swiper-wrapper { display: grid; gap: 20px; transform: none !important; }
    .m-swiper .swiper-slide { width: auto !important; margin: 0 !important; }
    .m-swiper .swiper-pagination { display: none; }
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/swiper@14.2.0/swiper-bundle.min.js"></script>
<script>
  (() => {
    const mq = window.matchMedia('(max-width: 767px)');
    const instances = new Map();
    const sync = () => {
      document.querySelectorAll('.m-swiper').forEach(el => {
        const swiper = instances.get(el);
        if (mq.matches && !swiper) {
          instances.set(el, new Swiper(el, {
            slidesPerView: 1.12,
            spaceBetween: 16,
            grabCursor: true,
            pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
          }));
        } else if (!mq.matches && swiper) {
          swiper.destroy(true, true);
          instances.delete(el);
        }
      });
    };
    sync();
    mq.addEventListener('change', sync);
  })();
</script>
