<div
    class="relative flex items-center"
    x-data="{ open: false }"
    x-on:keydown.escape.window="open = false"
>
    <!-- Tlačidlo na otváranie menu -->
    <button
        type="button"
        class="inline-flex ml-0 sm:ml-2 items-center justify-center p-2 rounded-md text-white focus:outline-none transition duration-150 ease-in-out"
        @click="open = !open"
        :aria-expanded="open.toString()"
        aria-controls="mobile-menu-drawer"
    >
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :d="open ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2"/>
        </svg>
    </button>

    <!-- Menu s animáciou -->
    <div
        x-cloak
        x-show="open"
        x-transition.opacity.200ms
        class="fixed inset-0 z-40 bg-black bg-opacity-50"
        @click="open = false"
    ></div>

    <div
        id="mobile-menu-drawer"
        x-cloak
        x-show="open"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full max-w-[400px] w-full bg-white dark:bg-gray-800 z-50 shadow-xl"
    >
        <!-- Obsah menu -->
        <div class="p-4 border-b flex justify-end">
            <button @click="open = false" class="font-semibold flex items-center dark:text-white" type="button">
                {{ __('Zavrieť') }}
                <svg class="h-6 w-6 ml-2" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div @click="open = false">
            <x-nav.nav-link-mobile href="/" :active="request()->is('/')">Domov</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/alarmy" :active="request()->is('alarmy')">Alarmy</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/kamery" :active="request()->is('kamery')">Kamery</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/inspection" :active="request()->is('inspection')">Inšpekcie</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/photovoltaicSystems" :active="request()->is('photovoltaicSystems')">Fotovoltické systémy</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/rekuperacie" :active="request()->is('rekuperacie')">Rekuperácie</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/admin/login" :active="request()->is('admin/login')">Meranie spotreby</x-nav.nav-link-mobile>
            <x-nav.nav-link-mobile href="/kontakt" :active="request()->is('kontakt')">Kontakt</x-nav.nav-link-mobile>
        </div>
{{--        <div class="ml-8 mt-6">--}}
{{--            <livewire:components.languageChanger />--}}
{{--        </div>--}}
    </div>
</div>
