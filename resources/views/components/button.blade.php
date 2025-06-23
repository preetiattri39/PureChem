@props([
    'href' => '#',
    'color' => 'red',
    'hover_color'=>'black',
    'size' => 'base'
])

<a 
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "px-4 py-2 bg-$color-600 text-white text-$size rounded hover:bg-$hover_color transition"]) }}>
    {{ $slot }}
</a>
