<footer class="bg-gray-700 mt-20">
    <footer class="bg-[#FCF7F7] py-6">
        <div class="max-w-7xl mx-auto px-4 text-rose-800 text-center">
            <div class="flex flex-col md:flex-row justify-between gap-8 mb-6 text-lg font-normal">
                <x-nav.nav-link-footer href="{{ route('Privacy Policy') }}" >Ochrana osobných údajov</x-nav.nav-link-footer>
                <x-nav.nav-link-footer href="/kontakt" :active="request()->is('kontakt')">Kontakt</x-nav.nav-link-footer>
                <x-nav.nav-link-footer href="{{ route('Terms of Service') }}" >Obchodné podmienky</x-nav.nav-link-footer>
            </div>

            <div class="flex justify-center space-x-6 mb-6 text-xl">
                <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="hover:text-black">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M18 2h-3a4 4 0 00-4 4v3H8v4h3v9h4v-9h3l1-4h-4V6a1 1 0 011-1h3z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/la_s.r.o/" target="_blank" aria-label="Instagram" class="hover:text-black">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
                    </svg>
                </a>
            </div>

            <p class="text-sm">&copy; {{ date('Y') }} LA, spol.s.r.o. Všetky práva vyhradené.</p>
        </div>
    </footer>
</footer>
