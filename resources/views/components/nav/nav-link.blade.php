@props(['active' => false])

<div class="flex justify-center">
    <a class="{{ $active ? 'bg-red-500 text-white': 'text-white hover:scale-125 duration-300 hover:text-white'}} rounded-md px-4 py-2 mr-2 text-sm font-medium"
       aria-current="{{ $active ? 'page': 'false' }}"
        {{ $attributes }}
    >{{ $slot }}</a>
</div>
