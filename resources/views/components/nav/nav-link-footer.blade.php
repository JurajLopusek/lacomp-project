@props(['active' => false])

<div class="flex justify-center">
    <a class="{{ $active ? ' text-rose-800': 'text-rose-800 hover:text-rose-500'}} text-base font-medium"
       aria-current="{{ $active ? 'page': 'false' }}"
        {{ $attributes }}
    >{{ $slot }}</a>
</div>
