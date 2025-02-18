<x-layouts.base>
{{--    <header class="bg-blue-900 text-white text-center py-20">--}}
{{--        <h1 class="text-4xl font-bold">Bezpečnosť na prvom mieste</h1>--}}
{{--        <p class="mt-4 text-lg">Montujeme kamerové systémy pre školy, firmy a domácnosti.</p>--}}
{{--    </header>--}}
    <div class="grid grid-cols-1 grid-rows-1">
        <div
            class="flex m-3 flex-col rounded bg-white bg-clip-border text-gray-700 shadow-md justify-self-center">
            <x-card.text>
                <p class="font-bold text-3xl xl:text-5xl mb-4">O nás</p>
                <p>Sme odborníci na inštaláciu moderných kamerových systémov. Poskytujeme riešenia na mieru s vysokou kvalitou obrazu a možnosťou diaľkového prístupu.</p>
            </x-card.text>
        </div>
    </div>
    <!-- Služby -->
    <section class="max-w-4xl mx-auto my-12">
        <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-200">Naše služby</h2>
        <div class="grid md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-gray-800">Školy</h3>
                <p class="mt-2 text-gray-600">Zabezpečenie škôl kamerovými systémami pre vyššiu bezpečnosť žiakov.</p>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-gray-800">Firmy</h3>
                <p class="mt-2 text-gray-600">Ochrana majetku a monitorovanie firemných priestorov.</p>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-gray-800">Domácnosti</h3>
                <p class="mt-2 text-gray-600">Non-stop dohľad nad vašou nehnuteľnosťou aj na diaľku.</p>
            </div>
        </div>
    </section>

    <!-- Výhody -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-900">Prečo si vybrať nás?</h2>
        <ul class="list-disc pl-6 mt-4 text-gray-700">
            <li>Vysokokvalitný obraz aj v noci</li>
            <li>Mobilná aplikácia na vzdialené sledovanie</li>
            <li>Rýchla inštalácia a podpora</li>
            <li>Bezpečné a spoľahlivé riešenia</li>
        </ul>
    </section>
</x-layouts.base>
