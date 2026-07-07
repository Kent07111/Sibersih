{{-- resources/views/components/ui/button.blade.php --}}

@props([
    'type' => 'button',
    'color' => 'green',
])

@php
    $colors = [
        'green' => 'bg-green-600 hover:bg-green-700 text-white',
        'gray'  => 'bg-slate-200 hover:bg-slate-300 text-slate-700',
        'red'   => 'bg-red-500 hover:bg-red-600 text-white',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 font-medium transition duration-200 shadow-sm ' . $colors[$color],
    ]) }}
>
    {{ $slot }}
</button>
