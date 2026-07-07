@props([

'type'=>'text'

])

<input

type="{{ $type }}"

{{ $attributes->merge([

'class'=>'w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none'

]) }}>
