<x-layouts.base>
    <div class="max-w-7xl mx-auto px-4 py-6 bg-[#FCF7F7] text-black">
        <div class="hidden md:block rounded-xl overflow-hidden mb-8 h-96">
            <img
                src="{{ asset('storage/rekuperacie/reku_main.png') }}"
                alt="Rekuperacie"
                class="w-full h-full object-cover"
            >
        </div>

        <div class="block md:hidden max-h-96 rounded-xl overflow-hidden mb-8">
            <img src="{{ asset('storage/rekuperacie/reku_main.png') }}" alt="Rekuperacie" class="w-full h-auto object-cover">
        </div>
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold mb-4">
                    Vetrajte bez tepelných strát a zbavte sa vlhkosti
                </h1>
                <p class="text-2xl opacity-90">
                    Hlavné výhody vetrania pomocou tohto systému
                </p>
            </div>
        </div>
        <!-- BENEFITS ROW -->
        <div class="grid md:grid-cols-4 gap-2 mt-4 text-lg">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white text-green-700 font-bold rounded-full
                flex items-center justify-center shrink-0">
                    ✓
                </div>

                <p>
                    Vetrajte automaticky, efektívne a úsporne
                </p>
            </div>


            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white font-bold text-green-700 rounded-full
                flex items-center justify-center shrink-0">
                    ✓
                </div>
                <p>Bez hluku, zápachu, alergénov a plesní</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white font-bold text-green-700 rounded-full
                flex items-center justify-center shrink-0">
                    ✓
                </div>
                <p>Ovládanie na diaľku prostredníctvom inteligentnej aplikácie</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white font-bold text-green-700 rounded-full
                flex items-center justify-center shrink-0">
                    ✓
                </div>
                <p>Záruka 5 rokov</p>
            </div>
        </div>
        <div>
            <div class="grid md:grid-cols-2 gap-10 items-center mt-10">

                <!-- ERV -->
                <div class="group flex flex-col items-center text-center">

                    <a href="{{ route('hrv') }}" class="block overflow-hidden">
                        <img
                            src="{{ asset('storage/rekuperacie/40ERV-removebg-preview.png') }}"
                            alt="Recuair ERV"
                            class="max-h-80 object-contain transition duration-500 ease-in-out group-hover:scale-110"
                        >
                    </a>

                    <h3 class="mt-8 text-2xl font-semibold">
                        Rekuperační jednotka – DC 40 HRV
                    </h3>

                    <p class="mt-4 text-xl">
                        Od 1 190 € <span class="text-base">(bez DPH)</span>
                    </p>

                    <a href="{{ route('hrv') }}"
                       class="inline-block mt-6 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg text-lg font-medium transition duration-300">
                        Zistiť viac
                    </a>

                </div>


                <!-- HRV -->
                <div class="group flex flex-col items-center text-center">

                    <a href="{{ route('erv') }}" class="block overflow-hidden">
                        <img
                            src="{{ asset('storage/rekuperacie/40HRV-removebg-preview.png') }}"
                            alt="Recuair HRV"
                            class="max-h-80 object-contain transition duration-500 ease-in-out group-hover:scale-110"
                        >
                    </a>

                    <h3 class="mt-8 text-2xl font-semibold">
                        Rekuperační jednotka – DC 40 ERV
                    </h3>

                    <p class="mt-4 text-xl">
                        Od 1 290 € <span class="text-base">(bez DPH)</span>
                    </p>

                    <a href="{{ route('erv') }}"
                       class="inline-block mt-6 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg text-lg font-medium transition duration-300">
                        Zistiť viac
                    </a>

                </div>

            </div>
        </div>

        <!-- DETAIL SECTION -->
        <section class="pt-10 md:pt-20">
            <div class="max-w-6xl">
                <div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="">
                            <!-- LEFT BOXES -->
                            <div class="space-y-6">

                                <div class="bg-white rounded-xl shadow p-6 border">
                                    <h3 class="font-semibold text-lg mb-3">
                                        Zaistite si čerstvý vzduch a kvalitný spánok
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Čerstvý vzduch má veľký vplyv na naše zdravie, spánok,
                                        koncentráciu a energiu. Jeho nedostatok vedie k únave,
                                        zlému spánku a ďalším chronickým problémom.
                                    </p>
                                </div>

                                <div class="bg-white rounded-xl shadow p-6 border">
                                    <h3 class="font-semibold text-lg mb-3">
                                        Vyčistite si vzduch od alergénov a prachu
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Vďaka systému rekuperácie vzduchu RECUAIR s
                                        vysokokvalitným filtrom sa peľ a alergény
                                        nedostanú dovnútra.
                                    </p>
                                </div>

                                <div class="bg-white rounded-xl shadow p-6 border">
                                    <h3 class="font-semibold text-lg mb-3">
                                        Vetrajte bez zápachu a hluku zvonku
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Filtrácia a zvuková izolácia zabezpečia
                                        čistý vzduch bez hluku, dymu a zápachov.
                                    </p>
                                </div>

                                <div class="bg-white rounded-xl shadow p-6 border">
                                    <h3 class="font-semibold text-lg mb-3">
                                        Zbavte sa nezdravej vlhkosti v interiéri
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Automatický systém vetrania s rekuperáciou
                                        zabraňuje nadmernej vlhkosti a vzniku plesní.
                                    </p>
                                </div>

                                <div class="bg-white rounded-xl shadow p-6 border">
                                    <h3 class="font-semibold text-lg mb-3">
                                        Šetrite svoje peniaze a prírodu
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Vetranie so zatvorenými oknami pomáha
                                        optimalizovať spotrebu energie vo vašom dome.
                                    </p>
                                </div>
                            </div>
                            <!-- RIGHT EMPTY (app removed as requested) -->
                            <div class="hidden md:block">
                                <!-- Sem môžeš dať neskôr produktový obrázok alebo ilustráciu -->
                            </div>
                        </div>
                        <div>
                            <div class="hidden md:block">
                                <img src="{{ asset('storage/rekuperacie/rekuperacie.jpeg') }}" alt="Rekuperacie"
                                     class="w-full h-auto object-cover rounded-xl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.base>
