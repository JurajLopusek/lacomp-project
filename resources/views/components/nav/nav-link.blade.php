@props(['active' => false])

<div class="flex justify-center">
    <a class="{{ $active ? 'bg-red-500 text-white': 'text-white hover:border-2 border-red-500 hover:text-white'}} rounded-md px-5 py-2 mr-2 text-sm font-medium"
       aria-current="{{ $active ? 'page': 'false' }}"
        {{ $attributes }}
    >{{ $slot }}</a>
</div>
