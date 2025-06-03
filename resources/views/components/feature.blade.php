@props([
    'icon' => 'photo', // názov PNG súboru bez prípony
    'icon' => 'moon',
    'icon' => 'motion',
    'icon' => 'wifi',
    'icon' => 'cloud',
    'text' => '',
])
<li class="flex items-center gap-3">
    <span class="bg-white p-2 rounded-lg">
        <img src="{{ asset('storage/cameras/' . $icon . '.png') }}" alt="{{ $text }}" class="w-5 h-5 object-contain">
    </span>
    <span>{{ $text }}</span>
</li>
