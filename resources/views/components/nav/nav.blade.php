<div class="mx-0 flex relative px-12 py-3 flex justify-between items-center bg-[#d60000] border-b-2">
    <a class="text-3xl font-bold leading-none" href="/" :active="request()->is('/domov')">
        <img class="h-10" alt="logo" viewBox="0 0 10240 10240" src="{{ asset('storage/lacomp.png') }}">
    </a>

    <div class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
        <x-nav.nav-link href="/" :active="request()->is('/')">Domov</x-nav.nav-link>
        <x-nav.nav-link href="/alarmy" :active="request()->is('alarmy')">Alarmy</x-nav.nav-link>
        <x-nav.nav-link href="/kamery" :active="request()->is('kamery')">Kamery</x-nav.nav-link>
        <x-nav.nav-link href="/admin/login" :active="request()->is('admin/login')">Meranie spotreby</x-nav.nav-link>
        <x-nav.nav-link href="/kontakt" :active="request()->is('kontakt')">Kontakt</x-nav.nav-link>
    </div>

</div>

