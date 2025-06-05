<div class="shadow-lg bg-[#d60000] fixed w-full transition-all duration-500 overflow-hidden top-0 left-0 right-0 z-40">
    <div class="hidden lg:flex mx-0 px-4 py-3 flex items-center justify-between h-20 transition-all duration-300">
        <a class="text-3xl font-bold leading-none" href="/" :active="request()->is('/domov')">
            <img class="h-10" alt="logo" viewBox="0 0 10240 10240" src="{{ asset('storage/lacomp.png') }}">
        </a>
        <div class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
            <x-nav.nav-link href="/" :active="request()->is('/')">Domov</x-nav.nav-link>
            <x-nav.nav-link href="/alarmy" :active="request()->is('alarmy')">Alarmy</x-nav.nav-link>
            <x-nav.nav-link href="/kamery" :active="request()->is('kamery')">Kamery</x-nav.nav-link>
            <x-nav.nav-link href="/inspection" :active="request()->is('inspection')">Revízie</x-nav.nav-link>
            <x-nav.nav-link href="/photovoltaicSystems" :active="request()->is('photovoltaicSystems')">Fotovoltické systémy</x-nav.nav-link>
            <x-nav.nav-link href="/admin/login" :active="request()->is('admin/login')">Meranie spotreby</x-nav.nav-link>
            <x-nav.nav-link href="/kontakt" :active="request()->is('kontakt')">Kontakt</x-nav.nav-link>

        </div>
    </div>
    <nav x-data="{ open: false }">
        <div class="-me-2 py-2 flex items-center lg:hidden justify-between">
            <div class="flex-shrink-0 ml-2 sm:ml-6">
                <a class="text-3xl font-bold leading-none" href="/">
                    <img class="h-10" alt="logo" viewBox="0 0 10240 10240" src="{{ asset('storage/lacomp.png') }}">
                </a>
            </div>
            <div class="flex mr-4 sm:mr-6">
                <livewire:menu />
            </div>
        </div>
    </nav>
</div>

