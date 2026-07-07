{{-- resources/views/components/ui/card.blade.php --}}

<div
    {{ $attributes->merge([
        'class' => 'bg-white rounded-2xl border border-slate-200 shadow-sm',
    ]) }}
>
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
