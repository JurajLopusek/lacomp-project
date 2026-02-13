@props(['active' => false])

<div class="border-b border-gray-200">
    <a
        class="flex items-center justify-between px-6 py-4 text-md font-semibold transition duration-200 {{ $active
            ? 'bg-red-600 text-white shadow-lg shadow-red-600/40'
            : 'bg-white text-[#272835] border border-gray-200 hover:bg-gray-100' }}"
        aria-current="{{ $active ? 'page' : 'false' }}"
        {{ $attributes }}
    >
        <span>{{ $slot }}</span>
        <span class="flex items-center">
            <img
                class="w-6 {{ $active ? 'hidden' : 'block dark:hidden' }}"
                alt="chev"
                height="2px"
                width="12px"
                src="{{ asset('storage/icons/chevronRightBlack.png') }}"
            >
            <img
                class="w-6 {{ $active ? 'block' : 'hidden dark:block' }}"
                alt="chev"
                height="2px"
                width="12px"
                src="{{ asset('storage/icons/chevron-rightWhite.png') }}"
            >
        </span>
    </a>
</div>
