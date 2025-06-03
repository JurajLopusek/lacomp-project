@props([
    'image',
    'title',
    'description',
])

<div class="rounded-lg overflow-hidden bg-rose-50 text-rose-800 w-full md:w-64 hover:shadow transition">
    <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-40 object-cover rounded-b-none">
    <div class="p-4">
        <h3 class="font-bold text-lg text-black mb-2">{{ $title }}</h3>
        <p class="text-sm leading-snug">{{ $description }}</p>
    </div>
</div>
