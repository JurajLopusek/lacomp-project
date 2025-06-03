<x-layouts.base>
    <div class="max-w-7xl mx-auto px-4 py-6 bg-[#FCF7F7] text-black">
        {{-- Obrázky pre desktop a mobil --}}
        <div class="hidden md:block rounded-xl overflow-hidden mb-8 h-96">
            <img src="{{ asset('storage/alarm/frame_alarm.png') }}" alt="Alarmový systém" class="w-full h-auto object-cover">
        </div>
        <div class="block md:hidden max-h-96 rounded-xl overflow-hidden mb-8">
            <img src="{{ asset('storage/alarm/frame_alarm_mobile.png') }}" alt="Alarmový systém" class="w-full h-auto object-cover">
        </div>

        {{-- Nadpis --}}
        <h2 class="text-2xl md:text-3xl font-bold mb-4">
            Pokročilé alarmové systémy pre vyššiu bezpečnosť
        </h2>
        <p class="mb-10 text-base leading-relaxed">
            Chráňte svoj majetok pomocou našich moderných alarmových systémov. Ponúkame rôzne riešenia prispôsobené vašim
            konkrétnym potrebám, ktoré zabezpečia komplexnú ochranu a pokoj v duši.
        </p>

        {{-- Typy alarmových systémov --}}
        <div class="mb-10">
            <h3 class="text-lg font-semibold mb-4">Typy alarmových systémov</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-service-card icon="shield" title="Bezdrôtové alarmy"
                                description="Jednoduchá inštalácia a flexibilita, ideálne pre domácnosti a malé firmy." />
                <x-service-card icon="shield2" title="Drôtové alarmy"
                                description="Spoľahlivé a bezpečné riešenie vhodné pre väčšie objekty a firmy." />
                <x-service-card icon="shield3" title="Hybridné alarmy"
                                description="Kombinujú výhody bezdrôtových aj drôtových systémov pre optimálnu ochranu." />
            </div>
        </div>

        {{-- Kľúčové vlastnosti --}}
        <div class="mb-10">
            <h3 class="text-lg font-semibold mb-4">Kľúčové vlastnosti</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <x-service-card icon="ring" iconType="png" title="Vzdialené sledovanie"
                                description="Sledujte svoj objekt odkiaľkoľvek pomocou našej mobilnej aplikácie." />
                <x-service-card icon="wifi" iconType="png" title="Ovládanie cez smartfón"
                                description="Zapnite, vypnite a spravujte systém jednoducho cez telefón." />
                <x-service-card icon="power" iconType="png" title="Záložné napájanie"
                                description="Zabezpečí chod systému aj počas výpadku elektriny." />
                <x-service-card icon="sirena" iconType="png" title="Hlasná siréna"
                                description="Odrádza narušiteľov pomocou silného zvukového alarmu." />
                <x-service-card icon="camera" iconType="png" title="Video overenie"
                                description="Získajte videozáznamy z poplachu pre rýchle overenie situácie." />
                <x-service-card icon="phone" iconType="png" title="Podpora 24/7"
                                description="Náš tím je vám k dispozícii nepretržite." />
            </div>
        </div>

        {{-- Proces inštalácie --}}
        <div>
            <h3 class="text-lg font-semibold mb-6">Proces inštalácie</h3>
            <ol class="space-y-6 border-l-2 border-dashed border-black pl-4">
                <li>
                    <div class="flex items-start gap-3">
                        <img src="{{ asset('storage/icons/calendar.png') }}" alt="Konzultácia" class="w-8 h-8 mt-1">
                        <div>
                            <h4 class="font-semibold">Úvodná konzultácia</h4>
                            <p class="text-rose-600 text-sm">Zhodnotíme vaše bezpečnostné potreby a odporučíme vhodný systém.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-start gap-3">
                        <img src="{{ asset('storage/icons/key.png') }}" alt="Inštalácia" class="w-8 h-8 mt-1">
                        <div>
                            <h4 class="font-semibold">Návrh a inštalácia systému</h4>
                            <p class="text-rose-600 text-sm">Naši certifikovaní technici zabezpečia profesionálnu montáž s minimálnym narušením.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-start gap-3">
                        <img src="{{ asset('storage/icons/check.png') }}" alt="Zaškolenie" class="w-8 h-8 mt-1">
                        <div>
                            <h4 class="font-semibold">Testovanie a zaškolenie</h4>
                            <p class="text-rose-600 text-sm">Overíme funkčnosť systému a zaškolíme vás na jeho používanie.</p>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</x-layouts.base>
