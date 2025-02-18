<div>
    <h1 class="dark:text-gray-200 text-gray-900 mb-8">
        V prípade akýchkoľvek otázok nás neváhajte kontaktovať!
    </h1>

    <form wire:submit.prevent="send" method="post">
        <div class="mb-8">
            <x-input-label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meno
            </x-input-label>
            <div class="flex">
            <span
                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
              </svg>
            </span>

                <x-text-input type="text" id="name" wire:model.live="name"
                              class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="Bonnie Green"/>

            </div>
            @error('name')<span class="absolute text-red-500 text-sm">{{$message}}</span> @enderror
        </div>
        <div class="mb-8">
            <x-input-label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
            </x-input-label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <svg
                        class="w-4 h-4 text-gray-500 dark:text-gray-400"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                    <path
                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                </span>
                <x-text-input type="text" id="email" wire:model.live="email"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="meno@gmail.com"/>

            </div>
            @error('email')<span class="absolute text-red-500 text-sm">{{$message}}</span> @enderror

        </div>


        <div class="mb-8">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaša
                správa</label>
            <textarea id="message" rows="4" wire:model.live="message"
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="Vaša správa..."></textarea>
            @error('message')<span class="absolute text-red-500 text-sm">{{$message}}</span> @enderror

        </div>
        <div class="mb-[24px]">
            <x-input-label for="file-upload" :value=" __('Príloha')"/>
            <label for="file-upload" class="cursor-pointer border font-normal border-gray-300 hover:border-gray-300 text-gray-900 bg-gray-50 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-center
               @error('photo') border-red-500 shadow-[0_0_10px_#DF1C41] @enderror">
                @if($photo)
                    <p class="dark:text-gray-400">{{ __('Pridali ste') }}: {{ $photoName }}</p>
                @else
                    <p class="dark:text-gray-400">{{ __('Vaša príloha') }}</p>
                @endif
            </label>
            <input id="file-upload" type="file" wire:model="photo" class="hidden">
            @error('photo')<span class="absolute text-[#DF1C41] text-sm ">{{$message}}</span> @enderror
        </div>
        <div>
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Odoslat!
            </button>
        </div>

    </form>
    <div class="p-6">
        @if(session()->has('success'))
            <div class="bg-green-200 text-green-800 px-4 py-2 rounded">
                {{session('success')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="bg-red-200 text-red-800 rounded">
                {{session('error')}}
            </div>
        @endif
    </div>

</div>
