<script type="module">
    import config from '../../../tailwind.config.js';
    console.log(config);
</script>

<x-layouts.base>
    <div class="grid grid-cols-1 grid-rows-1">
        <div
            class="flex w-1/2 m-3 flex-col rounded bg-white bg-clip-border text-gray-700 shadow-md justify-self-center">
            <x-card.text>
                <p class="font-bold text-5xl mb-4">FOTOVOLTIKA SO ŠTÁTNOU DOTÁCIOU</p>
                <p>Naša spoločnosť je registrovaným zhotoviteľom projektu Zelená domácnostiam:
                    - dotácia do 4 025€ z projektu Zelená domácnostiam, financovaný z EU.</p>
            </x-card.text>
        </div>
    </div>

    <div class="grid grid-cols-2 grid-rows-2 mx-6 mt-6">
        <x-card.card class="justify-self-end cursor-pointer bg-red-hover p-4 shadow-custom hover:bg-red-200" onclick="window.location.href='/alarmy'">
            <x-card.icon>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"/>
            </x-card.icon>

            <x-card.text>
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    Alarmy
                </h5>
                <ul class="block list-disc font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    <li>Jablotron, Paradox, Cerber</li>
                    <li>Drôtové a bezdrôtové prvky</li>
                    <li>Volanie na mobil</li>
                    <li>Ovládanie mobilom</li>
                </ul>
            </x-card.text>
        </x-card.card>



        <x-card.card class="cursor-pointer bg-red-hover p-4 shadow-custom hover:bg-red-200" onclick="window.location.href='/kamery'">
            <x-card.icon>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
            </x-card.icon>

            <x-card.text>
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    Kamery
                </h5>

                <ul class="block list-disc  font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    <li>Hikvision, Dahua, Siemens</li>
                    <li>IP/HD/analóg</li>
                    <li>Obraz on-line v mobile/počítači</li>
                    <li>Analýza a detekcia tváre, prekročenie čiary</li>
                </ul>
            </x-card.text>
        </x-card.card>

        <x-card.card class="justify-self-end">
            <x-card.icon>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
            </x-card.icon>

            <x-card.text>
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    Fotovoltika
                </h5>

                <ul class="block list-disc  font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    <li>Analýza</li>
                    <li>Návrh</li>
                    <li>Administratíva</li>
                    <li>Realizácia</li>
                </ul>
            </x-card.text>
        </x-card.card>

        <x-card.card>
            <x-card.icon>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
            </x-card.icon>

            <x-card.text>
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    Revízie
                </h5>

                <ul class="block list-disc  font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    <li>Odborné prehliadky a odborné skúšky elektrických zariadení v rozsahu:</li>
                    <li>- A objekty bez nebezpečenstva výbuchu</li>
                    <li>- E.2 zariadenia s napätím do 1000V vrátane bleskozvodu</li>
                </ul>
            </x-card.text>
        </x-card.card>
    </div>
</x-layouts.base>
