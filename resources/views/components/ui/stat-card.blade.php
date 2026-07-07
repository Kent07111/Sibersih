@props([

'title',

'value',

'icon'

])

<x-ui.card>

<div class="flex justify-between">

<div>

<p class="text-slate-500">

{{ $title }}

</p>

<h2 class="text-4xl font-bold mt-2">

{{ $value }}

</h2>

</div>

<div

class="w-14

h-14

rounded-xl

bg-green-100

flex

items-center

justify-center">

{{ $icon }}

</div>

</div>

</x-ui.card>
