{{-- Hero photo of a service page, managed in admin (Web → page name). Without $heroUrl the plain dark background stays. --}}
@if($heroUrl)
<img src="{{ $heroUrl }}" alt="" class="absolute inset-0 w-full h-full object-cover pointer-events-none" style="object-position:center 55%">
<div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(90deg,rgba(15,23,42,.9) 0%,rgba(15,23,42,.75) 50%,rgba(15,23,42,.4) 100%)"></div>
@endif
