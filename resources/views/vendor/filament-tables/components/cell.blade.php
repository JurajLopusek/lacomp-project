@props([
    'tag' => 'td',
])

@php
$filteredClass = collect(explode(' ', $attributes->get('class', '')))
    ->reject(fn ($class) => trim($class) === 'min-w-48')
    ->implode(' ');
$attributes = new \Illuminate\View\ComponentAttributeBag(
    array_merge($attributes->all(), ['class' => $filteredClass])
);
@endphp

<{{ $tag }}
{{ $attributes->class(['fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3']) }}
>
{{ $slot }}
</{{ $tag }}>
