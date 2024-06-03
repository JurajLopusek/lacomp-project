@props(['active' => false])

<div class="flex justify-center">
    <a class="{{ $active ? 'bg-gray-900 text-white': 'text-black-300 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 mr-2 text-sm font-medium"
       aria-current="{{ $active ? 'page': 'false' }}"
        {{ $attributes }}
    >{{ $slot }}</a>
</div>
