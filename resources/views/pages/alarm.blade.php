<x-layouts.base>
    <div class="flex justify-center items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 mx-6 mt-6 gap-8">
            <div class="flex flex-col max-w-sm rounded overflow-hidden shadow-lg p-4 bg-white">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-4 text-center">JABLOTRON</div>
                    <p class="text-gray-700 text-base mb-4 text-center">
                        S produktami JABLOTRON pracujeme už viac ako 15 rokov. Vykonali sme množstvo montáží domových alarmov ako aj autoalarmov. Z osobných skúseností sa nám výrobky Jablotronu javia ako najinovatívnejšie a najspoľahlivejšie.
                    </p>
                </div>
                <img class="w-80 mx-auto mb-8" src="{{ asset('storage/montazny-partner.jpg') }}">
                <div class="flex w-full items-center justify-center mt-auto">
                    <a href="https://www.jablotron.com/en/" target="_blank" class="text-blue-500 hover:underline">Dozvedieť sa viac...</a>
                </div>
            </div>

            <div class="flex flex-col max-w-sm rounded overflow-hidden shadow-lg p-4 bg-white">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-4 text-center">PARADOX</div>
                    <p class="text-gray-700 text-base text-center">
                        Zabezpečovací systém Paradox Kanadského výrobcu patrí medzi najspoľahlivejšie a najoverenejšie bezpečnostné systémy. Za 15 rokov práce s týmto systémom sme nemali prakticky žiadne komplikácie.
                    </p>
                </div>
                <img class="w-80 mx-auto mb-8" src="{{ asset('storage/alarm.jpg') }}">
                <div class="flex w-full items-center justify-center mt-auto">
                    <a href="https://www.paradox.com/" target="_blank" class="text-blue-500 hover:underline">Dozvedieť sa viac...</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
