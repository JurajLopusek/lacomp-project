<x-layouts.base>
    <div class="max-w-7xl mx-auto px-4 py-6 bg-[#FCF7F7]">
        {{-- Hlavičkový obrázok --}}
        <div class="rounded-xl overflow-hidden mb-8 h-96">
            <img src="{{ asset('storage/cameras/kamery.png') }}" alt="Kamerový systém" class="w-full h-full object-cover object-center">
        </div>

        {{-- Nadpis a úvod --}}
        <div class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Preskúmajte naše riešenia kamerových systémov</h2>
            <p class="text-base leading-relaxed">
                V SolarTech Solutions ponúkame komplexný výber kamerových systémov navrhnutých tak, aby pokryli rôzne bezpečnostné potreby.
                Od sledovania domácností až po profesionálne zabezpečenie firiem – naše riešenia poskytujú spoľahlivý dohľad a pokoj na duši.
            </p>
        </div>

        {{-- Typy kamerových systémov --}}
        <div class="mb-10">
            <h3 class="text-lg font-semibold mb-4">Typy kamerových systémov</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border border-rose-200 rounded-lg p-4 bg-white">
                    <img src="{{ asset('storage/cameras/dome.png') }}" alt="Dome kamera" class="w-10 h-10 mb-3">
                    <h4 class="font-bold mb-1">Dome kamery</h4>
                    <p class="text-md text-rose-600">Ideálne na vnútorné a nenápadné sledovanie.</p>
                </div>
                <div class="border border-rose-200 rounded-lg p-4 bg-white">
                    <img src="{{ asset('storage/cameras/bullet.png') }}" alt="Bullet kamera" class="w-10 h-10 mb-3">
                    <h4 class="font-bold mb-1">Bullet kamery</h4>
                    <p class="text-md text-rose-600">Vhodné na vonkajšie použitie s odolnosťou voči poveternostným podmienkam.</p>
                </div>
                <div class="border border-rose-200 rounded-lg p-4 bg-white">
                    <img src="{{ asset('storage/cameras/ptz.png') }}" alt="PTZ kamera" class="w-10 h-10 mb-3">
                    <h4 class="font-bold mb-1">PTZ kamery</h4>
                    <p class="text-md text-rose-600">Umožňujú otáčanie, nakláňanie a priblíženie pre široký záber priestoru.</p>
                </div>
            </div>
        </div>

        {{-- Kľúčové vlastnosti --}}
        <div class="mb-10">
            <h3 class="text-lg font-semibold mb-4">Kľúčové vlastnosti</h3>
            <ul class="space-y-3">
                <x-feature icon="photo" text="Vysoké rozlíšenie obrazu" />
                <x-feature icon="moon" text="Nočné videnie" />
                <x-feature icon="motion" iconType="png" text="Detekcia pohybu" />
                <x-feature icon="wifi" text="Vzdialený prístup" />
                <x-feature icon="cloud" text="Ukladanie do cloudu" />
            </ul>
        </div>

        {{-- Inštalácia a podpora --}}
        <div>
            <h3 class="text-lg font-semibold mb-3">Inštalácia a podpora</h3>
            <p class="text-base leading-relaxed">
                Náš odborný tím zabezpečí profesionálnu inštaláciu pre optimálny výkon a pokrytie.
                Zároveň poskytujeme priebežnú technickú podporu a údržbu, aby váš systém fungoval spoľahlivo.
            </p>
        </div>
    </div>
</x-layouts.base>
