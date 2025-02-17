@props(['active' => false])

<div class="px-8 border-b">
    <a class="{{ $active ? 'bg-[#272835] text-white' : 'text-[#272835] dark:text-white' }} font-semibold rounded-full py-4 text-md flex items-center justify-between"
       aria-current="{{ $active ? 'page' : 'false' }}"
        {{ $attributes }}
    >
        <div>
            {{ $slot }}
        </div>
        <div>
            <img class="w-6 dark:hidden" alt="chev" height="2px" width="12px" src="{{ asset('storage/icons/chevronRightBlack.png') }}">
            <img class="w-6 hidden dark:block" alt="chev" height="2px" width="12px" src="{{ asset('storage/icons/chevron-rightWhite.png') }}">
        </div>
    </a>

</div>

