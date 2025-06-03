<x-layouts.base>
    <div class="max-w-7xl mx-auto px-4 py-6 bg-[#FCF7F7]">
        <div class="rounded-xl overflow-hidden mb-10 h-96">
            <img src="{{ asset('storage/solar/solarfarm.jpg') }}" alt="Fotovoltické systémy"
                 class="w-full h-full object-cover object-top-[70%]">
        </div>

        {{-- Nadpis --}}
        <h2 class="text-2xl md:text-3xl font-bold mb-4">Fotovoltické systémy</h2>
        <p class="mb-10 text-base leading-relaxed">
            Využite silu slnka pomocou našich moderných fotovoltických systémov. Ponúkame komplexné riešenia od úvodnej
            konzultácie až po inštaláciu a údržbu, čím zabezpečíme bezproblémový prechod na udržateľnú energiu.
        </p>

        {{-- Výhody --}}
        <h3 class="text-lg font-semibold mb-4">Výhody fotovoltických systémov</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="border border-rose-200 rounded-lg p-4 flex items-center gap-4 bg-white">
                <div>
                    <img src="{{ asset('storage/icons/dollar.png') }}" alt="Úspora" class="w-6 h-6">
                </div>
                <div>
                    <h4 class="font-semibold">Úspora nákladov</h4>
                </div>
            </div>
            <div class="border border-rose-200 rounded-lg p-4 flex items-center gap-4 bg-white">
                <div>
                    <img src="{{ asset('storage/icons/shieldwithcheck.png') }}" alt="Spoľahlivosť" class="w-6 h-6">
                </div>
                <div>
                    <h4 class="font-semibold">Spoľahlivosť</h4>
                </div>
            </div>
            <div class="border border-rose-200 rounded-lg p-4 flex items-center gap-4 bg-white">
                <div>
                    <img src="{{ asset('storage/icons/enviro.png') }}" alt="Ekologický prínos" class="w-6 h-6">
                </div>
                <div>
                    <h4 class="font-semibold">Ekologický prínos</h4>
                </div>
            </div>
        </div>

        <p class="mb-10 text-base">
            Fotovoltické systémy prinášajú výrazné dlhodobé úspory vďaka zníženiu alebo eliminácii účtov za elektrinu. Sú veľmi spoľahlivé, vyžadujú minimálnu údržbu a prispievajú k ochrane životného prostredia znížením emisií CO₂.
        </p>

        {{-- Typy systémov --}}
        <h3 class="text-lg font-semibold mb-4">Typy fotovoltických systémov</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white border border-rose-200 rounded-lg p-4 flex items-center gap-4">
                <img src="{{ asset('storage/solar/residential.png') }}" class="w-12 h-12 rounded object-cover" alt="Pre domácnosti">
                <h4 class="font-semibold">Systémy pre domácnosti</h4>
            </div>
            <div class="bg-white border border-rose-200 rounded-lg p-4 flex items-center gap-4">
                <img src="{{ asset('storage/solar/commercial.png') }}" class="w-12 h-12 rounded object-cover" alt="Pre firmy">
                <h4 class="font-semibold">Systémy pre firmy</h4>
            </div>
            <div class="bg-white border border-rose-200 rounded-lg p-4 flex items-center gap-4">
                <img src="{{ asset('storage/solar/offgrid.png') }}" class="w-12 h-12 rounded object-cover" alt="Ostrovné systémy">
                <h4 class="font-semibold">Ostrovné systémy</h4>
            </div>
        </div>

        <p class="mb-10 text-base">
            Ponúkame rôzne typy fotovoltických systémov prispôsobené vašim potrebám. Systémy pre domácnosti sú ideálne pre jednotlivcov, ktorí chcú znížiť náklady na energiu, zatiaľ čo systémy pre firmy pomáhajú znížiť prevádzkové náklady. Ostrovné systémy sú vhodné pre miesta bez prístupu k elektrickej sieti.
        </p>

        {{-- Inštalačný proces --}}
        <h3 class="text-lg font-semibold mb-6">Proces inštalácie</h3>
        <ul class="space-y-8 relative">
            <div class="absolute left-5 top-0 h-[90%] border-l-2 border-dashed border-gray-400 z-0"></div>

            {{-- 1. Konzultácia --}}
            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-2">
                        {{-- SVG zostáva nezmenené --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold">Konzultácia</h4>
                    <p class="text-rose-600 text-sm">
                        Úvodné posúdenie vašich energetických potrieb a obhliadka objektu.
                    </p>
                </div>
            </li>

            {{-- 2. Návrh a plánovanie --}}
            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-2">
                        {{-- SVG zostáva nezmenené --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold">Návrh a plánovanie</h4>
                    <p class="text-rose-600 text-sm">
                        Prispôsobený návrh systému a plánovanie na maximalizáciu efektivity.
                    </p>
                </div>
            </li>

            {{-- 3. Inštalácia --}}
            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-2">
                        {{-- SVG zostáva nezmenené --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold">Inštalácia</h4>
                    <p class="text-rose-600 text-sm">
                        Odborná inštalácia našimi certifikovanými technikmi.
                    </p>
                </div>
            </li>

            {{-- 4. Údržba --}}
            <li class="relative z-10 flex gap-4 items-start">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-2">
                        {{-- SVG zostáva nezmenené --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold">Údržba</h4>
                    <p class="text-rose-600 text-sm">
                        Pravidelná technická údržba a podpora pre optimálny výkon.
                    </p>
                </div>
            </li>
        </ul>

        <p class="mt-10 text-base">
            Náš proces inštalácie je navrhnutý tak, aby bol efektívny a bezstarostný. Začíname dôkladnou konzultáciou, pokračujeme návrhom systému, profesionálnou montážou a zabezpečujeme aj následnú údržbu pre dlhodobý výkon systému.
        </p>
    </div>
</x-layouts.base>
