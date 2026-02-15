<x-layouts.base>
    <div class="max-w-7xl mx-auto px-4 py-6 bg-[#FCF7F7]">

        {{-- Obrázok --}}
        <div class="rounded-xl overflow-hidden mb-8 h-96">
            <img src="{{ asset('storage/inspection/revizie.png') }}" alt="Revízia elektroinštalácie"
                 class="w-full h-full object-cover object-center">
        </div>

        {{-- Nadpis a úvod --}}
        <h2 class="text-2xl md:text-3xl font-bold mb-4">Prečo sú revízie elektroinštalácií dôležité</h2>
        <p class="mb-10 text-base leading-relaxed">
            Pravidelné revízie elektroinštalácií sú nevyhnutné pre udržanie bezpečnosti a efektivity vášho domu alebo firmy.
            Pomáhajú identifikovať potenciálne riziká, zabezpečiť súlad s normami a predchádzať nákladným opravám v budúcnosti.
            Naše komplexné revízie pokrývajú všetky časti elektroinštalácie – od rozvodov a ističov až po zásuvky a spotrebiče.
        </p>

        {{-- Proces kontroly --}}
        <h3 class="text-lg font-semibold mb-6">Náš proces revízie</h3>
        <ul class="space-y-6">
            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-1">
                        <div class="bg-white rounded-full p-1">
                            {{-- SVG ikona nezmenená --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold">Úvodné posúdenie</h4>
                    <p class="text-red-800 font-semibold text-base">
                        Začíname komplexným posúdením vášho elektrického systému, aby sme zistili jeho aktuálny stav a identifikovali prípadné problémy.
                    </p>
                </div>
            </li>

            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-1">
                        <div class="bg-white rounded-full p-1">
                            {{-- SVG ikona nezmenená --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold">Dôkladná kontrola</h4>
                    <p class="text-red-800 font-semibold text-base">
                        Naši certifikovaní technici vykonajú dôkladnú kontrolu všetkých elektrických súčastí vrátane rozvodov, ističov, zásuviek a spotrebičov.
                    </p>
                </div>
            </li>

            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-1">
                        <div class="bg-white rounded-full p-1">
                            {{-- SVG ikona nezmenená --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold">Podrobná správa</h4>
                    <p class="text-red-800 font-semibold text-base">
                        Dostanete podrobnú správu so zisteniami, vrátane identifikovaných problémov a odporúčaných opatrení.
                    </p>
                </div>
            </li>

            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-1">
                        <div class="bg-white rounded-full p-1">
                            {{-- SVG ikona nezmenená --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold">Následná podpora a odporúčania</h4>
                    <p class="text-red-800 font-semibold text-base">
                        Poskytujeme podporu a odporúčania na odstránenie zistených problémov a zabezpečenie bezpečnosti a efektivity vášho systému.
                    </p>
                </div>
            </li>
        </ul>

        {{-- Výhody --}}
        <h3 class="text-lg font-semibold mt-16 mb-6">Výhody pravidelných revízií</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-service-card icon="shieldwithcheck" iconType="png" title="Zvýšená bezpečnosť"
                            description="Chráňte svoj majetok a osoby identifikovaním a odstránením potenciálnych elektrických rizík."/>
            <x-service-card icon="dollar" iconType="png" title="Úspora nákladov"
                            description="Predíďte drahým opravám včasnou identifikáciou a odstránením menších problémov."/>
            <x-service-card icon="time" iconType="png" title="Preventívna údržba"
                            description="Predĺžte životnosť elektroinštalácie a zaistite jej optimálny výkon pravidelnou údržbou."/>
        </div>
    </div>
</x-layouts.base>
